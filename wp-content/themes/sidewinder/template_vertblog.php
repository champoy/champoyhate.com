<?php
/*
 * Template Name: Traditional Blog
*/

get_header();
?>
<?php get_sidebar(); ?>
	
						
<!-- CONTENT CONTAINER -->
<div id="content" class="no-grid">
		
	<!-- INNER WRAPPER -->
	<div id="inner" class="entry-container">
									
		<!-- ENTRY COLUMN -->
		<div id="entry" class="vert-blog">				
				
			<!-- 404 MESSAGE -->
			<?php if ( ! have_posts() ) : ?>
				<h1><?php _e( 'Not Found', 'sidewinder' ); ?></h1>
				<div class="the_content">	
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sidewinder' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
			
			<div id="page-title"><h1><?php the_title(); ?></h1></div > 			
			
			<!-- THE POST LOOP -->
			<?php

			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args=array(
			   'cat'=>''.get_cat_id(get_custom_field('category_filter')),
			   'paged'=>$paged,
			   );
			query_posts($args);
			while (have_posts()) : the_post(); ?>			
				
				<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'sidewinder' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a></h2>				
						<small><?php the_time('F jS, Y') ?>  <span>|</span>  <?php the_category(', ') ?>  <span>|</span>  <?php comments_popup_link('No Comments', '1 Comment', '% Comments'); ?>	</small>
				<div class="the_content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					
					<?php if ( has_post_thumbnail() ) { ?>
						<!-- 1. First, check for the custom field "lightbox_gallery_link" to see if there is a gallery. If there is, display it. -->
						<?php if(get_custom_field('lightbox_gallery_link')) { ?>						
						<a rel="prettyPhoto[<?php the_title(); ?>]" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>" class="post-img"><?php the_post_thumbnail(); ?></a> 
												
						<div style="display: none;">							
							<?php 
							$title = get_the_title();							
							$items = get_post_meta($post->ID, 'lightbox_gallery_link', false); ?>
							<?php foreach($items as $item) {
							echo '<a rel="prettyPhoto['.$title.']" href="'.$item.'"></a>';
							} ?>												
						</div>																
												
						<!-- 2. Second, if there isn't a gallery, check for any individual lightbox links (custom field "lightbox_link") -->
						<?php } elseif(get_custom_field('lightbox_link')) { ?>						
						<a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>" class="post-img" ><?php the_post_thumbnail(); ?></a>						
								
						<!-- 3. Third, if there isn't a lightbox link at all, simply link the image to the post. -->						
						<?php } else { ?>						
						<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" class="post-img"><?php the_post_thumbnail(); ?></a>							
						<?php } ?>								  
					
					<?php } else { ?>	    
					<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" class="post-img"><img src="<?php bloginfo('template_url'); ?>/assets/img/placeholder.jpg" /></a>	
					<?php } ?>		  
					
					<div class="excerpt">
						<p><?php the_excerpt(); ?> <a href="<?php the_permalink(); ?>" class="more">Read More</a></p>
					</div>
					
							
					
				</div>
				
				<div class="clear"><br /></div>
				<hr /><br />
				
			
			<?php endwhile; ?>
		
		
		</div>	
		<!-- /#ENTRY COLUMN -->		
	    
		
		
		<!-- SECONDARY SIDEBAR COLUMN -->		
		<div id="sub-sidebar" class="widget-area">	
			<ul>
			<?php dynamic_sidebar( 'secondary-widget-area' ); ?>			
			</ul>	
		</div>
		<!-- /SECONDARY SIDEBAR COLUMN -->		
		

<?php get_footer(); ?>