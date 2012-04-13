<?php
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );

        $locale = get_locale();
        $locale_file = TEMPLATEPATH . "/languages/$locale.php";
        if ( is_readable($locale_file) )
            require_once($locale_file);

  // Add RSS links to <head> section
  automatic_feed_links();

  // Load jQuery
  if ( !function_exists(core_mods) ) {
    function core_mods() {
      if ( !is_admin() ) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', ("//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"), false);
        wp_enqueue_script('jquery');
      }
    }
    core_mods();
  }

  // Clean up the <head>
  function removeHeadLinks() {
      remove_action('wp_head', 'rsd_link');
      remove_action('wp_head', 'wlwmanifest_link');
    }
    add_action('init', 'removeHeadLinks');
    remove_action('wp_head', 'wp_generator');

    if (function_exists('register_sidebar')) {
      register_sidebar(array(
        'name' => __('Sidebar Widgets','html5reset' ),
        'id'   => 'sidebar-widgets',
        'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2>',
        'after_title'   => '</h2>'
      ));
    }

    add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video')); // Add 3.1 post format theme support.

register_nav_menu('main_menu', 'The Alpaka main menu');

function getImageForThumb($num) {
  global $more;
  $more = 1;
  $content = get_the_content();
  $count = substr_count($content, '<img');
  $start = 0;
  if ($count > 0) {
    for($i=1;$i<=$count;$i++) {
      $imgBeg = strpos($content, '<img', $start);
      $post = substr($content, $imgBeg);
      $imgEnd = strpos($post, '>');
      $postOutput = substr($post, 0, $imgEnd+1);
      $image[$i] = $postOutput;
      $start=$imgEnd+1;

      $cleanF = strpos($image[$num],'src="')+5;
      $cleanB = strpos($image[$num],'"',$cleanF)-$cleanF;
      $imgThumb = urlencode(substr($image[$num],$cleanF,$cleanB));
    }
  } else {
    $image[1] = '<img';
    $imgThumb = get_bloginfo('template_url') . '/images/default_thumb.jpg';
  }
  if(stristr($image[$num],'<img')) { return $imgThumb; }
  $more = 0;
}

function custom_excerpt_length( $length ) {
  return 45;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 240, 240 );

function new_excerpt_more($more) {
       global $post;
  return ' <a href="'. get_permalink($post->ID) . '">...</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_action('after_setup_theme', 'my_theme_setup');
function my_theme_setup(){
    load_theme_textdomain('alpaka', get_template_directory() . '/languages');
}
?>