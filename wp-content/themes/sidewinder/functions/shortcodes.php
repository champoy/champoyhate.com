<?php



/** *********************** **/
/** Subscribe to RSS Shortcode **/
/** *********************** **/
function subscribeRss() {
    return '<div class="rss-box"><a href="http://feeds.feedburner.com/MakeDesignNotWar">Enjoyed this post? Subscribe to my RSS feeds!</a></div>';
}

add_shortcode('subscribe', 'subscribeRss');




/** *********************** **/
/** Paypal Donation Shortcode **/
/** *********************** **/
function donate_shortcode( $atts ) {
    extract(shortcode_atts(array(
        'text' => 'Make a donation',
        'account' => 'REPLACE ME',
        'for' => '',
    ), $atts));
 
    global $post;
 
    if (!$for) $for = str_replace(" ","+",$post->post_title);
 
    return '<a class="donateLink" href="https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business='.$account.'&item_name=Donation+for+'.$for.'">'.$text.'</a>';
 
}
add_shortcode('donate', 'donate_shortcode');



/** *********************** **/
/** Related Posts Shortcode **/
/** *********************** **/
function related_posts_shortcode( $atts ) {
	extract(shortcode_atts(array(
	    'limit' => '5',
	), $atts));

	global $wpdb, $post, $table_prefix;

	if ($post->ID) {
		$retval = '<h3 class="related_posts">Related Posts:</h3> <ul>';
 		// Get tags
		$tags = wp_get_post_tags($post->ID);
		$tagsarray = array();
		foreach ($tags as $tag) {
			$tagsarray[] = $tag->term_id;
		}
		$tagslist = implode(',', $tagsarray);

		// Do the query
		$q = "SELECT p.*, count(tr.object_id) as count
			FROM $wpdb->term_taxonomy AS tt, $wpdb->term_relationships AS tr, $wpdb->posts AS p WHERE tt.taxonomy ='post_tag' AND tt.term_taxonomy_id = tr.term_taxonomy_id AND tr.object_id  = p.ID AND tt.term_id IN ($tagslist) AND p.ID != $post->ID
				AND p.post_status = 'publish'
				AND p.post_date_gmt < NOW()
 			GROUP BY tr.object_id
			ORDER BY count DESC, p.post_date_gmt DESC
			LIMIT $limit;";

		$related = $wpdb->get_results($q);
 		if ( $related ) {
			foreach($related as $r) {
				$retval .= '<li><a title="'.wptexturize($r->post_title).'" href="'.get_permalink($r->ID).'">'.wptexturize($r->post_title).'</a></li>';
			}
		} else {
			$retval .= '
	<li>No related posts found</li>';
		}
		$retval .= '</ul>';
		return $retval;
	}
	return;
}
add_shortcode('related_posts', 'related_posts_shortcode');




/** *********************** **/
/** Google Charts Shortcode **/
/** *********************** **/
function chart_shortcode( $atts ) {
	extract(shortcode_atts(array(
	    'data' => '',
	    'colors' => '',
	    'size' => '400x200',
	    'bg' => 'ffffff',
	    'title' => '',
	    'labels' => '',
	    'advanced' => '',
	    'type' => 'pie'
	), $atts));

	switch ($type) {
		case 'line' :
			$charttype = 'lc'; break;
		case 'xyline' :
			$charttype = 'lxy'; break;
		case 'sparkline' :
			$charttype = 'ls'; break;
		case 'meter' :
			$charttype = 'gom'; break;
		case 'scatter' :
			$charttype = 's'; break;
		case 'venn' :
			$charttype = 'v'; break;
		case 'pie' :
			$charttype = 'p3'; break;
		case 'pie2d' :
			$charttype = 'p'; break;
		default :
			$charttype = $type;
		break;
	}

	if ($title) $string .= '&chtt='.$title.'';
	if ($labels) $string .= '&chl='.$labels.'';
	if ($colors) $string .= '&chco='.$colors.'';
	$string .= '&chs='.$size.'';
	$string .= '&chd=t:'.$data.'';
	$string .= '&chf='.$bg.'';

	return '<img title="'.$title.'" src="http://chart.apis.google.com/chart?cht='.$charttype.''.$string.$advanced.'" alt="'.$title.'" />';
}
add_shortcode('chart', 'chart_shortcode');





/** *********************** **/
/** Google Adsense Shortcode **/
/** *********************** **/
function showads() {
    return '<div class="adsense"><script type="text/javascript"><!--
google_ad_client = "pub-4140802238625506";
/* Epic Sidebar 02 - 300x250, created 9/23/08 */
google_ad_slot = "8673000299";
google_ad_width = 300;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script></div>
';
}

add_shortcode('adsense', 'showads');





/** *********************** **/
/** Premium Content Shortcode **/
/** *********************** **/
function access_check_shortcode( $attr, $content = null ) {
    extract( shortcode_atts( array( 'capability' => 'read' ), $attr ) );
    if ( current_user_can( $capability ) && !is_null( $content ) && !is_feed() )
        return $content;

    return 'Sorry, only registered members can see this text.';
}

add_shortcode( 'access', 'access_check_shortcode' );





/** *********************** **/
/** RSS Feed Shortcode **/
/** *********************** **/
//This file is needed to be able to use the wp_rss() function.
include_once(ABSPATH.WPINC.'/rss.php');

function readRss($atts) {
    extract(shortcode_atts(array(
	"feed" => 'http://',
      "num" => '1',
    ), $atts));

    return wp_rss($feed, $num);
}

add_shortcode('rss', 'readRss');





/** *********************** **/
/** Share on Twitter Shortcode **/
/** *********************** **/
function twitt() {
  return '<div id="twitit"><a href="http://twitter.com/home?status=Currently reading '.get_permalink($post->ID).'" title="Click to send this page to Twitter!" target="_blank">Share on Twitter</a></div>';
}

add_shortcode('twitter', 'twitt');




/** *********************** **/
/** Post Image Shortcode **/
/** *********************** **/
function sc_postimage($atts, $content = null) {
	extract(shortcode_atts(array(
		"size" => 'thumbnail',
		"float" => 'none'
	), $atts));
	$images =& get_children( 'post_type=attachment&post_mime_type=image&post_parent=' . get_the_id() );
	foreach( $images as $imageID => $imagePost )
	$fullimage = wp_get_attachment_image($imageID, $size, false);
	$imagedata = wp_get_attachment_image_src($imageID, $size, false);
	$width = ($imagedata[1]+2);
	$height = ($imagedata[2]+2);
	return '<div class="postimage" style="width: '.$width.'px; height: '.$height.'px; float: '.$float.';">'.$fullimage.'</div>';
}
add_shortcode("postimage", "sc_postimage");





/** *********************** **/
/** Administrator Notes Shortcode **/
/** *********************** **/
add_shortcode( 'note', 'sc_note' );

function sc_note( $atts, $content = null ) {
	 if ( current_user_can( 'publish_posts' ) )
		return '<div class="note">'.$content.'</div>';
	return '';
}


/** *********************** **/
/** Column Shortcodes **/
/** *********************** **/
add_shortcode( 'left_col', 'leftcol' );
add_shortcode( 'right_col', 'rightcol' );
add_shortcode( 'center_col', 'centercol' );
add_shortcode( 'clear', 'clear' );
add_shortcode( 'superquote', 'superquote' );


function leftcol( $atts, $content = null ) {
	return '<div class="left_col">'.$content.'</div>';
}

function rightcol( $atts, $content = null ) {
	return '<div class="right_col">'.$content.'</div>';
}

function centercol( $atts, $content = null ) {
	return '<div class="center_col">'.$content.'</div>';
}

function clear( $atts, $content = null ) {
	return '<div class="clear">'.$content.'</div>';
}

function superquote( $atts, $content = null ) {
	return '<div class="superquote">'.$content.'</div>';
}


/** *********************** **/
/** WP Formatting Stripper Shortcode **/
/** *********************** **/
function my_formatter($content) {
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);

	foreach ($pieces as $piece) {
		if (preg_match($pattern_contents, $piece, $matches)) {
			$new_content .= $matches[1];
		} else {
			$new_content .= wptexturize(wpautop($piece));
		}
	}

	return $new_content;
}

remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');

add_filter('the_content', 'my_formatter', 99);







?>