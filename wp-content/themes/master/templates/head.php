<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon/" href="<?=get_stylesheet_directory_uri()?>/favicon.ico" />
  <title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	
	//wp_title( '|', true, 'right' );
	
	// Add the blog description for the home/front page.
	$display_title = get_field('display_title', $post->ID);
				
	if(empty($display_title)){		
		wp_title( '|', true, 'right' );
	}else{
		echo $display_title.' | ';	
	}
	
	// Add the blog name.
	bloginfo( 'name' );
	
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
  	//$loginId = 'ts12081887';
	//$loginId = 'ss12081892';
	
	//$loginId = 'sp12092242';
	$loginId = 'tp12175582';
  	initAccessRightChecking($loginId); 
  ?>
  
  <!-- SSID javascript removed 20190408 -->
</head>