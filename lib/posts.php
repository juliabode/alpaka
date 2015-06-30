<?php

/**
 * Register custom post type for weeklies
 */
function create_weekly_post_type() {
    register_post_type( 'weeklies',
        array(
            'labels'        => array(
                'name'          => __( 'Weeklies', 'roots' ),
                'singular_name' => __( 'Weekly', 'roots' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'supports'      => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' )
        )
    );

    $labels = array(
        'name' => __( 'Categories', 'roots' ),
        'singular_name' => _x( 'Category', 'roots' ),
        'search_items' =>  __( 'Search Categories', 'roots' ),
        'all_items' => __( 'All Categories', 'roots' ),
        'parent_item' => __( 'Parent Category', 'roots' ),
        'parent_item_colon' => __( 'Parent Category:', 'roots' ),
        'edit_item' => __( 'Edit Category', 'roots' ), 
        'update_item' => __( 'Update Category', 'roots' ),
        'add_new_item' => __( 'Add New Category', 'roots' ),
        'new_item_name' => __( 'New Category Name', 'roots' ),
        'menu_name' => __( 'Categories' )
    );     

    register_taxonomy('type',
        array('weeklies'),
        array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'weekly-type' )
        )
    );
}
add_action( 'init', 'create_weekly_post_type' );