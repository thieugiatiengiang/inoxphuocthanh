<?php class Shortbuild_Bu_Hooks {

    private $hook_suffix;

    private $theme_author = 'themeansar';

    public static function instance() {

        static $instance = null;

        if ( null === $instance ) {
            $instance = new self();
        }

        return $instance;
    }

    public function __construct() {}

    public function import_menu() {
        if( !class_exists('Advanced_Import')){
            $this->hook_suffix[] = add_theme_page( esc_html__( 'Demo Import ','shortbuild' ), esc_html__( 'Demo Import','shortbuild'  ), 'manage_options', 'advanced-import', array( $this, 'demo_import_screen' ) );
        }
    }

   public function get_theme_mods()
{
    $theme_slug = get_option('stylesheet');
    $mods = get_option("theme_mods_$theme_slug");
    if (false === $mods)
    {
        $theme_name = get_option('current_theme');
        if (false === $theme_name)
            $theme_name = wp_get_theme()->get('Name');
        $mods = get_option("mods_$theme_name"); // Deprecated location.
        if (is_admin() && false !== $mods)
        {
            update_option("theme_mods_$theme_slug", $mods);
            delete_option("mods_$theme_name");
        }
    }

    return $mods;
}



public function set_theme_mod( $name, $value ) {
    $mods = get_theme_mods();
    $old_value = isset( $mods[ $name ] ) ? $mods[ $name ] : false;
 

   $mods[ $name ] = apply_filters( "pre_set_theme_mod_{$name}", $value, $old_value );

   $theme = get_option( 'stylesheet' );
    update_option( "theme_mods_$theme", $mods );
 }

    public function enqueue_styles( $hook_suffix ) {
        if ( !is_array($this->hook_suffix) || !in_array( $hook_suffix, $this->hook_suffix )){
            return;
        }
        wp_enqueue_style( SBP_PLUGIN_PLUGIN_NAME, SBP_PLUGIN_URL . 'assets/shortbuild-bu.css',array( 'wp-admin', 'dashicons' ), SBP_PLUGIN_VERSION, 'all' );
    }

    public function enqueue_scripts( $hook_suffix ) {
        if ( !is_array($this->hook_suffix) || !in_array( $hook_suffix, $this->hook_suffix )){
            return;
        }

        wp_enqueue_script( SBP_PLUGIN_PLUGIN_NAME, SBP_PLUGIN_URL . 'assets/shortbuild-bu.js', array( 'jquery'), SBP_PLUGIN_VERSION, true );
        wp_localize_script( SBP_PLUGIN_PLUGIN_NAME, 'shortbuild', array(
            'btn_text' => esc_html__( 'Processing...', 'shortbuild' ),
            'nonce'    => wp_create_nonce( 'shortbuild_bu_nonce' )
        ) );
    }

    public function demo_import_screen() {
        ?>
        <div id="ads-notice">
            <div class="ads-container">
                <img class="ads-screenshot" src="<?php echo esc_url(shortbuild_bu_get_theme_screenshot() )?>" />
                <div class="ads-notice">
                    <h2>
                        <?php
                        printf(
                            esc_html__( 'Welcome! Thank you for choosing %1$s! To get started with ready-made starter site templates. Install the Advanced Import plugin and install Demo Starter Site within a single click', 'shortbuild' ), '<strong>'. wp_get_theme()->get('Name'). '</strong>');
                        ?>
                    </h2>

                    <p class="plugin-install-notice"><?php esc_html_e( 'Clicking the button below will install and activate the Advanced Import plugin.', 'shortbuild' ); ?></p>

                    <a class="ads-gsm-btn button button-primary button-hero" href="#" data-name="" data-slug="" aria-label="<?php esc_html_e( 'Get started with the Theme', 'shortbuild' ); ?>">
                        <?php esc_html_e( 'Get Started', 'shortbuild' );?>
                    </a>
                </div>
            </div>
        </div>
        <?php

    }

    public function install_advanced_import() {

        check_ajax_referer( 'shortbuild_bu_nonce', 'security' );

        $slug   = 'advanced-import';
        $plugin = 'advanced-import/advanced-import.php';

        $status = array(
            'install' => 'plugin',
            'slug'    => sanitize_key( wp_unslash( $slug ) ),
        );
        $status['redirect'] = admin_url( '/themes.php?page=advanced-import&browse=all&at-gsm-hide-notice=welcome' );

        if ( is_plugin_active_for_network( $plugin ) || is_plugin_active( $plugin ) ) {
            // Plugin is activated
            wp_send_json_success($status);
        }


        if ( ! current_user_can( 'install_plugins' ) ) {
            $status['errorMessage'] = __( 'Sorry, you are not allowed to install plugins on this site.', 'shortbuild' );
            wp_send_json_error( $status );
        }

        include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';
        include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

        // Looks like a plugin is installed, but not active.
        if ( file_exists( WP_PLUGIN_DIR . '/' . $slug ) ) {
            $plugin_data          = get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin );
            $status['plugin']     = $plugin;
            $status['pluginName'] = $plugin_data['Name'];

            if ( current_user_can( 'activate_plugin', $plugin ) && is_plugin_inactive( $plugin ) ) {
                $result = activate_plugin( $plugin );

                if ( is_wp_error( $result ) ) {
                    $status['errorCode']    = $result->get_error_code();
                    $status['errorMessage'] = $result->get_error_message();
                    wp_send_json_error( $status );
                }

                wp_send_json_success( $status );
            }
        }

        $api = plugins_api(
            'plugin_information',
            array(
                'slug'   => sanitize_key( wp_unslash( $slug ) ),
                'fields' => array(
                    'sections' => false,
                ),
            )
        );

        if ( is_wp_error( $api ) ) {
            $status['errorMessage'] = $api->get_error_message();
            wp_send_json_error( $status );
        }

        $status['pluginName'] = $api->name;

        $skin     = new WP_Ajax_Upgrader_Skin();
        $upgrader = new Plugin_Upgrader( $skin );
        $result   = $upgrader->install( $api->download_link );

        if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
            $status['debug'] = $skin->get_upgrade_messages();
        }

        if ( is_wp_error( $result ) ) {
            $status['errorCode']    = $result->get_error_code();
            $status['errorMessage'] = $result->get_error_message();
            wp_send_json_error( $status );
        } elseif ( is_wp_error( $skin->result ) ) {
            $status['errorCode']    = $skin->result->get_error_code();
            $status['errorMessage'] = $skin->result->get_error_message();
            wp_send_json_error( $status );
        } elseif ( $skin->get_errors()->get_error_code() ) {
            $status['errorMessage'] = $skin->get_error_messages();
            wp_send_json_error( $status );
        } elseif ( is_null( $result ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            WP_Filesystem();
            global $wp_filesystem;

            $status['errorCode']    = 'unable_to_connect_to_filesystem';
            $status['errorMessage'] = __( 'Unable to connect to the filesystem. Please confirm your credentials.', 'shortbuild' );

            // Pass through the error from WP_Filesystem if one was raised.
            if ( $wp_filesystem instanceof WP_Filesystem_Base && is_wp_error( $wp_filesystem->errors ) && $wp_filesystem->errors->get_error_code() ) {
                $status['errorMessage'] = esc_html( $wp_filesystem->errors->get_error_message() );
            }

            wp_send_json_error( $status );
        }

        $install_status = install_plugin_install_status( $api );

        if ( current_user_can( 'activate_plugin', $install_status['file'] ) && is_plugin_inactive( $install_status['file'] ) ) {
            $result = activate_plugin( $install_status['file'] );

            if ( is_wp_error( $result ) ) {
                $status['errorCode']    = $result->get_error_code();
                $status['errorMessage'] = $result->get_error_message();
                wp_send_json_error( $status );
            }
        }

        wp_send_json_success( $status );

    }

    public function add_demo_lists( $current_demo_list ) {

        if( shortbuild_bu_get_current_theme_author() != $this->theme_author ){
            return  $current_demo_list;
        }

        $theme_slug = shortbuild_bu_get_current_theme_slug();

        switch ($theme_slug):
            case "businessup":
                $templates = array(
                    array(
                        'title' => __( 'Main Demo', 'shortbuild' ),/*Title*/
                        'is_premium' => false,/*Premium*/
                        'type' => 'normal',
                        'author' => __( 'Themeansar', 'shortbuild' ),/*Author Name*/
                        'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                        'categories' => array( 'business' ),/*Categories*/
                        'template_url' => array(
                            'content' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/content.json',
                            'options' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/options.json',
                            'widgets' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/widgets.json'
                        ),
                        'screenshot_url' => SBP_PLUGIN_URL .'inc/images/businessup-lite.png',
                        'demo_url' => 'https://themeansar.com/demo/wp/businessup/lite/',/*Demo Url*/
                        'plugins' => array(
                            array(
                                'name'      => 'Contact Form 7',
                                'slug'      => 'contact-form-7',
                            )
                        )
                    ),
                );
                break;

                case "busimax":
                $templates = array(
                    array(
                        'title' => __( 'Main Demo', 'shortbuild' ),/*Title*/
                        'is_premium' => false,/*Premium*/
                        'type' => 'normal',
                        'author' => __( 'Themeansar', 'shortbuild' ),/*Author Name*/
                        'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                        'categories' => array( 'business' ),/*Categories*/
                        'template_url' => array(
                            'content' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/content.json',
                            'options' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/options.json',
                            'widgets' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/widgets.json'
                        ),
                        'screenshot_url' => SBP_PLUGIN_URL .'inc/images/busimax.png',
                        'demo_url' => 'https://themeansar.com/demo/wp/businessup/busimax/',/*Demo Url*/
                        'plugins' => array(
                            array(
                                'name'      => 'Contact Form 7',
                                'slug'      => 'contact-form-7',
                            )
                        )
                    ),
                );
                break;

                case "bugency":
                $templates = array(
                    array(
                        'title' => __( 'Main Demo', 'shortbuild' ),/*Title*/
                        'is_premium' => false,/*Premium*/
                        'type' => 'normal',
                        'author' => __( 'Themeansar', 'shortbuild' ),/*Author Name*/
                        'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                        'categories' => array( 'business' ),/*Categories*/
                        'template_url' => array(
                            'content' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/content.json',
                            'options' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/options.json',
                            'widgets' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/widgets.json'
                        ),
                        'screenshot_url' => SBP_PLUGIN_URL .'inc/images/bugency.png',
                        'demo_url' => 'https://themeansar.com/demo/wp/businessup/standard/',/*Demo Url*/
                        'plugins' => array(
                            array(
                                'name'      => 'Contact Form 7',
                                'slug'      => 'contact-form-7',
                            )
                        )
                    ),
                );
                break;

                case "awesome-business":
                $templates = array(
                    array(
                        'title' => __( 'Main Demo', 'shortbuild' ),/*Title*/
                        'is_premium' => false,/*Premium*/
                        'type' => 'normal',
                        'author' => __( 'Themeansar', 'shortbuild' ),/*Author Name*/
                        'keywords' => array( 'main', 'demo' ),/*Search keyword*/
                        'categories' => array( 'business' ),/*Categories*/
                        'template_url' => array(
                            'content' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/content.json',
                            'options' => SBP_PLUGIN_TEMPLATE_URL.$theme_slug.'/default/options.json',
                            'widgets' => SBP_PLUGIN_TEMPLATE_URL.'/businessup/default/widgets.json'
                        ),
                        'screenshot_url' => SBP_PLUGIN_URL .'inc/images/awesome-business.png',
                        'demo_url' => 'https://themeansar.com/demo/wp/businessup/transparent/',/*Demo Url*/
                        'plugins' => array(
                            array(
                                'name'      => 'Contact Form 7',
                                'slug'      => 'contact-form-7',
                            )
                        )
                    ),
                );
                break;
            
            default:
                $templates = array();

        endswitch;

        return array_merge( $current_demo_list, $templates );

    }
    public function replace_term_ids( $replace_term_ids ){

        /*Terms IDS*/
        $term_ids = array(
            'businessup-select-category',
            'businessup-promo-select-category',
        );

        return array_merge( $replace_term_ids, $term_ids );
    }


 

}

/**
 * Begins execution of the hooks.
 *
 * @since    1.0.0
 */
function shortbuild_bu_hooks( ) {
    return Shortbuild_Bu_Hooks::instance();
}