<?php
/**
 * Enqueue scripts and styles.
 */
function bellaworks_scripts() {
	//wp_enqueue_style( 'bellaworks-style', get_stylesheet_uri() );
       
  wp_enqueue_style( 'swiper-style', 'https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css' );
  wp_enqueue_style('bellaworks-style', get_stylesheet_directory_uri() .'/style.min.css', array(), '1.0' );  

  wp_deregister_script('jquery');
  wp_register_script('jquery', get_stylesheet_directory_uri() . '/assets/js/jquery.min.js', false, '3.7.1', false);
  wp_enqueue_script('jquery');

  // wp_enqueue_script( 
  // 	'jquery-migrate','https://code.jquery.com/jquery-migrate-1.4.1.min.js', 
  // 	array(), '20200713', 
  // 	false 
  // );

  wp_enqueue_script( 
    'vimeo-player', 
    'https://player.vimeo.com/api/player.js', 
    array(), '2.12.2', true 
  );

  wp_enqueue_script( 
    'bellaworks-cplugin', 
    get_template_directory_uri() . '/assets/js/plugins.min.js', 
    array(), '20220202', true 
  );

  wp_enqueue_script( 
    'aos-script', 
    'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', 
    array(), '2.3.4', true 
  );

  wp_enqueue_script( 
    'swiper-bundle.min', 
    'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', 
    array(), 'swiper-bundle.min', true 
  );

  wp_enqueue_script( 
    'bellaworks-masonry', 
    get_template_directory_uri() . '/assets/js/masonry.min.js', 
    array(), '4.2.2', true 
  );

  wp_enqueue_script( 
    'bellaworks-custom', 
    get_template_directory_uri() . '/assets/js/custom/custom.js', 
    array(), '20250226', true 
  );

	wp_localize_script( 'bellaworks-custom', 'frontajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' )
	));

	
	wp_enqueue_script( 
		'font-awesome', 
		'https://use.fontawesome.com/8f931eabc1.js', 
		array(), '20180424', 
		true 
	);



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bellaworks_scripts' );




