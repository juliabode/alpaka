<?php
/**
 * Customize Login Screen
 */

function my_login_logo() { ?>
    <style type="text/css">
        body.login {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/assets/img/bg.png);
        }
        body.login div#login h1 a {
            background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/assets/img/logo.png);
            padding-bottom: 30px;
            width: auto;
			background-size: 100%;
        }
    </style>

    <?php echo my_favicon_url();
}
add_action( 'login_enqueue_scripts', 'my_login_logo' );

function my_favicon_url() {
    return '<link rel="shortcut icon" href="' . get_template_directory_uri() . '/assets/img/favicon.png' . '" />';
}

function my_login_logo_url() {
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'my_login_logo_url' );

function my_login_logo_url_title() {
    return 'Anisah';
}
add_filter( 'login_headertitle', 'my_login_logo_url_title' );

/**
* Add Favicon in admin panel
*/

function add_admin_area_favicon() {
    echo my_favicon_url();
}
add_action('admin_head', 'add_admin_area_favicon');

/**
 * Add new image size for homepage service tiles
 */
/*
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'service-tile-thumb', 250, 9999 ); //250 pixels wide (and unlimited height)
    add_image_size( 'member-fotos', 450, 350, true );
}*/

/* Adjust excerpt read more link */

function remove_read_more( $more ) {
    return '';
}
add_filter( 'excerpt_more', 'remove_read_more' );

function new_excerpt_more($output) {
    return $output . '<p class="read-more"><a href="'. get_permalink() . '">' . __('Continue reading', 'roots') . '</a></p>';
}
add_filter('get_the_excerpt', 'new_excerpt_more');