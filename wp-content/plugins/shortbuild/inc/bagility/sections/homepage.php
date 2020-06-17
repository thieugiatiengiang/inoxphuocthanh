<?php
if ( ! function_exists( 'sbp_short_top_contact' ) ) :
function sbp_short_top_contact() {
?>
<!--- Top contact section -->
<?php $home_page_top_contact_enabled = get_theme_mod('home_page_top_contact_enabled','on');
if($home_page_top_contact_enabled !='off'){
	
$short_top_contact_background = get_theme_mod('short_top_contact_background',SBP_PLUGIN_URL .'inc/short/images/topcall/tp-ct-bg.jpg');	
$top_conact_one_icon = get_theme_mod('top_conact_one_icon','fa fa-diamond');
$top_contact_one_title = get_theme_mod('top_contact_one_title','We are Creators');
$top_contact_one_description = get_theme_mod('top_contact_one_description','Bachelor possible marianne directly confined relation');

$top_conact_two_icon = get_theme_mod('top_conact_two_icon','fa fa-lightbulb-o');
$top_contact_two_title = get_theme_mod('top_contact_two_title','Creative Ideas');
$top_contact_two_description = get_theme_mod('top_contact_two_description','Frankness applauded by supported ye household');

$top_conact_three_icon = get_theme_mod('top_conact_three_icon','fa fa-bullseye');
$top_contact_three_title = get_theme_mod('top_contact_three_title','Budget Friendly');
$top_contact_three_description = get_theme_mod('top_contact_three_description','Satisfied conveying an dependent agreeable');
	
?>

<?php if($short_top_contact_background != '') { ?> 
<!--container-->
<div class="container mt-top-ct-area" style="background:url('<?php echo esc_url($short_top_contact_background);?>') center center no-repeat; ">
	<?php } else { ?>
<div class="container mt-top-ct-area">
<?php } 
$short_top_contact_overlay_color = get_theme_mod('short_top_contact_overlay_color','rgba(2, 7, 27, 0.4)');
$short_top_contact_overlay = get_theme_mod('short_top_contact_overlay',true);
?>	 
<div class="overlay"<?php if($short_top_contact_overlay != false) { ?>style="background-color:<?php echo $short_top_contact_overlay_color; } ?> "> 
		<div class="row">
			<div class="col-md-4">
				<div class="mt-ct-info-wid">
					<div class="media">
						<div class="mt-ct-icon"><i class="<?php echo $top_conact_one_icon; ?>"></i></div>
						<div class="media-body first-top">
							<h4><?php echo $top_contact_one_title; ?></h4>
							<h6><?php echo $top_contact_one_description; ?></h6>
						</div>
					</div>
				</div>
			</div>
	
			<div class="col-md-4">
				<div class="mt-ct-info-wid">
					<div class="media">
						<div class="mt-ct-icon"><i class="<?php echo $top_conact_two_icon; ?>"></i></div>
						<div class="media-body two-top">
							<h4><?php echo $top_contact_two_title; ?></h4>
							<h6><?php echo $top_contact_two_description; ?></h6>
						</div>
					</div>
				</div>
			</div>	

			<div class="col-md-4">
				<div class="mt-ct-info-wid">
					<div class="media">
						<div class="mt-ct-icon"><i class="<?php echo $top_conact_three_icon; ?>"></i></div>
						<div class="media-body three-top">
							<h4><?php echo $top_contact_three_title; ?></h4>
							<h6><?php echo $top_contact_three_description; ?></h6>
						</div>
					</div>
				</div>		
			</div>
		</div>
	</div>
</div>
<?php
}
	}

endif;

if ( function_exists( 'sbp_short_top_contact' ) ) {
$homepage_section_priority = apply_filters( 'sbp_short_homepage_section_priority', 11, 'sbp_short_top_contact' );
add_action( 'sbp_short_homepage_sections', 'sbp_short_top_contact', absint( $homepage_section_priority ) );

}


/*** Service */
if ( ! function_exists( 'sbp_short_service' ) ) :

	function sbp_short_service() {

		$short_service_title = get_theme_mod('short_service_title',__('What We Do','shortbuild'));
		$short_service_description = get_theme_mod('short_service_description','Why us');
		$short_service_subtitle = get_theme_mod('short_service_subtitle','SERVICE');
		
		$service_section_show = get_theme_mod('service_section_show','on');
		if($service_section_show !='off')
		{	
		?>
	    <!-- Section Title -->
<section id="section" class="service">	
	<div class="container">	
		<?php if( ($short_service_title) || ($short_service_description)!='' ) { ?>
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="mt-sec-head">
					<?php if ( ! empty( $short_service_subtitle )) { ?>
					<div class="mt-sec-backhead"><?php echo $short_service_subtitle; ?></div>
					<?php } if ( ! empty( $short_service_title )) { ?>
					<h4 class="mt-sec-subtitle"><?php echo $short_service_title; ?></h4>
					<?php } if($short_service_description) { ?>
					<h1 class="mt-sec-title"><?php echo $short_service_description; ?></h1>
					<?php } ?>
					<div class="divider-line"></div>
				</div>
			</div>
	</div>
		<!-- /Section Title -->
		<?php } ?>
			<div class="row">
			  <div class="col-md-4 col-sm-6 col-xs-12">
					<article class="mt-service-wid first-service">
					<?php  $service_one_icon = get_theme_mod('service_one_icon','fa fa-newspaper-o'); ?>
						<div class="mt-ser-icon"><i class="<?php echo $service_one_icon; ?>"></i></div>
						<div class="mt-ser-title">
						<?php  $service_one_title = get_theme_mod('service_one_title','Strategic Planning'); ?>
							<h4><?php echo $service_one_title; ?></h4>
						</div>		
						<div class="mt-ser-content">
							<?php  $service_one_description = get_theme_mod('service_one_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); ?>
							<p><?php echo $service_one_description; ?></p>				
							<p><?php 
					$ser_one_btn_link = get_theme_mod('ser_one_btn_link','#');
					$ser_one_btn_text = get_theme_mod('ser_one_btn_text',__('Read More','#'));
					$ser_one_btn_tab = get_theme_mod('ser_one_btn_tab',false);
					if($ser_one_btn_text !='')
					{ ?>
					<a href="<?php echo esc_url($ser_one_btn_link); ?>" <?php if($ser_one_btn_tab == true){ echo 'target="_blank"';}?> class="btn-theme"><?php echo $ser_one_btn_text ; ?></a>	
					<?php } ?></p>		
						</div>
					</article> 
				</div>
				
				<div class="col-md-4 col-sm-6 col-xs-12">
					<article class="mt-service-wid two-service">
					<?php  $service_two_icon = get_theme_mod('service_two_icon','fa fa-balance-scale'); ?>
						<div class="mt-ser-icon"><i class="<?php echo  $service_two_icon; ?>"></i></div>
						<div class="mt-ser-title">
						<?php  $service_two_title = get_theme_mod('service_two_title','Trades & Stocks'); ?>
							<h4><?php echo $service_two_title; ?></h4>
						</div>		
						<div class="mt-ser-content">
							<?php  $service_two_description = get_theme_mod('service_two_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); ?>
							<p><?php echo $service_two_description; ?></p>				
							<p><?php 
					$ser_two_btn_link = get_theme_mod('ser_two_btn_link','#');
					$ser_two_btn_text = get_theme_mod('ser_two_btn_text',__('Read More','#'));
					$ser_two_btn_tab = get_theme_mod('ser_two_btn_tab',false);
					if($ser_two_btn_text !='')
					{ ?>
					<a href="<?php echo esc_url($ser_two_btn_link); ?>" <?php if($ser_two_btn_tab == true){ echo 'target="_blank"';}?> class="btn-theme"><?php echo $ser_two_btn_text ; ?></a>	
					<?php } ?></p>		
						</div>
					</article> 
				</div>
				
				<div class="col-md-4 col-sm-6 col-xs-12">
					<article class="mt-service-wid three-service">
					<?php  $service_three_icon = get_theme_mod('service_three_icon','fa fa-handshake-o'); ?>
						<div class="mt-ser-icon"><i class="<?php echo  $service_three_icon; ?>"></i></div>
						<div class="mt-ser-title">
						<?php  $service_three_title = get_theme_mod('service_three_title','Bonds & Commodities'); ?>
							<h4><?php echo $service_three_title; ?></h4>
						</div>		
						<div class="mt-ser-content">
							<?php  $service_three_description = get_theme_mod('service_three_description','Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'); ?>
							<p><?php echo $service_three_description; ?></p>				
							<p><?php 
					$ser_three_btn_link = get_theme_mod('ser_three_btn_link','#');
					$ser_three_btn_text = get_theme_mod('ser_three_btn_text',__('Read More','#'));
					$ser_three_btn_tab = get_theme_mod('ser_three_btn_tab',false);
					if($ser_three_btn_text !='')
					{ ?>
					<a href="<?php echo esc_url($ser_three_btn_link); ?>" <?php if($ser_three_btn_tab == true){ echo 'target="_blank"';}?> class="btn-theme"><?php echo $ser_three_btn_text ; ?></a>	
					<?php } ?></p>		
						</div>
					</article> 
				</div>
			  
			  
			  
	</div>
</section>
<?php		} }

endif;
if ( function_exists( 'sbp_short_service' ) ) {
	$homepage_section_priority = apply_filters( 'sbp_short_homepage_section_priority', 12, 'sbp_short_service' );
	add_action( 'sbp_short_homepage_sections', 'sbp_short_service', absint( $homepage_section_priority ) );
}

/**
 * Portfolio
 */
if ( ! function_exists( 'sbp_short_portfolio' ) ) :

	function sbp_short_portfolio() {
		
		$home_short_portfolio_section_title = get_theme_mod('home_short_portfolio_section_title',__('Recent Projects','shortbuild'));
		$home_short_portfolio_section_discription = get_theme_mod('home_short_portfolio_section_discription','Our Projects');
		$short_project_subtitle = get_theme_mod('short_project_subtitle','PROJECT');
		
		$project_image_one = get_theme_mod('project_image_one',SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio1.jpg');
		$project_title_one = get_theme_mod('project_title_one',__('Financial Project','short'));
		$project_desc_one = get_theme_mod('project_desc_one','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		
		$project_image_two = get_theme_mod('project_image_two',SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio2.jpg');
		$project_title_two = get_theme_mod('project_title_two',__('Investment','short'));
		$project_desc_two = get_theme_mod('project_desc_two','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		
		
		$project_image_three = get_theme_mod('project_image_three',SBP_PLUGIN_URL .'inc/short/images/portfolio/portfolio3.jpg');
		$project_title_three = get_theme_mod('project_title_three',__('Invoicing','short'));
		$project_desc_three = get_theme_mod('project_desc_three','Lorem ipsum dolor sit amet, consectetur adipisicing elit..');
		
		$project_section_enable = get_theme_mod('project_section_enable','on');
		if($project_section_enable !='off'){
		?>		
<!-- Portfolio Section -->
<section id="section" class="portfolio">
    <div class="container">
      <div class="row">
        <?php if( ($home_short_portfolio_section_title) || ($home_short_portfolio_section_discription)!='' ) { ?>
		<!-- Section Title -->
		<div class="col-md-12 text-center">
			<div class="mt-sec-head">
				<div class="mt-sec-backhead"><?php echo $short_project_subtitle; ?></div>
				<h4 class="mt-sec-subtitle"><?php echo $home_short_portfolio_section_discription; ?></h4>
				<h1 class="mt-sec-title"><?php echo $home_short_portfolio_section_title; ?></h1>
				<div class="divider-line"></div>
			</div>
		</div>
		 
		 
		<!-- /Section Title -->
		<?php } ?>
      </div>
    <!--container-->
      <!--row-->
      <div class="row">
        <!--portfolio-->
          <!--item-->
			<!--col-md-12-->
            <div class="col-md-4 col-sm-6 col-xs-12 project-one">
				<article class="mt-portfolio-wid">
				  <!--portfolio-->
					  <figure class="post-thumbnail">
						  <img src="<?php echo $project_image_one; ?>" alt="">
					  </figure>
					  <div class="post-content text-center">
						 <header class="mt-header">
							<h4 class="mt-title"><a href="#"><?php echo $project_title_one; ?></a></h4>
						</header>	
						<div class="entry-content"><p><?php echo $project_desc_one; ?></p></div>
					  </div>  
				  <!--/portfolio-->
				  </article>
			 </div>
			
			<div class="col-md-4 col-sm-6 col-xs-12 project-two">
				<article class="mt-portfolio-wid">
				  <!--portfolio-->
					  <figure class="post-thumbnail">
						  <img src="<?php echo $project_image_two; ?>" alt="">
					  </figure>
					  <div class="post-content text-center">
						 <header class="mt-header">
							<h4 class="mt-title"><a href="#"><?php echo $project_title_two; ?></a></h4>
						</header>	
						<div class="entry-content"><p><?php echo $project_desc_two; ?></p></div>
					  </div>  
				  <!--/portfolio-->
				  </article>
			 </div>
			 
			 <div class="col-md-4 col-sm-6 col-xs-12 project-three">
				<article class="mt-portfolio-wid">
				  <!--portfolio-->
					  <figure class="post-thumbnail">
						  <img src="<?php echo $project_image_three; ?>" alt="">
					  </figure>
					  <div class="post-content text-center">
						 <header class="mt-header">
							<h4 class="mt-title"><a href="#"><?php echo $project_title_three; ?></a></h4>
						</header>	
						<div class="entry-content"><p><?php echo $project_desc_three; ?></p></div>
					  </div>  
				  <!--/portfolio-->
				  </article>
			 </div>
        </div>
        <!--/portfolio-->
      <!--/row-->
    </div>
    <!--/conshortiner-->
  </section>
<!-- /Portfolio Section -->

<div class="clearfix"></div>	
<?php } }

endif;

		if ( function_exists( 'sbp_short_portfolio' ) ) {
		$homepage_section_priority = apply_filters( 'sbp_short_homepage_section_priority', 13, 'sbp_short_portfolio' );
		add_action( 'sbp_short_homepage_sections', 'sbp_short_portfolio', absint( $homepage_section_priority ) );

		}
/**
 * Callout section
 */
if ( ! function_exists( 'sbp_short_callout' ) ) :

	function sbp_short_callout() {
		
		$short_cta_background = get_theme_mod('short_cta_background',SBP_PLUGIN_URL .'inc/short/images/callout/callout-back.jpg');
		$cta_overlay_section_color = get_theme_mod('cta_overlay_section_color');
		$cta_title = get_theme_mod('cta_title',__('Need Consultation','short'));
		$cta_desc = get_theme_mod('cta_desc','Contact our customer support team if you have any further questions.');
		$cta_btn_lable = get_theme_mod('cta_btn_lable',__('Get appointment','short'));
		$cta_btn_link = get_theme_mod('cta_btn_link','#');
		$cta_link_target = get_theme_mod('cta_link_target',true);
		$short_cta_overlay = get_theme_mod('short_cta_overlay');
		$homepage_callout_show = get_theme_mod('homepage_callout_show','on');
		if($homepage_callout_show !='off'){
		?>		
<?php if($short_cta_background != '') { ?> 
<!--container-->
<section class="mt-calltoaction theme-default" style="background:url('<?php echo esc_url($short_cta_background);?>') no-repeat center center /cover; ">
	<?php } else { ?>
<section class="mt-calltoaction theme-default">
<?php } 
?>	 
<div class="overlay"<?php if($short_cta_overlay != false) { ?>style="background-color:<?php echo $cta_overlay_section_color; } ?> "> 
<div class="container">
  <div class="row"> 
	<div class="col-md-12 col-sm-12 col-xs-12 text-center">
	  <h2 class="title"><?php echo $cta_title; ?></h2>
	  <p class="subtitle"><?php echo $cta_desc; ?></p>
	  <div class="m-top-40">
		<a class="btn-theme" href="<?php echo $cta_btn_link; ?>" <?php if($cta_link_target) { ?> target="_blank" <?php } ?>><?php echo $cta_btn_lable; ?></a>
	  </div>
	</div>  
  </div>      
</div>
</div>
</section>	
<?php } }

endif;

		if ( function_exists( 'sbp_short_callout' ) ) {
		$homepage_section_priority = apply_filters( 'sbp_short_homepage_section_priority', 15, 'sbp_short_callout' );
		add_action( 'sbp_short_homepage_sections', 'sbp_short_callout', absint( $homepage_section_priority ) );

}

/**
 * News section
 */
if ( ! function_exists( 'sbp_news_section' ) ) :

	function sbp_news_section() {

$short_news_enable = get_theme_mod('short_news_enable','on');
if($short_news_enable !='off'){
?>		
<!--/conshortiner-->
<section id="section" class="blog">
	<div class="container">
      <!--container-->
        <!--row-->
        <div class="row">
			<div class="col-md-12">
				<div class="mt-sec-head text-center">
					<?php $short_news_subtitle = get_theme_mod('short_news_subtitle',__('NEWS','short'));?>
					<div class="mt-sec-backhead"><?php echo $short_news_subtitle; ?></div>
					<?php $news_section_title = get_theme_mod('news_section_title',__('News And Updates','short'));?>
					<h4 class="mt-sec-subtitle"><?php echo esc_attr($news_section_title);?></h4>
				<?php $news_section_description = get_theme_mod('news_section_description',__('Recent Blog Posts','short'));?>
					<h1 class="mt-sec-title"><?php echo esc_attr($news_section_description);?></h1>
					<div class="divider-line"></div>
				</div>
			</div>
		</div>
        <!--/row-->
        <!--row-->
        <div class="row">
          
          <!--col-md-4-->
		  <?php $short_latest_loop = new WP_Query(array( 'post_type' => 'post', 'posts_per_page' => 3, 'order' => 'DESC','ignore_sticky_posts' => true, ''));
			if ( $short_latest_loop->have_posts() ) :
			 while ( $short_latest_loop->have_posts() ) : $short_latest_loop->the_post();?>
          <div class="col-md-4 col-sm-6 col-xs-12">
			<article class="mt-post"> 
              <?php if(has_post_thumbnail()){ ?>
			  <figure class="mt-post-thumbnail">
                  <?php $defalt_arg =array('class' => "img-responsive"); ?>
				  <?php the_post_thumbnail('', $defalt_arg); ?>
			  </figure>
			  <?php } ?>
			  <div class="mt-post-content">
					<div class="mt-post-meta">
						<span class="mt-date"><a href="#"><time><?php echo get_the_date('M'); ?> <?php echo get_the_date('j,'); ?> <?php echo get_the_date('Y'); ?></time></a></span>
						<span class="byline"><span class="author vcard">
						<a class="url fn n" href="<?php the_permalink(); ?>"> <?php the_author(); ?> </a>
						</span></span>
					</div>
					<header class="mt-header">		
						<h3 class="mt-title"><a href="<?php echo esc_url(get_permalink()); ?>" title="<?php the_title_attribute(); ?>"><?php echo get_the_title() ?></a></h3>	
					</header>					
					<div class="entry-content">
						<?php the_content(__('Read More','short')); ?>
					</div>
				</div>
              </article>
            </div>
		   <?php endwhile; endif;	wp_reset_postdata(); ?>
          <!--/col-md-4-->
           </div>
        </div>
        <!--/row-->
      </div>
      <!--/col-md-6-->
    </div>
</section>
<!-- /Portfolio Section -->

<div class="clearfix"></div>	
<?php } } 

endif;
		if ( function_exists( 'sbp_news_section' ) ) {
		$homepage_section_priority = apply_filters( 'sbp_short_homepage_section_priority', 14, 'sbp_news_section' );
		add_action( 'sbp_short_homepage_sections', 'sbp_news_section', absint( $homepage_section_priority ) );
}