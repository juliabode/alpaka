<?php

function merge_option_default_variables() {
  $options = get_option('plugin_options');

  $defaults = array(
    'alpaka_facebook_link'          => '',
    'alpaka_twitter_link'           => '',
    'alpaka_google_link'            => '',
    'alpaka_pinterest_link'         => '',
    'alpaka_instagram_link'         => '',
    'alpaka_eyeem_link'             => '',
    'alpaka_tumblr_link'             => '',
    'alpaka_mail_link'              => '',
    'alpaka_flickr_link'            => '',
    'alpaka_rss_link'               => '',
    'imprint_link_setting'          => '',
  );

  return wp_parse_args( $options, $defaults );
}

function create_theme_options_page() {
    // Global variable for Themes' settings page hook
    global $alpaka_settings_page;

    $alpaka_settings_page = add_menu_page('Alpaka Optionen', 'Alpaka Optionen', 'read', 'alpaka_settings', 'build_options_page', 'dashicons-lightbulb');

    // Add contextual help
    add_action( 'load-' . $alpaka_settings_page, 'add_contextual_theme_help' );
}
add_action('admin_menu', 'create_theme_options_page');


function build_options_page() { ?>
    <div id="theme-options-wrap" class="widefat wrap">
        <div class="icon32" id="icon-options-general"><br /></div>
        <h2>Zusätzliche Einstellungen</h2>
        <?php settings_errors(); ?>

        <form method="post" action="options.php" enctype="multipart/form-data">
            <?php settings_fields('plugin_options'); ?>
            <?php do_settings_sections(__FILE__); ?>
            <p class="submit"><input name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" /></p>
        </form>
    </div>
<?php }


function add_contextual_theme_help() {
    global $alpaka_settings_page;

    // Get the current screen object
    $screen = get_current_screen();

    $tabs = array(
        // The assoc key represents the ID
        // It is NOT allowed to contain spaces
        'alpaka-intro' => array(
            'title'   => 'Lies mich',
            'content' => 'Tach auch.<br><h3>Supported Web Browsers</h3><br><h3>Support</h3>'
         ),
        'alpaka-menu' => array(
            'title'   => 'Menu',
            'content' => file_get_contents( get_template_directory() . '/help/menu.html' )
        )
    );

    foreach ( $tabs as $id => $data ) {
        $screen->add_help_tab( array(
            'id'       => $id,
            'title'    => __( $data['title'], 'root' ),
            'content'  => $data['content']
            )
        );
    }
}


function register_and_build_fields() {
  register_setting('plugin_options', 'plugin_options', 'validate_setting');

  add_settings_section('social_media_section', 'Social Media Links', 'section_cb', __FILE__);
  add_settings_field('alpaka_facebook_link', 'Facebook:', 'alpaka_facebook_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_twitter_link', 'Twitter:', 'alpaka_twitter_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_google_link', 'Google+:', 'alpaka_google_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_pinterest_link', 'Pinterest:', 'alpaka_pinterest_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_instagram_link', 'Instagram:', 'alpaka_instagram_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_eyeem_link', 'EyeEm:', 'alpaka_eyeem_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_tumblr_link', 'Tumblr:', 'alpaka_tumblr_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_mail_link', 'Email:', 'alpaka_mail_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_flickr_link', 'Flickr:', 'alpaka_flickr_link', __FILE__, 'social_media_section');
  add_settings_field('alpaka_rss_link', 'RSS:', 'alpaka_rss_link', __FILE__, 'social_media_section');

  add_settings_section('main_section', 'Einstellungen für den Footer', 'section_cb', __FILE__);
  add_settings_field('imprint_link', 'Link zum Impressum:', 'imprint_link_setting', __FILE__, 'main_section');
}
add_action('admin_init', 'register_and_build_fields');

function validate_setting($plugin_options) { return $plugin_options; }

function section_cb() {}

function imprint_link_setting() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_imprint_link]' type='text' value='{$options['alpaka_imprint_link']}' class='regular-text'/>";
}

function alpaka_facebook_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_facebook_link]' type='text' value='{$options['alpaka_facebook_link']}' class='regular-text'/>";
}

function alpaka_twitter_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_twitter_link]' type='text' value='{$options['alpaka_twitter_link']}' class='regular-text'/>";
}

function alpaka_mail_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_mail_link]' type='text' value='{$options['alpaka_mail_link']}' class='regular-text'/>";
}

function alpaka_google_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_google_link]' type='text' value='{$options['alpaka_google_link']}' class='regular-text'/>";
}

function alpaka_pinterest_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_pinterest_link]' type='text' value='{$options['alpaka_pinterest_link']}' class='regular-text'/>";
}

function alpaka_instagram_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_instagram_link]' type='text' value='{$options['alpaka_instagram_link']}' class='regular-text'/>";
}

function alpaka_eyeem_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_eyeem_link]' type='text' value='{$options['alpaka_eyeem_link']}' class='regular-text'/>";
}

function alpaka_tumblr_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_tumblr_link]' type='text' value='{$options['alpaka_tumblr_link']}' class='regular-text'/>";
}

function alpaka_flickr_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_flickr_link]' type='text' value='{$options['alpaka_flickr_link']}' class='regular-text'/>";
}

function alpaka_rss_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[alpaka_rss_link]' type='text' value='{$options['alpaka_rss_link']}' class='regular-text'/>";
}