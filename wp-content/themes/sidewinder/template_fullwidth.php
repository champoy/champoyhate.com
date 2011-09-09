<?php 
/*
 * Template Name: Full Width
*/
get_header(); ?>

<?php get_sidebar(); ?>
	
						
<!-- CONTENT CONTAINER -->
<div id="content" class="no-grid full">
		
	<!-- INNER WRAPPER -->
	<div id="inner" class="entry-container">
									
		<!-- ENTRY COLUMN -->
		<div id="entry" class="full-width">				
				
			<!-- 404 MESSAGE -->
			<?php if ( ! have_posts() ) : ?>
				<h1><?php _e( 'Not Found', 'sidewinder' ); ?></h1>
				<div class="the_content">	
					<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'sidewinder' ); ?></p>
					<?php get_search_form(); ?>
				</div>
			<?php endif; ?>
			
			
			<!-- THE POST LOOP -->
			<?php while ( have_posts() ) : the_post(); ?>					
						
				<h1><?php the_title(); ?></h1>
				<hr />	
						
				<div class="the_content" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
					<?php the_content(); ?>					
				</div>
				
			
			<?php endwhile; ?>
		
		
		</div>	
		<!-- /#ENTRY COLUMN -->		
	    
				

<?php get_footer(); ?>