<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	
	wp_title( '|', true, 'right' );
	
	// Add the blog name.
	bloginfo( 'name' );
	
	// Add the blog description for the home/front page.
	$display_title = get_field('display_title');
				
	if(empty($display_title)){
		$display_title = get_the_title($post->ID);
	}
	
  ?></title>
  
  <link rel="alternate" type="application/rss+xml" title="<?php echo get_bloginfo('name'); ?> Feed" href="<?php echo esc_url(get_feed_link()); ?>">

  <?php wp_head(); ?>
  <!--[if lt IE 9]>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script type="text/javascript" src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
  <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php bloginfo('template_url')?>/assets/css/ie8-style.css" type="text/css" />
  <![endif]-->
  
  <?php 
  	$loginId = 'ts12081887';
	//$loginId = 'ss12081892';
  	initAccessRightChecking($loginId); 
  ?>
</head>
