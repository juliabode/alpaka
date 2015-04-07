<?php /*
Automatic Post Thumbnail Template
Author: Namit Gupta (www.theitechblog.com)
http://www.theitechblog.com/1448/yarpp-template-display-thumbnail-automatically-grabbing-first-image-post
*/

$default_thumb = get_bloginfo('template_url').'/media/'.'/images/default_thumb.png';

while ($related_query->have_posts()) {
  $related_query->the_post();
  if ( has_post_thumbnail() ) {
    $_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID) );
  } else {

  }
  $query = array(
    'title' => $post->post_title,
    'url' =>  get_permalink($post->ID),
    'origin_id' => get_post_meta($post->ID, 'origin_id', TRUE),
    'thumb' => $_thumb[0]
  );
  $related_post[] = $query;
}

$have_post     = $related_query->have_posts();
?>

<section class="related-posts">
    <h3><span><?php _e("Read more of this:", "roots"); ?></span></h3>
    <?php if ($have_post):?>
      <div id="yarpp-related-posts">
      <ul class="small-block-grid-1 medium-block-grid-3">
        <?php foreach ($related_post as $yarpp_post): ?>
          <li>
            <div class="inner-related-posts">
              <a href="<?php echo $yarpp_post['url']; ?>" rel="bookmark">
                <img src="<?php print($yarpp_post['thumb']); ?>" alt="" />
                <div><?php echo $yarpp_post['title']; ?></div>
              </a>
            </div>
          </li>
        <?php endforeach; ?>
      </ul>
      </div>
    <?php else: ?>
      <p><?php _e('No related posts found.', 'dealies'); ?></p>
    <?php endif; ?>
</section>