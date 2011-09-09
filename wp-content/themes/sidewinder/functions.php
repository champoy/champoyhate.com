<?php

if(!defined('WP_THEME_URL')) {
	define( 'WP_THEME_URL', get_bloginfo('stylesheet_directory'));
}

include('widgets/search_widget.php');
include('widgets/social_widget.php');
include('functions/theme-panel.php');
include('functions/shortcodes.php');
include('functions/custom-field.php');

/**
* Initiate Theme Options
*
* @uses wp_deregister_script()
* @uses wp_register_script()
* @uses wp_enqueue_script()
* @uses register_nav_menus()
* @uses add_theme_support()
* @uses is_admin()
*
* @access public
* @since 1.0.0
*
* @return void
*/

function init_sidewinder() {

	if(!is_admin()){
	
		/* Register all scripts */
		wp_deregister_script( 'jquery' );
    	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js');
    	wp_enqueue_script( 'jquery' );
    	
    	wp_register_script( 'jQueryEasing', WP_THEME_URL . '/assets/js/jquery.easing.js');
    	wp_enqueue_script( 'jQueryEasing' );
    	
    	wp_register_script( 'vGrid', WP_THEME_URL . '/assets/js/jquery.vgrid.js');
    	wp_enqueue_script( 'vGrid' );
    	
    	wp_register_script( 'Tipsy', WP_THEME_URL . '/assets/js/jquery.tipsy.js');
    	wp_enqueue_script( 'Tipsy' );
    	
    	wp_register_script( 'prettyPhoto', WP_THEME_URL . '/assets/js/jquery.prettyPhoto.js');
    	wp_enqueue_script( 'prettyPhoto' ); 
    	    	
    	wp_register_script( 'Cufon', WP_THEME_URL . '/assets/js/cufon.js');
    	wp_enqueue_script( 'Cufon' ); 
    	
    	wp_register_script( 'URLInternal', WP_THEME_URL . '/assets/js/jquery.ba-urlinternal.min.js');
    	wp_enqueue_script( 'URLInternal' );
    	
    	wp_register_script( 'Address', WP_THEME_URL . '/assets/js/jquery.address-1.3.1.min.js');
    	wp_enqueue_script( 'Address' );
    	
    	wp_register_script( 'Sidewinder', WP_THEME_URL . '/assets/js/sidewinder.js');
    	wp_enqueue_script( 'Sidewinder' );
    	
    }
    
    /* Register Navigation */
    register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'sidewinder' ),
	) );
	
	/* Register Primary Sidebar */
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'sidewinder' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'sidewinder' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
	
	/* Register Secondary Sidebar (Right side, next to posts/pages) */
	register_sidebar( array(
		'name' => __( 'Secondary Widget Area', 'sidewinder' ),
		'id' => 'secondary-widget-area',
		'description' => __( 'The secondary widget area for the right side of posts and pages', 'sidewinder' ),
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li><div class="widget-divider"></div>',
		'before_title' => '<h2 class="widget-title">',
		'after_title' => '</h2>',
	) );
		
}    

/* ---- ---- ---- ---- ---- ---- ---- ---- ---- ---- */

/* Add "Post Thumbnails" Support */
add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 200, 130, true );
add_custom_background();


add_action('init', 'init_sidewinder');
add_action('widgets_init', create_function('', 'return register_widget("SearchWidget");'));
add_action('widgets_init', create_function('', 'return register_widget("SocialWidget");'));


// Redirect To Theme Options Page on Activation
if ($_GET['activated']){
wp_redirect(admin_url("admin.php?page=theme-panel.php&saved=true"));
}

?>