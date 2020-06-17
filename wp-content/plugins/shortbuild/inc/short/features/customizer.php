<?php if ( ! function_exists( 'sbp_short_slider_customize_register' ) ) :
function sbp_short_slider_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

class Sbp_Short_Toggle_Switch_Custom_control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
}


/* Slider Section */
	$wp_customize->add_section( 'slider_section' , array(
		'title'      => __('Slider settings', 'shortbuild'),
		'panel'  => 'home_page_settings',
		'priority'   => 1,
   	) );
		
		// Enable slider
		
		
		
		$wp_customize->add_setting( 'home_page_slider_enabled',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'home_page_slider_enabled',
		   array(
			  'label' => esc_html__( 'Slider Enable/Disable' ),
			  'section' => 'slider_section'
		   )
		) );

		
		//Slider Image
		$wp_customize->add_setting( 'slider_image',array('default' => SBP_PLUGIN_URL .'inc/short/images/slider/banner.jpg',
		'sanitize_callback' => 'esc_url_raw'));
 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'slider_image',
				array(
					'type'        => 'upload',
					'label' => __('Image','shortbuild'),
					'settings' =>'slider_image',
					'section' => 'slider_section',
					
				)
			)
		);
		
		// Image overlay
		$wp_customize->add_setting( 'slider_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('slider_image_overlay', array(
			'label'    => __('Enable slider image overlay', 'shortbuild' ),
			'section'  => 'slider_section',
			'type' => 'checkbox',
		) );
		
		
		//Slider Background Overlay Color
		$wp_customize->add_setting( 'slider_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0,0,0,0.30)',
            ) );	
            
            $wp_customize->add_control(new Short_Customize_Alpha_Color_Control( $wp_customize,'slider_overlay_section_color', array(
               'label'      => __('Slider image overlay color','shortbuild' ),
                'palette' => true,
                'section' => 'slider_section')
            ) );
		
		
		// Slider title
		$wp_customize->add_setting( 'slider_title',array(
		'default' => __('We are Best in Premium Consulting Services','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'slider_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'slider_section',
		'type' => 'text',
		));	
		
		//Slider discription
		$wp_customize->add_setting( 'slider_discription',array(
		'default' => 'we bring the proper people along to challenge esmtblished thinking and drive transformation.',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'slider_discription',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'slider_section',
		'type' => 'textarea',
		));
		
		
		// Slider button text
		$wp_customize->add_setting( 'slider_btn_txt',array(
		'default' => __('Read more','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'slider_btn_txt',array(
		'label'   => __('Button Text','shortbuild'),
		'section' => 'slider_section',
		'type' => 'text',
		));
		
		// Slider button link
		$wp_customize->add_setting( 'slider_btn_link',array(
		'default' => '#',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'slider_btn_link',array(
		'label'   => __('Button Link','shortbuild'),
		'section' => 'slider_section',
		'type' => 'text',
		));
		
		// Slider button target
		$wp_customize->add_setting(
		'slider_btn_target', 
			array(
			'default'        => false,
		));
		$wp_customize->add_control('slider_btn_target', array(
			'label'   => __('Open link in new mtb', 'shortbuild'),
			'section' => 'slider_section',
			'type' => 'checkbox',
		));
		
		
		
}

add_action( 'customize_register', 'sbp_short_slider_customize_register' );
endif;


/**
 * Add selective refresh for slider section controls.
 */
function sbp_short_register_slider_section_partials( $wp_customize ){

	
	
	$wp_customize->selective_refresh->add_partial( 'slider_image', array(
		'selector'            => '.mt-slider-warraper .item figure',
		'settings'            => 'slider_image',
		'render_callback'  => 'sbp_short_slider_image_render_callback',
	
	) );
	
	//Slider section
	$wp_customize->selective_refresh->add_partial( 'slider_title', array(
		'selector'            => '.slide-inner-box h1',
		'settings'            => 'slider_title',
		'render_callback'  => 'sbp_short_slider_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'slider_discription', array(
		'selector'            => '.slide-inner-box p',
		'settings'            => 'slider_discription',
		'render_callback'  => 'sbp_short_slider_iscription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'slider_btn_txt', array(
		'selector'            => '.slide-inner-box a',
		'settings'            => 'slider_btn_txt',
		'render_callback'  => 'sbp_short_slider_btn_render_callback',
	
	) );
}

add_action( 'customize_register', 'sbp_short_register_slider_section_partials' );


function sbp_short_slider_image_render_callback() {
	return get_theme_mod( 'slider_image' );
}


function sbp_short_slider_title_render_callback() {
	return get_theme_mod( 'slider_title' );
}

function sbp_short_slider_iscription_render_callback() {
	return get_theme_mod( 'slider_discription' );
}

function sbp_short_slider_btn_render_callback() {
	return get_theme_mod( 'slider_btn_txt' );
}



if ( ! function_exists( 'sbp_short_top_contact_customize_register' ) ) :
function sbp_short_top_contact_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

/* Top Contact Section */
	$wp_customize->add_section( 'top_conatct_section' , array(
		'title'      => __('Top Contact settings', 'shortbuild'),
		'panel'  => 'home_page_settings',
		'priority'   => 1,
   	) );
		
		// Enable Contact
		$wp_customize->add_setting( 'home_page_top_contact_enabled',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'home_page_top_contact_enabled',
		   array(
			  'label' => esc_html__( 'Top Contact Enable/Disable' ),
			  'section' => 'top_conatct_section'
		   )
		) );
	
	
		//Top Contact Image
		$wp_customize->add_setting( 'short_top_contact_background',array('default' => SBP_PLUGIN_URL .'inc/short/images/topcall/tp-ct-bg.jpg',
		'sanitize_callback' => 'esc_url_raw', 'transport' => $selective_refresh,));
 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'short_top_contact_background',
				array(
					'type'        => 'upload',
					'label' => __('Image','shortbuild'),
					'settings' =>'short_top_contact_background',
					'section' => 'top_conatct_section',
					
				)
			)
		);
		
		// Top contact Image overlay
		$wp_customize->add_setting( 'short_top_contact_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('short_top_contact_overlay', array(
			'label'    => __('Enable callout image overlay', 'short' ),
			'section'  => 'top_conatct_section',
			'type' => 'checkbox',
		) );
		
		//Top Contact Background Overlay Color
		$wp_customize->add_setting( 'short_top_contact_overlay_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(0,0,0,0.30)',
            ) );	
            
            $wp_customize->add_control(new Short_Customize_Alpha_Color_Control( $wp_customize,'short_top_contact_overlay_color', array(
               'label'      => __('Top Contact overlay color','shortbuild' ),
                'palette' => true,
                'section' => 'top_conatct_section')
            ) );
	
		// Top Contact icon feature setting
		$wp_customize->add_setting( 'top_conact_one_icon',array(
		'default' => 'fa fa-diamond',
		));	
		$wp_customize->add_control( 'top_conact_one_icon',array(
		'label'   => __('Icon','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		// Top Conatct one title
		$wp_customize->add_setting( 'top_contact_one_title',array(
		'default' => __('We are Creators','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_one_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		//Top Contact section discription
		$wp_customize->add_setting( 'top_contact_one_description',array(
		'default' => 'Bachelor possible marianne directly confined relation',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_one_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));
		
		
		// Top Contact Two icon feature setting
		$wp_customize->add_setting( 'top_conact_two_icon',array(
		'default' => 'fa fa-lightbulb-o',
		));	
		$wp_customize->add_control( 'top_conact_two_icon',array(
		'label'   => __('Icon','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		// Top Conatct one title
		$wp_customize->add_setting( 'top_contact_two_title',array(
		'default' => __('Creative Ideas ','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_two_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		//Top Contact section discription
		$wp_customize->add_setting( 'top_contact_two_description',array(
		'default' => 'Frankness applauded by supported ye household.',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_two_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));
	
		
		// Top Contact Three icon feature setting
		$wp_customize->add_setting( 'top_conact_three_icon',array(
		'default' => 'fa fa-bullseye',
		));	
		$wp_customize->add_control( 'top_conact_three_icon',array(
		'label'   => __('Icon','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		// Top Conatct one title
		$wp_customize->add_setting( 'top_contact_three_title',array(
		'default' => __('Budget Friendly','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_three_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));	
		
		//Top Contact section discription
		$wp_customize->add_setting( 'top_contact_three_description',array(
		'default' => 'Satisfied conveying an dependent agreeable',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'top_contact_three_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'top_conatct_section',
		'type' => 'text',
		));
		
	
	
}
add_action( 'customize_register', 'sbp_short_top_contact_customize_register' );
endif;


/**
 * Add selective refresh for top contact section controls.
 */
function sbp_short_register_top_contact_section_partials( $wp_customize ){

	
	//Top Contact section
	$wp_customize->selective_refresh->add_partial( 'top_contact_one_title', array(
		'selector'            => '.first-top h4',
		'settings'            => 'top_contact_one_title',
		'render_callback'  => 'sbp_short_top_contact_one_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'top_contact_one_description', array(
		'selector'            => '.first-top h6',
		'settings'            => 'top_contact_one_description',
		'render_callback'  => 'sbp_short_top_contact_one_description_render_callback',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'top_contact_two_title', array(
		'selector'            => '.two-top h4',
		'settings'            => 'top_contact_two_title',
		'render_callback'  => 'sbp_short_top_contact_two_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'top_contact_two_description', array(
		'selector'            => '.two-top h6',
		'settings'            => 'top_contact_two_description',
		'render_callback'  => 'sbp_short_top_contact_two_description_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'top_contact_three_title', array(
		'selector'            => '.three-top h4',
		'settings'            => 'top_contact_three_title',
		'render_callback'  => 'sbp_short_top_contact_three_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'top_contact_three_description', array(
		'selector'            => '.three-top h6',
		'settings'            => 'top_contact_three_description',
		'render_callback'  => 'sbp_short_top_contact_three_description_render_callback',
	
	) );
}

add_action( 'customize_register', 'sbp_short_register_top_contact_section_partials' );


function sbp_short_top_contact_one_title_render_callback() {
	return get_theme_mod( 'top_contact_one_title' );
}


function sbp_short_top_contact_one_description_render_callback() {
	return get_theme_mod( 'top_contact_one_description' );
}

function sbp_short_top_contact_two_title_render_callback() {
	return get_theme_mod( 'top_contact_two_title' );
}


function sbp_short_top_contact_two_description_render_callback() {
	return get_theme_mod( 'top_contact_two_description' );
}

function sbp_short_top_contact_three_title_render_callback() {
	return get_theme_mod( 'top_contact_three_title' );
}


function sbp_short_top_contact_three_description_render_callback() {
	return get_theme_mod( 'top_contact_three_description' );
}



if ( ! function_exists( 'sbp_short_service_customize_register' ) ) :
function sbp_short_service_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

/* Services section */
	$wp_customize->add_section( 'services_section' , array(
		'title'      => __('Service settings', 'shortbuild'),
		'panel'  => 'home_page_settings',
		'priority'   => 1,
	) );
		
		$wp_customize->add_setting( 'service_section_show',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'service_section_show',
		   array(
			  'label' => esc_html__( 'Service Enable/Disable','short'),
			  'section' => 'services_section'
		   )
		) );
	
	
		// Service section title
		$wp_customize->add_setting( 'short_service_title',array(
		'default' => __('What We Do','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'short_service_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//Service section discription
		$wp_customize->add_setting( 'short_service_description',array(
		'capability'     => 'edit_theme_options',
		'default' =>  __('Why us','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'short_service_description',array(
		'label'   =>  __('Description','shortbuild'),
		'section' => 'services_section',
		'type' => 'textarea',
		));
		
		//Service section subtitle
		$wp_customize->add_setting( 'short_service_subtitle',array(
		'capability'     => 'edit_theme_options',
		'default' =>  __('Service','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'short_service_subtitle',array(
		'label'   =>  __('Subtitle','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		

		
		// Service icon feature setting
		$wp_customize->add_setting( 'service_one_icon',array(
		'default' => 'fa fa-newspaper-o',
		));	
		$wp_customize->add_control( 'service_one_icon',array(
		'label'   => __('Service Icon','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		
		
		// Service section title
		$wp_customize->add_setting( 'service_one_title',array(
		'default' => __('Strategic Planning','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_one_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//Service section discription
		$wp_customize->add_setting( 'service_one_description',array(
		'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_one_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'services_section',
		'type' => 'textarea',
		));
		
		
		// service read more button text
		$wp_customize->add_setting( 'ser_one_btn_text',array(
		'default' => __('Read more','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'ser_one_btn_text',array(
		'label'   => __('Button Text','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button link
		$wp_customize->add_setting( 'ser_one_btn_link',array(
		'default' => __('#','shortbuild'),
		));	
		$wp_customize->add_control( 'ser_one_btn_link',array(
		'label'   => __('Button Link','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button mtb
		$wp_customize->add_setting(
		'ser_one_btn_tab', 
			array(
			'default'        => false,
		));
		$wp_customize->add_control('ser_one_btn_tab', array(
			'label'   => __('Open link in new tab/window', 'shortbuild'),
			'section' => 'services_section',
			'type' => 'checkbox',
		));
		
		
		// Service icon two feature setting
		$wp_customize->add_setting( 'service_two_icon',array(
		'default' => 'fa fa-balance-scale',
		));	
		$wp_customize->add_control( 'service_two_icon',array(
		'label'   => __('Service Icon','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		
		
		// Service section title
		$wp_customize->add_setting( 'service_two_title',array(
		'default' => __('Trades & Stocks','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_two_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//Service section discription
		$wp_customize->add_setting( 'service_two_description',array(
		'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_two_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'services_section',
		'type' => 'textarea',
		));
		
		
		// service read more button text
		$wp_customize->add_setting( 'ser_two_btn_text',array(
		'default' => __('Read more','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'ser_two_btn_text',array(
		'label'   => __('Button Text','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button link
		$wp_customize->add_setting( 'ser_two_btn_link',array(
		'default' => '#',
		));	
		$wp_customize->add_control( 'ser_two_btn_link',array(
		'label'   => __('Button Link','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button tab
		$wp_customize->add_setting(
		'ser_two_btn_tab', 
			array(
			'default'        => false,
		));
		$wp_customize->add_control('ser_two_btn_tab', array(
			'label'   => __('Open link in new tab/window', 'shortbuild'),
			'section' => 'services_section',
			'type' => 'checkbox',
		));
		
		
		// Service icon three feature setting
		$wp_customize->add_setting( 'service_three_icon',array(
		'default' => 'fa fa-handshake-o',
		));	
		$wp_customize->add_control( 'service_three_icon',array(
		'label'   => __('Service Icon','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		
		
		// Service section title
		$wp_customize->add_setting( 'service_three_title',array(
		'default' => __('Bonds & Commodities','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_three_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));	
		
		//Service section discription
		$wp_customize->add_setting( 'service_three_description',array(
		'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'service_three_description',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'services_section',
		'type' => 'textarea',
		));
		
		
		// service read more button text
		$wp_customize->add_setting( 'ser_three_btn_text',array(
		'default' => __('Read more','shortbuild'),
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'ser_three_btn_text',array(
		'label'   => __('Button Text','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button link
		$wp_customize->add_setting( 'ser_three_btn_link',array(
		'default' => '#',
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'ser_three_btn_link',array(
		'label'   => __('Button Link','shortbuild'),
		'section' => 'services_section',
		'type' => 'text',
		));
		
		// service read more button tab
		$wp_customize->add_setting(
		'ser_three_btn_tab', 
			array(
			'default'        => false,
		));
		$wp_customize->add_control('ser_three_btn_tab', array(
			'label'   => __('Open link in new tab/window', 'shortbuild'),
			'section' => 'services_section',
			'type' => 'checkbox',
		));
	
}

add_action( 'customize_register', 'sbp_short_service_customize_register' );
endif;


/**
 * Selective refresh for service section
 */
function sbp_short_register_service_section_partials( $wp_customize ){

	//Service
	$wp_customize->selective_refresh->add_partial( 'short_service_title', array(
		'selector'            => '.service .mt-sec-title',
		'settings'            => 'short_service_title',
		'render_callback'  => 'sbp_short_service_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'short_service_description', array(
		'selector'            => '.service .mt-sec-subtitle',
		'settings'            => 'short_service_description',
		'render_callback'  => 'sbp_short_service_discription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'short_service_subtitle', array(
		'selector'            => '.service .mt-sec-backhead',
		'settings'            => 'short_service_subtitle',
		'render_callback'  => 'sbp_short_service_subtitle_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'service_one_title', array(
		'selector'            => '.first-service h4',
		'settings'            => 'service_one_title',
		'render_callback'  => 'sbp_short_service_one_title_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'service_one_description', array(
		'selector'            => '.first-service p',
		'settings'            => 'service_one_description',
		'render_callback'  => 'sbp_short_service_one_desc_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'ser_one_btn_text', array(
		'selector'            => '.first-service a',
		'settings'            => 'ser_one_btn_text',
		'render_callback'  => 'sbp_short_service_one_btn_render_callback',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'service_two_title', array(
		'selector'            => '.two-service h4',
		'settings'            => 'service_two_title',
		'render_callback'  => 'sbp_short_service_two_title_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'service_two_description', array(
		'selector'            => '.two-service p',
		'settings'            => 'service_two_description',
		'render_callback'  => 'sbp_short_service_two_desc_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'ser_two_btn_text', array(
		'selector'            => '.two-service a',
		'settings'            => 'ser_two_btn_text',
		'render_callback'  => 'sbp_short_service_two_btn_render_callback',
	
	) );
	
	
	//Service three
	$wp_customize->selective_refresh->add_partial( 'service_three_title', array(
		'selector'            => '.three-service h4',
		'settings'            => 'service_three_title',
		'render_callback'  => 'sbp_short_service_three_title_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'service_three_description', array(
		'selector'            => '.three-service p',
		'settings'            => 'service_three_description',
		'render_callback'  => 'sbp_short_service_three_desc_render_callback',
	
	) );
	$wp_customize->selective_refresh->add_partial( 'ser_three_btn_text', array(
		'selector'            => '.three-service a',
		'settings'            => 'ser_three_btn_text',
		'render_callback'  => 'sbp_short_service_three_btn_render_callback',
	
	) );
	
	
	
}

add_action( 'customize_register', 'sbp_short_register_service_section_partials' );


function sbp_short_service_title_render_callback() {
	return get_theme_mod( 'short_service_title' );
}

function sbp_short_service_discription_render_callback() {
	return get_theme_mod( 'short_service_description' );
}


function sbp_short_service_subtitle_render_callback() {
	return get_theme_mod( 'short_service_subtitle' );
}

//Service one

function sbp_short_service_one_title_render_callback() {
	return get_theme_mod( 'service_one_title' );
}

function sbp_short_service_one_desc_render_callback() {
	return get_theme_mod( 'service_one_description' );
}

function sbp_short_service_one_btn_render_callback() {
	return get_theme_mod( 'ser_one_btn_text' );
}


//Service two

function sbp_short_service_two_title_render_callback() {
	return get_theme_mod( 'service_two_title' );
}

function sbp_short_service_two_desc_render_callback() {
	return get_theme_mod( 'service_two_description' );
}

function sbp_short_service_two_btn_render_callback() {
	return get_theme_mod( 'ser_two_btn_text' );
}

//Service three

function sbp_short_service_three_title_render_callback() {
	return get_theme_mod( 'service_three_title' );
}

function sbp_short_service_three_desc_render_callback() {
	return get_theme_mod( 'service_three_description' );
}

function sbp_short_service_three_btn_render_callback() {
	return get_theme_mod( 'ser_three_btn_text' );
}

//Project Section
if ( ! function_exists( 'sbp_short_project_customizer' ) ) :
function sbp_short_project_customizer( $wp_customize ) {
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	/* project Section */
	$wp_customize->add_section( 'project_section' , array(
			'title'      => __('Project/Portfolio settings', 'shortbuild'),
			'panel'  => 'home_page_settings',
			'priority'   => 3,
		) );
		
		$wp_customize->add_setting( 'project_section_enable',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'project_section_enable',
		   array(
			  'label' => esc_html__( 'Project Enable/Disable' ),
			  'section' => 'project_section'
		   )
		) );
		
		// project section title
		$wp_customize->add_setting( 'home_short_portfolio_section_title',array(
		'capability'     => 'edit_theme_options',
		'default' => __('Our Projects','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_short_portfolio_section_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'project_section',
		'type' => 'text',
		));	
		
		//project section discription
		$wp_customize->add_setting( 'home_short_portfolio_section_discription',array(
		'capability'     => 'edit_theme_options',
		'default' => __('Recent Projects','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'home_short_portfolio_section_discription',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'project_section',
		'type' => 'textarea',
		));	
		
		// project section title
		$wp_customize->add_setting( 'short_project_subtitle',array(
		'default' => __('PROJECT','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'short_project_subtitle',array(
		'label'   => __('Subtitle','shortbuild'),
		'section' => 'project_section',
		'type' => 'text',
		));	
	 
	 
		//project one image
		$wp_customize->add_setting( 'project_image_one',array('default' => SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio1.jpg',
		'sanitize_callback' => 'esc_url_raw' ));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'project_image_one',
				array(
					'label' => __('Image','short'),
					'settings' =>'project_image_one',
					'section' => 'project_section',
					'type' => 'upload',
				)
			)
		);
		
		
		//project one Title
		$wp_customize->add_setting(
		'project_title_one', array(
			'default'        => __('Financial Project','short'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_title_one', array(
			'label'   => __('Title', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		//project one description
		$wp_customize->add_setting(
		'project_desc_one', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_desc_one', array(
			'label'   => __('Description', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		
		
		//project two image
		$wp_customize->add_setting( 'project_image_two',array('default' => SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio2.jpg',
		'sanitize_callback' => 'esc_url_raw'));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'project_image_two',
				array(
					'label' => __('Image','short'),
					'settings' =>'project_image_two',
					'section' => 'project_section',
					'type' => 'upload',
				)
			)
		);
		
		
		//project two Title
		$wp_customize->add_setting(
		'project_title_two', array(
			'default'        => __('Investment','short'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_title_two', array(
			'label'   => __('Title', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		//project two description
		$wp_customize->add_setting(
		'project_desc_two', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_desc_two', array(
			'label'   => __('Description', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		//project three image
		$wp_customize->add_setting( 'project_image_three',array('default' => SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio3.jpg',
		'sanitize_callback' => 'esc_url_raw',
		));
	 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'project_image_three',
				array(
					'label' => __('Image','short'),
					'settings' =>'project_image_three',
					'section' => 'project_section',
					'type' => 'upload',
				)
			)
		);
		
		//Portfolio three Title
		$wp_customize->add_setting(
		'project_title_three', array(
			'default'        => __('Invoicing','short'),
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_title_three', array(
			'label'   => __('Title', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		//Portfolio three description
		$wp_customize->add_setting(
		'project_desc_three', array(
			'default'        => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit..',
			'capability'     => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => $selective_refresh,
		));
		$wp_customize->add_control('project_desc_three', array(
			'label'   => __('Description', 'short'),
			'section' => 'project_section',
			'type' => 'text',
		));
		
		

}		
add_action( 'customize_register', 'sbp_short_project_customizer' );
endif;

/**
 * Add selective refresh for project section.
 */
function sbp_short_register_project_section_partials( $wp_customize ){

	
	//Portfolio section
	$wp_customize->selective_refresh->add_partial( 'home_short_portfolio_section_title', array(
		'selector'            => '.portfolio .mt-sec-title',
		'settings'            => 'home_short_portfolio_section_title',
		'render_callback'  => 'sbp_short_portfolio_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'home_short_portfolio_section_discription', array(
		'selector'            => '.portfolio .mt-sec-subtitle',
		'settings'            => 'home_short_portfolio_section_discription',
		'render_callback'  => 'sbp_short_portfolio_section_discription_render_callback',
	
	) );
	
		$wp_customize->selective_refresh->add_partial( 'short_project_subtitle', array(
		'selector'            => '.portfolio .mt-sec-backhead',
		'settings'            => 'short_project_subtitle',
		'render_callback'  => 'sbp_short_portfolio_section_discription_render_callback',
	
	) );
	
	//Project one
	$wp_customize->selective_refresh->add_partial( 'project_image_one', array(
		'settings'            => 'project_image_one',
		'selector'            => '.project-one figure',
		'render_callback'  => 'sbp_short_project_image_one_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'project_title_one', array(
		'selector'            => '.project-one h4',
		'settings'            => 'project_title_one',
		'render_callback'  => 'sbp_short_project_title_one_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'project_desc_one', array(
		'selector'            => '.project-one .entry-content p',
		'settings'            => 'project_desc_one',
		'render_callback'  => 'sbp_short_project_desc_one_render_callback',
	
	) );
	
	//Project two
	
	$wp_customize->selective_refresh->add_partial( 'project_image_two', array(
		'settings'            => 'project_image_two',
		'selector'            => '.project-two figure',
		'render_callback'  => 'sbp_short_project_image_two_render_callback',
	
	) );
	
	
	$wp_customize->selective_refresh->add_partial( 'project_title_two', array(
		'selector'            => '.project-two h4',
		'settings'            => 'project_title_two',
		'render_callback'  => 'sbp_short_project_title_two_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'project_desc_two', array(
		'selector'            => '.project-two .entry-content p',
		'settings'            => 'project_desc_two',
		'render_callback'  => 'sbp_short_project_desc_two_render_callback',
	
	) );
	
	
	//Project three
	$wp_customize->selective_refresh->add_partial( 'project_image_three', array(
		'settings'            => 'project_image_three',
		'selector'            => '.project-three figure',
		'render_callback'  => 'sbp_short_project_image_three_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'project_title_three', array(
		'selector'            => '.project-three h4',
		'settings'            => 'project_title_three',
		'render_callback'  => 'sbp_short_project_title_three_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'project_desc_three', array(
		'selector'            => '.project-three .entry-content p',
		'settings'            => 'project_desc_three',
		'render_callback'  => 'sbp_short_project_desc_three_render_callback',
	
	) );
	
	
	
}

add_action( 'customize_register', 'sbp_short_register_project_section_partials' );

//Project Section
function sbp_short_portfolio_section_title_render_callback() {
	return get_theme_mod( 'portfolio_section_title' );
}

function sbp_short_portfolio_section_discription_render_callback() {
	return get_theme_mod( 'portfolio_section_discription' );
}

//Project
function sbp_short_project_image_one_render_callback() {
	return get_theme_mod( 'project_img_one' );
}

function sbp_short_project_title_one_render_callback() {
	return get_theme_mod( 'project_title_one' );
}

function sbp_short_project_desc_one_render_callback() {
	return get_theme_mod( 'project_desc_one' );
}

function sbp_short_project_title_two_render_callback() {
	return get_theme_mod( 'project_title_two' );
}

function sbp_short_project_desc_two_render_callback() {
	return get_theme_mod( 'project_desc_two' );
}

function sbp_short_project_title_three_render_callback() {
	return get_theme_mod( 'project_title_three' );
}

function sbp_short_project_desc_three_render_callback() {
	return get_theme_mod( 'project_desc_three' );
}


//Callout
if ( ! function_exists( 'sbp_short_news_customize_register' ) ) :
function sbp_short_news_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

//Latest news Setting
	$wp_customize->add_section( 'news_section' , array(
				'title' => __('News settings', 'short'),
				'panel' => 'home_page_settings',
				'priority'   => 4,
	) );
		
			
			// Enable news section
			$wp_customize->add_setting( 'short_news_enable',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
			);
		 
			$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'short_news_enable',
		   array(
			  'label' => esc_html__( 'Latest News Enable/Disable','short' ),
			  'section' => 'news_section'
		   )
			) );

		
	
			$wp_customize->add_setting(
				'news_section_title', array(
				'capability' => 'edit_theme_options',
				'default' => __('News And Updates','short'),
				'transport' => $selective_refresh
			) );
			$wp_customize->add_control( 'news_section_title', array(
				'label' => __('News section title', 'short'),
				'section' => 'news_section',
				'type' => 'text',
			) );
			
			$wp_customize->add_setting(
				'news_section_description', array(
				'capability' => 'edit_theme_options',
				'default' => __('Recent Blog Posts','short'),
				'transport' => $selective_refresh
			) );
			$wp_customize->add_control( 'news_section_description', array(
				'label' => __('News section description', 'short'),
				'section' => 'news_section',
				'type' => 'textarea',
			) );
			
			// News section subtitle
			$wp_customize->add_setting( 'short_news_subtitle',array(
			'capability'     => 'edit_theme_options',
			'default' => __('NEWS','short'),
			'transport'         => $selective_refresh,
			));	
			$wp_customize->add_control( 'short_news_subtitle',array(
			'label'   => __('Subtitle','short'),
			'section' => 'news_section',
			'type' => 'text',
			));


}

add_action( 'customize_register', 'sbp_short_news_customize_register' );
endif;


/**
 * Add selective refresh for Front page section section controls.
 */
function sbp_short_register_home_section_selective_refresh( $wp_customize ){

	
	//News
	$wp_customize->selective_refresh->add_partial( 'news_section_title', array(
		'selector'            => '.blog .mt-sec-title',
		'settings'            => 'news_section_title',
		'render_callback'  => 'home_news_section_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'news_section_description', array(
		'selector'            => '.blog .mt-sec-subtitle',
		'settings'            => 'news_section_description',
		'render_callback'  => 'home_news_section_discription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'short_news_subtitle', array(
		'selector'            => '.blog .mt-sec-backhead',
		'settings'            => 'short_news_subtitle',
		'render_callback'  => 'home_news_section_subtitle_render_callback',
	
	) );

	
}

	add_action( 'customize_register', 'sbp_short_register_home_section_selective_refresh' );
	
	function home_news_section_title_render_callback() {
		return get_theme_mod( 'news_section_title' );
	}
	
	function home_news_section_discription_render_callback() {
		return get_theme_mod( 'news_section_description' );
	}
	
	function home_news_section_subtitle_render_callback() {
		return get_theme_mod( 'short_news_subtitle' );
	}


//Callout
if ( ! function_exists( 'sbp_short_callout_customize_register' ) ) :
function sbp_short_callout_customize_register($wp_customize){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';

/* Callout Section */
	$wp_customize->add_section( 'home_callout_section' , array(
		'title'      => __('Callout settings', 'shortbuild'),
		'panel'  => 'home_page_settings',
		'priority'   => 4,
   	) );
		
		
		$wp_customize->add_setting( 'homepage_callout_show',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'sbp_short_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Sbp_Short_Toggle_Switch_Custom_control( $wp_customize, 'homepage_callout_show',
		   array(
			  'label' => esc_html__( 'Callout Enable/Disable' ),
			  'section' => 'home_callout_section'
		   )
		) );

		//Callout background Image
		$wp_customize->add_setting( 'short_cta_background',array('default' => SBP_PLUGIN_URL .'inc/short/images/callout/callout-back.jpg',
		'sanitize_callback' => 'esc_url_raw', 'transport' => $selective_refresh,));
 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'short_cta_background',
				array(
					'type'        => 'upload',
					'label' => __('Image','shortbuild'),
					'settings' =>'short_cta_background',
					'section' => 'home_callout_section',
					
				)
			)
		);
		
		// Image overlay
		$wp_customize->add_setting( 'short_cta_overlay', array(
			'default' => true,
			'sanitize_callback' => 'sanitize_text_field',
		) );
		
		$wp_customize->add_control('short_cta_overlay', array(
			'label'    => __('Enable slider image overlay', 'shortbuild' ),
			'section'  => 'home_callout_section',
			'type' => 'checkbox',
		) );
		
		
		//Slider Background Overlay Color
		$wp_customize->add_setting( 'cta_overlay_section_color', array(
			'sanitize_callback' => 'sanitize_text_field',
			'default' => 'rgba(255, 255, 255, 0.8)',
            ) );	
            
            $wp_customize->add_control(new Short_Customize_Alpha_Color_Control( $wp_customize,'cta_overlay_section_color', array(
               'label'      => __('Callout image overlay color','shortbuild' ),
                'palette' => true,
                'section' => 'home_callout_section')
            ) );
		
		
		// callout title
		$wp_customize->add_setting( 'cta_title',array(
		'default' => __('Need Consultation','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'cta_title',array(
		'label'   => __('Title','shortbuild'),
		'section' => 'home_callout_section',
		'type' => 'text',
		));	
		
		//callout description
		$wp_customize->add_setting( 'cta_desc',array(
		'default' => 'Contact our customer support team if you have any further questions.',
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'cta_desc',array(
		'label'   => __('Description','shortbuild'),
		'section' => 'home_callout_section',
		'type' => 'textarea',
		));
		
		
		// callout button text
		$wp_customize->add_setting( 'cta_btn_lable',array(
		'default' => __('Get appointment','shortbuild'),
		'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'cta_btn_lable',array(
		'label'   => __('Button Text','shortbuild'),
		'section' => 'home_callout_section',
		'type' => 'text',
		));
		
		// Callout button link
		$wp_customize->add_setting( 'cta_btn_link',array(
		'default' => '#',
		//'transport'         => $selective_refresh,
		));	
		$wp_customize->add_control( 'cta_btn_link',array(
		'label'   => __('Button Link','short'),
		'section' => 'home_callout_section',
		'type' => 'text',
		));
		
		// Callout button target
		$wp_customize->add_setting(
		'cta_link_target', 
			array(
			'default'        => false,
		));
		$wp_customize->add_control('cta_link_target', array(
			'label'   => __('Open link in new tab/window', 'short'),
			'section' => 'home_callout_section',
			'type' => 'checkbox',
		));
		
		
		
}

add_action( 'customize_register', 'sbp_short_callout_customize_register' );
endif;


/**
 * Add selective refresh for Front page section section controls.
 */
function sbp_short_register_callout_section_partials( $wp_customize ){

	
	
	$wp_customize->selective_refresh->add_partial( 'cta_title', array(
		'selector'            => '.mt-calltoaction .title',
		'settings'            => 'cta_title',
		'render_callback'  => 'sbp_short_callout_section_title_render_callback',
	
	) );
	
	//Slider section
	$wp_customize->selective_refresh->add_partial( 'cta_desc', array(
		'selector'            => '.mt-calltoaction .subtitle',
		'settings'            => 'cta_desc',
		'render_callback'  => 'sbp_short_callout_section_desc_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'cta_btn_lable', array(
		'selector'            => '.mt-calltoaction a',
		'settings'            => 'cta_btn_lable',
		'render_callback'  => 'sbp_short_callout_btn_txt_render_callback',
	
	) );
}

add_action( 'customize_register', 'sbp_short_register_callout_section_partials' );


function sbp_short_callout_section_title_render_callback() {
	return get_theme_mod( 'cta_title' );
}

function sbp_short_callout_section_desc_render_callback() {
	return get_theme_mod( 'cta_desc' );
}

function sbp_short_callout_btn_txt_render_callback() {
	return get_theme_mod( 'cta_btn_lable' );
}


if ( ! function_exists( 'sbp_short_switch_sanitization' ) ) {
		function sbp_short_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
}

//Sanatize text validation
function sbp_short_home_page_sanitize_text( $input ) {

		return wp_kses_post( force_balance_mtgs( $input ) );
}