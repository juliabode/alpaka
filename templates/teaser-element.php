<?php

    global $wp_query;

    $slider_or_image       = '';
    $page_parent_image     = function_exists('get_field') ? get_field('header_image', $wp_query->post->post_parent) : '';
    $page_parent_animation = function_exists('get_field') ? get_field('show_vobe_animation', $wp_query->post->post_parent) : '';
    $page_google_map       = function_exists('get_field') ? get_field('show_google_map', $wp_query->post->post_parent) : '';
    
    if ( $page_parent_image ) {

        $slider_or_image =  wp_get_attachment_image( $page_parent_image, 'full' );

    } else if ( is_front_page() ) {

        $slider_or_image = do_shortcode( '[responsive_slider]' );

    } else if ( $page_parent_animation ) {

        $slider_or_image = get_template_part('templates/animation');

    } else if ( $page_google_map ) {

        $options = get_option('plugin_options');
        $slider_or_image = $options['vobe_google_map_code'];

    }

    echo $slider_or_image;

?>