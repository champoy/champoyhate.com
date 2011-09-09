<?php 
/*
 * Template Name: Grid Blog
*/
get_header(); ?>

<?php get_sidebar(); ?>
	
	<!-- CONTENT CONTAINER -->
	<div id="content">
	
		
		<!-- INNER WRAPPER -->
		<div id="inner">
			
			
		<!-- 404 FALLBACK -->
		<?php if ( ! have_posts() ) : ?>
			<div id="entry">			
					<h1><?php _e( 'Not Found', 'sidewinder' ); ?></h1>
					<hr />
					<div class="entry">
						<p><?php _e( 'Oops! No results were found for the requested page. Perhaps searching will help find a related post. Try the form below.', 'sidewinder' ); ?></p><br />
						<?php get_search_form(); ?>
					</div>			
			</div>
		<?php endif; ?>
		<!-- /404 -->
		
			
		<!-- GRID CONTENT UL - EACH LI IS A GRID CONTAINER -->
		<ul id="grid-content">	
		
		
		<!-- THE GRID LOOP -->	
		<?php
	
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					$args=array(
					   'cat'=>''.get_cat_id(get_custom_field('category_filter')),
					   'paged'=>$paged,
					   );
					query_posts($args);
					while (have_posts()) : the_post(); ?>
					
			<!-- Posts don't show up in the grid unless they have a "post thumbnail", aka a "featured image". -->	
			 		
				<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>					
					<?php if ( has_post_thumbnail() ) { ?>
						<!-- 1. First, check for the custom field "lightbox_gallery_link" to see if there is a gallery. If there is, display it. -->
						<?php if(get_custom_field('lightbox_gallery_link')) { ?>						
						<a rel="prettyPhoto[<?php the_title(); ?>]" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>"><?php the_post_thumbnail(); ?></a> 
												
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
						<a rel="prettyPhoto" title="<?php the_title(); ?>" href="<?php echo get_custom_field('lightbox_link',true); ?>" ><?php the_post_thumbnail(); ?></a>						
								
						<!-- 3. Third, if there isn't a lightbox link at all, simply link the image to the post. -->						
						<?php } else { ?>						
						<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><?php the_post_thumbnail(); ?></a>							
						<?php } ?>								  
					
					<?php } else { ?>	    
					<a title="<?php the_title(); ?>" href="<?php the_permalink() ?>"><img src="<?php bloginfo('template_url'); ?>/assets/img/placeholder.jpg" /></a>	
					<?php } ?>		   
                				
					<!-- MODULE TEXT -->
					<?php if (get_option('theme_module_dates') == 'Yes') { ?>	
					<div class="module_dates"><?php the_time('F jS, Y') ?></div>
					<?php } else {} ?>
					
					<div class="module">
						
						<?php if (get_option('theme_module_titles') == 'Yes') { ?>	
						<h2><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'sidewinder' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						<?php } else { ?>
						<br /><style type="text/css">#grid-content .module{height: auto !important;} #grid-content .module br{display: block; margin-bottom: 5px;}</style>
						<?php } ?>
						
						
						<?php if (get_option('theme_module_meta') == 'Tags') { ?>	
						<?php $tags_list = get_the_tag_list( '', ', ' );						
						if ( $tags_list ): ?> <p><?php echo $tags_list; ?></p><?php endif; ?>
						
						<?php } elseif (get_option('theme_module_meta') == 'Categories') { ?>							
						<p><?php the_category(', '); ?></p>
	    									
						<?php } else {}?>
										    
					</div>
					<!-- /MODULE TEXT -->
															
				</li>
			
			
		<?php endwhile; ?>		
		<!-- /END GRID LOOP -->
		
		</ul>
		<!-- /END GRID LIST -->
		
		
		<!-- PAGINATION -->
		<div id="pagination" class="taxonomy">
			<div class="p"><?php next_posts_link('Previous Posts'); ?></div>
			<div class="m"><?php previous_posts_link('Next Posts'); ?></div>		
		</div>	
		<!-- /PAGINATION -->
		
		
		</div>
		<!-- /INNER WRAPPER -->
		
	</div>
	<!-- /CONTENT CONTAINER -->
	


<?php get_footer(); ?>