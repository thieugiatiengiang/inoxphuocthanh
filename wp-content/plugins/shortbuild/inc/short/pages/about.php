<?php
	// Create a about us page 
	 $post = array(
		  'comment_status' => 'closed',
		  'ping_status' =>  'closed' ,
		  'post_author' => 1,
		  'post_date' => date('Y-m-d H:i:s'),
		  'post_name' => 'About',
		  'post_status' => 'publish' ,
		  'post_title' => 'About',
		  'post_type' => 'page',
		  'post_content' => '<h3 class="widget-title">About Us !</h3>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac lorem pretium, laoreet enim at, malesuada elit. Class aptent taciti sociosqu. Duis congue turpis risus, ac dapibus mi malesuada ut. Duis feugiat nisi orci.Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean ac lorem pretium, laoreet enim at, malesuada elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Phasellus vulputat .</p>'
	);  
	//insert page and save the id
	$newvalue = wp_insert_post( $post, false );
	if ( $newvalue && ! is_wp_error( $newvalue ) ){
		update_post_meta( $newvalue, '_wp_page_template', 'templates/about.php' );
	}
?>