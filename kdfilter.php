<?php
/*
Plugin Name: KD Filter
Plugin URI: bgwebagency.com
Description: Just for demo
Author Name: Kiran Kumar Dash
Author URI: bgwebagency.com
version: 1.0
*/

add_filter('the_title',strtoupper);

add_filter('the_content', function($content){
	return $content.' By Kiran Dash on '.date('d M Y');
});

add_action('wp_footer', function(){
	echo '<p style="color: white;">This content will come before footer.</p>';
});

add_action('comment_post', function(){
	$email = get_bloginfo('admin_email');
	wp_mail(
		$email,
		'New comment posted',
		'A new comment has been left on your blog. Please check.'
	);
});
?>