<?php /*
Automatic Post Thumbnail Template
Author: Namit Gupta (www.theitechblog.com)
http://www.theitechblog.com/1448/yarpp-template-display-thumbnail-automatically-grabbing-first-image-post
*/

$default_thumb = get_bloginfo('template_url').'/media/'.'/images/default_thumb.png';

while ($related_query->have_posts()) {
  $related_query->the_post();
  if ( has_post_thumbnail() ) {
    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) );
    $_thumb = sprintf('<img src="%s/timthumb.php?src=%s&amp;w=130&amp;h=130&amp;zc=1" alt="">',
                get_bloginfo('template_directory'),
                $thumb['0']
              );
    unset($thumb);
  } else {
      $_origin_id = get_post_meta($post->ID, 'origin_id', TRUE);
      $containsThumb = preg_match('/timthumb/', getImageForThumb('1'));

      if ((!empty($_origin_id)) || (!empty($containsThumb)))
      {
        $_thumbString = '<img src="%s" alt="%s">';
        $_thumbUrl = urldecode(getImageForThumb('1'));
        $thumb = str_replace('w=636', 'w=130', $_thumbUrl);
        $thumb = str_replace('w=313', 'w=130', $thumb);
        $thumb = str_replace('h=315', 'h=130', $thumb);
        $thumb = str_replace('h=240', 'h=130', $thumb);

        $_thumb = sprintf($_thumbString, $thumb, get_the_title($post->ID));

        unset($_thumbString, $_thumbUrl, $thumb);
      }
      else
      {
         $_thumb = sprintf('<img src="%s/timthumb.php?src=%s&amp;w=100&amp;h=100&amp;zc=1" alt="%s">',
                get_bloginfo('template_directory'),
                getImageForThumb('1'),
                get_the_title($_post_id)
              );
      }
  }
  $query = array(
    'title' => $post->post_title,
    'url' =>  get_permalink($post->ID),
    'origin_id' => get_post_meta($post->ID, 'origin_id', TRUE),
    'thumb' => $_thumb
  );
  $related_post[] = $query;
}

$have_post     = $related_query->have_posts();
?>

<h4><?php _e("Read more of this:", "alpaka"); ?></h4>
<?php if ($have_post):?>
  <div id="yarpp-related-posts">
  <ol>
    <?php foreach ($related_post as $yarpp_post): ?>
      <li>
        <div class="inner-related-posts">
          <a href="<?php echo $yarpp_post['url']; ?>" rel="bookmark">
            <?php print($yarpp_post['thumb']); ?>
            <div><?php echo $yarpp_post['title']; ?></div>
          </a>
        </div>
      </li>
    <?php endforeach; ?>
  </ol>
  </div>
<?php else: ?>
  <p><?php _e('No related posts found.', 'dealies'); ?></p>
<?php endif; ?>