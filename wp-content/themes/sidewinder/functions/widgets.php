<?php

if (function_exists('register_sidebar'))
    register_sidebar(array(
		'name' => 'Default Sidebar',
        'before_widget' => '<li id="%1$s" class="box %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h2 class="title">',
        'after_title' => '</h2>',
    ));

/**
 * ************************************* Flickr Widget
 */
function epicera_flickr_widget($args) {
	$settings = get_option("widget_flickrwidget");

	$id = $settings['id'];
	$number = $settings['number'];
	
	echo $args['before_widget'];
?>

<div id="flickr" class="block">
	<h2 class="title">Photos on <span>flick<span>r</span></span></h2>
	<div class="wrap">
		<div class="fix"></div>
		<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $number; ?>&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $id; ?>"></script>        
		<div class="fix"></div>
	</div>
</div>

<?php
	echo $args['after_widget'];
}

function epicera_flickr_widget_admin() {
	$settings = get_option("widget_flickrwidget");

	// check if anything's been sent
	if (isset($_POST['update_flickr'])) {
		$settings['id'] = strip_tags(stripslashes($_POST['flickr_id']));
		$settings['number'] = strip_tags(stripslashes($_POST['flickr_number']));

		update_option("widget_flickrwidget",$settings);
	}

	echo '<p>
			<label for="flickr_id">Flickr ID (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):
			<input id="flickr_id" name="flickr_id" type="text" class="widefat" value="'.$settings['id'].'" /></label></p>';
	echo '<p>
			<label for="flickr_number">Number of photos:
			<input id="flickr_number" name="flickr_number" type="text" class="widefat" value="'.$settings['number'].'" /></label></p>';
	echo '<input type="hidden" id="update_flickr" name="update_flickr" value="1" />';

}
wp_register_sidebar_widget( 'flickr-widget', $themename.' - Flickr', 'epicera_flickr_widget', array('description' => 'Pulls in images from your Flickr account.'));
register_widget_control('flickr-widget', 'epicera_flickr_widget_admin', 400, 300);
?>