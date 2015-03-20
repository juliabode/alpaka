<?php

function merge_option_default_variables() {
  $options = get_option('plugin_options');

  $defaults = array(
    'bellaleyla_facebook_link'          => '',
    'bellaleyla_twitter_link'           => '',
    'bellaleyla_google_link'            => '',
    'bellaleyla_mail_link'              => '',
    'bellaleyla_linkedin_link'          => '',
    'bellaleyla_xing_link'              => '',
    'bellaleyla_skype_link'             => '',
    'bellaleyla_youtube_link'           => '',
    'bellaleyla_vimeo_link'             => '',
    'bellaleyla_flickr_link'            => '',
    'bellaleyla_rss_link'               => '',
    'bellaleyla_imprint_link'           => '',
  );

  return wp_parse_args( $options, $defaults );
}

function create_theme_options_page() {
    // Global variable for Themes' settings page hook
    global $bellaleyla_settings_page;

    $bellaleyla_settings_page = add_menu_page('Bella Leyla Optionen', 'Bella Leyla Optionen', 'read', 'bellaleyla_settings', 'build_options_page', 'dashicons-lightbulb');

    // Add contextual help
    add_action( 'load-' . $bellaleyla_settings_page, 'add_contextual_theme_help' );
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
    global $bellaleyla_settings_page;

    // Get the current screen object
    $screen = get_current_screen();

    $tabs = array(
        // The assoc key represents the ID
        // It is NOT allowed to contain spaces
        'bellaleyla-intro' => array(
            'title'   => 'Lies mich',
            'content' => 'Tach auch.<br><h3>Supported Web Browsers</h3><br><h3>Support</h3>'
         ),
        'bellaleyla-menu' => array(
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
  add_settings_field('bellaleyla_facebook_link', 'Facebook:', 'bellaleyla_facebook_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_twitter_link', 'Twitter:', 'bellaleyla_twitter_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_google_link', 'Google+:', 'bellaleyla_google_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_mail_link', 'Email:', 'bellaleyla_mail_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_linkedin_link', 'LinkedIn:', 'bellaleyla_linkedin_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_xing_link', 'Xing:', 'bellaleyla_xing_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_skype_link', 'Skype:', 'bellaleyla_skype_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_youtube_link', 'Youtube:', 'bellaleyla_youtube_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_vimeo_link', 'Vimeo:', 'bellaleyla_vimeo_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_flickr_link', 'Flickr:', 'bellaleyla_flickr_link', __FILE__, 'social_media_section');
  add_settings_field('bellaleyla_rss_link', 'RSS:', 'bellaleyla_rss_link', __FILE__, 'social_media_section');

  add_settings_section('main_section', 'Sonstige Einstellungen', 'section_cb', __FILE__);
  add_settings_field('bellaleyla_imprint_link', 'Link zum Impressum:', 'imprint_link_setting', __FILE__, 'main_section');
}
add_action('admin_init', 'register_and_build_fields');

function validate_setting($plugin_options) { return $plugin_options; }

function section_cb() {}

function imprint_link_setting() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_imprint_link]' type='text' value='{$options['bellaleyla_imprint_link']}' class='regular-text'/>";
}

function bellaleyla_facebook_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_facebook_link]' type='text' value='{$options['bellaleyla_facebook_link']}' class='regular-text'/>";
}

function bellaleyla_twitter_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_twitter_link]' type='text' value='{$options['bellaleyla_twitter_link']}' class='regular-text'/>";
}

function bellaleyla_google_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_google_link]' type='text' value='{$options['bellaleyla_google_link']}' class='regular-text'/>";
}

function bellaleyla_mail_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_mail_link]' type='text' value='{$options['bellaleyla_mail_link']}' class='regular-text'/>";
}

function bellaleyla_linkedin_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_linkedin_link]' type='text' value='{$options['bellaleyla_linkedin_link']}' class='regular-text'/>";
}

function bellaleyla_xing_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_xing_link]' type='text' value='{$options['bellaleyla_xing_link']}' class='regular-text'/>";
}

function bellaleyla_skype_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_skype_link]' type='text' value='{$options['bellaleyla_skype_link']}' class='regular-text'/>";
}

function bellaleyla_youtube_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_youtube_link]' type='text' value='{$options['bellaleyla_youtube_link']}' class='regular-text'/>";
}

function bellaleyla_vimeo_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_vimeo_link]' type='text' value='{$options['bellaleyla_vimeo_link']}' class='regular-text'/>";
}

function bellaleyla_flickr_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_flickr_link]' type='text' value='{$options['bellaleyla_flickr_link']}' class='regular-text'/>";
}

function bellaleyla_rss_link() {
  $options = merge_option_default_variables();
  echo "<input name='plugin_options[bellaleyla_rss_link]' type='text' value='{$options['bellaleyla_rss_link']}' class='regular-text'/>";
}