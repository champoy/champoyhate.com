<!-- Sidebar -->
	<div id="sidebar">	
		
		<!-- BEGIN LOGO -->
		<div class="logo">		
		<?php $logopath = (get_option('theme_logo')) ? get_option('theme_logo') : get_bloginfo('template_directory') . "/assets/img/logo.png"; ?>    		    		

        <a id="logolink" href="<?php bloginfo('url') ?>/" title="<?php echo bloginfo('blog_name'); ?>"><img id="logotype" src="<?php echo $logopath; ?>" alt="<?php echo bloginfo('blog_name'); ?>" /></a>
                
		</div>		
		<!-- END LOGO -->		
		
		<!-- Navigation -->
		<?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary', 'menu_class' => 'navigation' ) ); ?>
		
		<?php if (is_front_page()) { ?>
		<?php if (get_option('theme_shuffle_link') == 'Yes') { ?>
		<ul class="navigation" id="shuffle"><li class="page_item"><a href="#" id="rsort"><?php echo strtolower(get_option('theme_shuffle_text')); ?></a></li></ul>
		<?php } else {} } ?>
		
		<!-- Box -->
		<div class="box">
		<?php if ( is_active_sidebar( 'primary-widget-area' ) ) : ?>
			<ul class="widget-area">
				<?php dynamic_sidebar( 'primary-widget-area' ); ?>
			</ul>
		<?php endif; ?>
		</div>
		<!-- </Box -->
		
		<div class="close_dot"></div>
	</div>
<!-- </Sidebar -->