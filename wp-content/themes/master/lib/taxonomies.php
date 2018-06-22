<?php
add_action( 'init', 'create_resource_taxonomies', 0 );
function create_resource_taxonomies() {
  register_taxonomy(
      'resource_category',
      'resource',
      array(
          'labels' => array(
              'name' => 'Resource Category',
              'add_new_item' => 'Add Resource Category',
              'new_item_name' => 'New Resource Category'
          ),
          'show_ui' => true,
          'show_tagcloud' => false,
          'hierarchical' => true
      )
  );
}
?>