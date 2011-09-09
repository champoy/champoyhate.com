<?php


add_theme_support( 'nav-menus' );

register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'Tester' ),
	) );
	
function mytheme_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
       wp_nav_menu( array( 'menu_class' => 'sf-menu', 'theme_location' => 'primary' ) );
    else
        site_menu();
}



function site_menu($x="normal") {
	if(is_home()) { 
		$class=' class="home current_page_item"'; 
	} else {
		$class=' class="home"';
	}

	$home = get_option('theme_home_link'); 

	if($home=="Yes") {
		$home = '<li'.$class.'><a href="'.get_bloginfo('url').'">Home</a></li>';
	} else {
		$home = '';
	}

	if($x=="normal") {
		$menu = wp_list_pages('sort_column=menu_order&title_li=&echo=0');
		echo $home.$menu;
	} elseif($x=="footer") {
		$menu = wp_list_pages('echo=0&sort_column=menu_order&title_li=&include='.get_option('theme_footer_menu'));
		echo $home.$menu;
	}
}
?>