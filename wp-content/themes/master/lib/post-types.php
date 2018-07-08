<?php

add_post_type_support('page', 'excerpt');

// Resource
add_action('init', 'resource_register');
function resource_register() {
  $labels = array(
      'name' => _x('Resource', 'post type general name'),
      'singular_name' => _x('Resource', 'post type singular name'),
      'add_new' => _x('Add Resource', 'rep'),
      'add_new_item' => __('Add New Resource'),
      'edit_item' => __('Edit Resource'),
      'new_item' => __('New Resource'),
      'view_item' => __('View Resource'),
      'search_items' => __('Search Resource'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'menu_position' => 8,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt','revisions'),
  );
  register_post_type( 'resource' , $args );
}

// Resource list
add_action('init', 'resource_list_register');
function resource_list_register() {
  $labels = array(
      'name' => _x('Resource list', 'post type general name'),
      'singular_name' => _x('Resource list', 'post type singular name'),
      'add_new' => _x('Add Resource list', 'rep'),
      'add_new_item' => __('Add New Resource list'),
      'edit_item' => __('Edit Resource list'),
      'new_item' => __('New Resource list'),
      'view_item' => __('View Resource list'),
      'search_items' => __('Search Resource list'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'menu_position' => 8,
      'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt','revisions'),
  );
  register_post_type( 'resource list' , $args );
}

// Service code
add_action('init', 'service_code_register');
function service_code_register() {
  $labels = array(
      'name' => _x('Service code', 'post type general name'),
      'singular_name' => _x('Service code', 'post type singular name'),
      'add_new' => _x('Add Service code', 'rep'),
      'add_new_item' => __('Add New Service code'),
      'edit_item' => __('Edit Service code'),
      'new_item' => __('New Service code'),
      'view_item' => __('View Service code'),
      'search_items' => __('Search Service code'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'menu_position' => 8,
      'supports'      => array( 'title', 'editor', 'revisions'),
  );
  register_post_type( 'service code' , $args );
}

// Home banner
add_action('init', 'home_banner_register');
function home_banner_register() {
  $labels = array(
      'name' => _x('Mainpage banner', 'post type general name'),
      'singular_name' => _x('Mainpage banner', 'post type singular name'),
      'add_new' => _x('Add Mainpage banner', 'rep'),
      'add_new_item' => __('Add New Mainpage banner'),
      'edit_item' => __('Edit Mainpage banner'),
      'new_item' => __('New Mainpage banner'),
      'view_item' => __('View Mainpage banner'),
      'search_items' => __('Search Mainpage banner'),
      'not_found' =>  __('Nothing found'),
      'not_found_in_trash' => __('Nothing found in Trash'),
      'parent_item_colon' => ''
  );
  $args = array(
      'labels' => $labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => true,
      'capability_type' => 'post',
      'hierarchical' => true,
      'menu_position' => 8,
      'supports'      => array( 'title', 'editor', 'revisions'),
  );
  register_post_type( 'mainpage banner' , $args );
}
?>
