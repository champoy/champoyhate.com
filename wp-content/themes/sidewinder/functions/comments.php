
<?php
add_filter('comments_template', 'legacy_comments');

function legacy_comments($file) {
	if(!function_exists('wp_list_comments')) :
		$file = TEMPLATEPATH . '/legacy.comments.php';
	endif;
	return $file;
}

function display_comments() {
	if(is_page()) {
		if(get_option('theme_comments_pages')==true) return comments_template('',true);
	}
	if(is_single()) {
		if(get_option('theme_comments_posts')==true) return comments_template('',true);
	}
}

function custom_comments ($comment, $args, $depth) {
  $GLOBALS['comment'] = $comment; ?>
  
  <div class="clear"></div>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

		<div class="details">
			<?php echo get_avatar($comment,$size=78); ?>
			<span class="name"><?php if($comment->comment_author_url) { echo '<a href="'.$comment->comment_author_url.'">'.$comment->comment_author.'</a>'; } else { echo $comment->comment_author; } ?></span>
			<span class="date"><?php echo get_comment_date();?></span>
		</div>
		
		<div class="msg">
			 <?php if ($comment->comment_approved == '0') : ?>
			  <em><?php _e('Your comment is awaiting moderation.') ?></em>
			  <?php endif; ?>

			<?php comment_text(); ?>
		</div>
		
		 <div class="reply">
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		  </div>
	</li>
   <?php
  // Do not include the </li> tag.
}

?>