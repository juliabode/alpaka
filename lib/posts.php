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

function weeklies_add_meta_box() {

    add_meta_box(
        'weeklies_has_post',
        __( 'Post Connection', 'roots' ),
        'weeklies_meta_box_callback',
        'weeklies',
        'side'
    );
}
add_action( 'add_meta_boxes_weeklies', 'weeklies_add_meta_box' );

function weeklies_meta_box_callback( $post ) {

    // Add a nonce field so we can check for it later.
    wp_nonce_field( 'weeklies_save_meta_box_data', 'weeklies_meta_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */

    $value = get_post_meta( $post->ID, 'weeklies_checkbox', true );
    $field_id_checked =  ($value == "yes") ? 'checked="checked"' : '';

    echo '<label for="weeklies_checkbox">';
    echo '<input type="checkbox" id="weeklies_checkbox" name="weeklies_checkbox" value="yes" ' . $field_id_checked . '/>';
    _e( 'Has connected Post', 'roots' );
    echo '</label> ';
}

function weeklies_save_meta_box_data( $post_id ) {
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['weeklies_meta_box_nonce'], 'weeklies_save_meta_box_data' ) )
        return;

    update_post_meta( $post_id, 'weeklies_checkbox', $_POST['weeklies_checkbox'] );
}

add_action('save_post', 'weeklies_save_meta_box_data');