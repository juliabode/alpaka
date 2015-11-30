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
    return 'Alpaka Me';
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


// Creating the widget 
class alpaka_widget extends WP_Widget {

    function __construct() {
    parent::__construct(
        // Base ID of your widget
        'alpaka_widget', 

        // Widget name will appear in UI
        __('Social Media Widget', 'roots'), 

        // Widget description
        array( 'description' => __( 'Social Media Widget for Alapaka Me', 'roots' ), ) 
        );
    }

    // Creating widget front-end
    // This is where the action happens
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', $instance['title'] );

        // before and after widget arguments are defined by themes
        echo $args['before_widget'];

        if ( ! empty( $title ) )
        echo $args['before_title'] . $title . $args['after_title'];

        // This is where you run the code and display the output ?>

        <?php 
            $options      = get_option('plugin_options');
            $social_media = array('facebook', 'twitter', 'google', 'pinterest', 'instagram', 'eyeem', 'tumblr', 'mail', 'flickr', 'rss');
        ?>

        <div>
            <ul class="social-media-links">
                <?php foreach ($social_media as $i => $name) {
                          if (!empty( $options['alpaka_' . $name . '_link'] )) {
                              echo '<li><a href="' . $options['alpaka_'.$name.'_link'] . '" target="_blank" class="fa fa-' . $name . '"></a></li>';
                          }
                      }
                ?>
            </ul>
        </div>

        <?php echo $args['after_widget'];
    }
            
    // Widget Backend 
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        } else {
            $title = __( 'New title', 'roots' );
        }

        // Widget admin form
        ?>

        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'roots' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php 
    }
        
    // Updating widget replacing old instances with new
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;
    }
} // Class alpaka_widget ends here

// Register and load the widget
function alpaka_load_widget() {
    register_widget( 'alpaka_widget' );
}
add_action( 'widgets_init', 'alpaka_load_widget' );

// Get out of my page!
//wp_dequeue_script('jquery');

add_action('wp_footer','lm_dequeue_footer_styles');
function lm_dequeue_footer_styles()
{
  wp_dequeue_style('yarppRelatedCss');
}

function meta_tags_sm() {
  global $post;
  $post_description = get_the_excerpt();
  preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($post_description), $tags);
  $post_description = preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $post_description);

  $post_featured_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

  if ( (is_single()) AND ($post_featured_image) AND ($post_description) ) {?>
    <meta property="og:url" content="<?php echo get_permalink(); ?>" />
    <meta property="og:title" content="<?php echo $post->post_title; ?>" />
    <meta property="og:description" content="<?php echo $post_description; ?>" />
    <meta property="og:image" content="<?php echo $post_featured_image; ?>" />

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@LulesSaurus">
    <meta name="twitter:title" content="<?php echo $post->post_title; ?>">
    <meta name="twitter:description" content="<?php echo $post_description; ?>">
    <meta name="twitter:image" content="<?php echo $post_featured_image; ?>">
  <?php }
}
add_action('wp_head', 'meta_tags_sm');

set_post_thumbnail_size( 250, 200, true );

function featuredtoRSS($content) {
    global $post;
    if ( has_post_thumbnail( $post->ID ) ){
        $content = '<div>' . get_the_post_thumbnail( $post->ID, 'full', array( ) ) . '</div>' . $content;
    }
    return $content;
}

add_filter('the_excerpt_rss', 'featuredtoRSS');
add_filter('the_content_feed', 'featuredtoRSS');


/* Create shortcode for advent calender */

function adventcalender_func(){
    return get_template_part('templates/adventcalender');
}
add_shortcode( 'adventcalender', 'adventcalender_func' );