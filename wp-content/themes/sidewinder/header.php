<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'sidewinder' ), max( $paged, $page ) );

	?></title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link href="<?php echo strtolower(get_option('theme_favicon')); ?>" rel="shortcut icon" type="image/gif" />	
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/assets/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />

<!-- GRAB THE THEME SKIN --><?php $color = get_option("theme_color"); if (isset($color[0])) { ?>
<link href="<?php bloginfo('template_url'); ?>/assets/css/skins/<?php echo get_option('theme_color'); ?>/quick-styles.css" media="screen" rel="stylesheet" type="text/css" />	<?php } else { ?>	
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'template_url' ); ?>/assets/css/skins/Classic/quick-styles.css" />	
<?php } ?>

<!-- RSS & PINGBACK -->
<link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo('rss_url'); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo('atom_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<!-- GRAB THE CUFON FONT FILE -->
<?php if (get_option('theme_cufon') == 'None') {} 
else{ ?>	
	<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/assets/js/font.<?php echo get_option('theme_cufon'); ?>.js"></script>	
<?php } ?>
	



<!-- Custom CSS Modifications from the Admin Panel -->

<!-- Adjust the Base Font Style -->
 <?php if (get_option('theme_base_font') == 'Sans-Serif') { ?>
 		<style type="text/css">body{font-family: Helvetica, Arial, sans-serif !important; font-size: 12px;}</style>
 <?php } elseif (get_option('theme_base_font') == 'Serif') { ?>
 		<style type="text/css">body{font-family: Georgia, serif !important; font-size: 12px;}</style>
 <?php } else{}?>
 </style>

<!-- Show/hide taxonomy -->
<?php if (get_option('theme_taxonomy') == 'No') { ?>	
<style type="text/css">#identification{display: none !important;}</style>
<?php } else {} ?>

<!-- Adjust the nav width -->
<?php $navwidth = get_option("theme_navwidth"); if (isset($navwidth[0])) { ?>
	<style type="text/css">
	#sidebar{width: <?php echo get_option('theme_navwidth'); ?>;}
	</style>
<?php } else {} ?>

<!-- Add a custom bg if it exists. -->
<?php if(get_custom_field('custom_background_image')) { ?>
<style type="text/css">body {background: url('<?php echo get_custom_field('custom_background_image',true); ?>') top left fixed repeat;</style>  
<?php } else {} ?>

<!-- ADD THE CUSTOM CSS -->
<style type="text/css">
<?php echo get_option('theme_customcss'); ?>
</style>

<?php if(get_custom_field('custom_css')) { ?>
<style type="text/css"><?php echo get_custom_field('custom_css',true); ?></style>  
<?php } else {} ?> 

</head>
<body>