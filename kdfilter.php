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

add_filter('the_content', function($content){
	$id = get_the_id();
	if(!is_singular('post')){
		return $content;
	}
	
	$terms = get_the_terms($id, 'category');
	$cats = array();
	
	foreach($terms as $term){
		$cats[] = $term->term_taxonomy_id;
	}
	print_r($cats);
	$loop = new WP_Query(
		array(
			'posts_per_page' => 3,
			'category__in' => $cats,
			'orderby' => 'rand',
			'post__not_in' => array($id)
		)
	);
	
	if($loop->have_posts()) {
		$content .= '<h2>Related posts</h2>
					<ul class="related-category-posts">';
					
		while($loop->have_posts()){
			$loop->the_post();
			$content .= '
			<li>
				<a href="'.get_the_permalink().'">'.get_the_title().'</a>
			</li>
			';
		}
		$content .= '</ul>';
		wp_reset_query();
	}
	
	return $content;	
});
?>