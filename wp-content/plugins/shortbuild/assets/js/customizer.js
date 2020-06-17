/* Customizer live prview js for homepage section */
( function( $ ) {

	
	//Slider title
	wp.customize(
		'slider_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-inner-box h1' ).text( newval );
				}
			);
		}
	);
	
	//Slider description
	wp.customize(
		'slider_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-inner-box p' ).text( newval );
				}
			);
		}
	);
	
	//Slider button
	wp.customize(
		'slider_btn_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.slide-inner-box a' ).text( newval );
				}
			);
		}
	);
	
	// Service Heading
	wp.customize(
		'short_service_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.mt-sec-title h1' ).text( newval );
				}
			);
		}
	);

	// Service Description
	wp.customize(
		'short_service_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service .mt-sec-subtitle' ).text( newval );
				}
			);
		}
	);
	
	// Service one title
	wp.customize(
		'service_one_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.first-service h4' ).text( newval );
				}
			);
		}
	);
	
	// Service one description
	wp.customize(
		'service_one_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.first-service p' ).text( newval );
				}
			);
		}
	);
	
	// Service one btn
	wp.customize(
		'ser_one_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.first-service a' ).text( newval );
				}
			);
		}
	);
	
	// Service two icon
	wp.customize(
		'service_two_icon', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-two i' ).text( newval );
				}
			);
		}
	);
	
	// Service two title
	wp.customize(
		'service_two_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.two-service h4' ).text( newval );
				}
			);
		}
	);
	
	// Service two description
	wp.customize(
		'service_two_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.two-service p' ).text( newval );
				}
			);
		}
	);
	
	// Service two btn
	wp.customize(
		'ser_one_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.two-service a' ).text( newval );
				}
			);
		}
	);
	
	
	// Service three icon
	wp.customize(
		'service_three_icon', function( value ) {
			value.bind(
				function( newval ) {
					$( '.service-three i' ).text( newval );
				}
			);
		}
	);
	
	// Service three title
	wp.customize(
		'service_three_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.three-service h4' ).text( newval );
				}
			);
		}
	);
	
	// Service three description
	wp.customize(
		'service_three_description', function( value ) {
			value.bind(
				function( newval ) {
					$( '.three-service p' ).text( newval );
				}
			);
		}
	);
	
	// Service three btn
	wp.customize(
		'ser_three_btn_text', function( value ) {
			value.bind(
				function( newval ) {
					$( '.three-service a' ).text( newval );
				}
			);
		}
	);
	
	// Callout title
	wp.customize(
		'callout_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.short-callout p' ).text( newval );
				}
			);
		}
	);
	
	//Callout description
	wp.customize(
		'callout_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.short-callout .short-callout-inner h3' ).text( newval );
				}
			);
		}
	);
	
	//Callout btn text
	wp.customize(
		'callout_btn_txt', function( value ) {
			value.bind(
				function( newval ) {
					$( '.short-callout a' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio Heading
	wp.customize(
		'portfolio_section_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.short-portfolio .short-heading h3' ).text( newval );
				}
			);
		}
	);

	// Portfolio Description
	wp.customize(
		'portfolio_section_discription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.short-portfolio .short-heading p' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio one title
	wp.customize(
		'project_title_one', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-one h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio one description
	wp.customize(
		'project_desc_one', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-one .short-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	
	// Portfolio two title
	wp.customize(
		'project_title_two', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-two h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio two description
	wp.customize(
		'project_desc_two', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-two .short-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three image
	wp.customize(
		'project_image_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.port3 .post-thumbnail' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three title
	wp.customize(
		'project_title_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-three h5' ).text( newval );
				}
			);
		}
	);
	
	// Portfolio three description
	wp.customize(
		'project_desc_three', function( value ) {
			value.bind(
				function( newval ) {
					$( '.project-three .short-portfolio-block p' ).text( newval );
				}
			);
		}
	);
	
	// Call to action title
	wp.customize(
		'cta_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.mt-calltoaction .title' ).text( newval );
				}
			);
		}
	);
	
	
	wp.customize(
		'cta_desc', function( value ) {
			value.bind(
				function( newval ) {
					$( '.mt-calltoaction .subtitle' ).text( newval );
				}
			);
		}
	);
	
	wp.customize(
		'cta_btn_lable', function( value ) {
			value.bind(
				function( newval ) {
					$( '.mt-calltoaction a' ).text( newval );
				}
			);
		}
	);
	
	
	
	
	
} )( jQuery );