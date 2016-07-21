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
?>