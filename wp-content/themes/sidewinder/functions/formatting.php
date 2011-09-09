<?php
	// Auto
	function wp_autop($autop) {
		global $post;
		if (get_post_meta($post->ID, 'auto', true) == 'no') {
			return $autop;
		}
		else {
			return wpautop($autop);
		}
	}
	remove_filter('the_content', 'wpautop');
	add_filter('the_content', 'wp_autop');

	// Texturize
	function wp_texturize($text) {
		global $post;
		if (get_post_meta($post->ID, 'texturize', true) == 'no') {
			return $text;
		}
		else {
			return wptexturize($text);
		}
	}
	remove_filter('the_content', 'wptexturize');
	add_filter('the_content', 'wp_texturize');
?>