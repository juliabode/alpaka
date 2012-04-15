<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">
      <?php update_option('posts_per_page', 5);?>

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <div class="inner-wrapper">

            <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                  } else { ?>

                    <?php
                      $_origin_id = get_post_meta($post->ID, 'origin_id', TRUE);
                      $containsThumb = preg_match('/timthumb/', getImageForThumb('1'));

                      if ((!empty($_origin_id)) || (!empty($containsThumb)))
                      {
                        $_thumbString = '<img src="%s" alt="%s">';
                        $_thumbUrl = urldecode(getImageForThumb('1'));
                        $thumb = str_replace('w=636', 'w=240', $_thumbUrl);
                        $thumb = str_replace('h=240', 'h=240', $thumb);

                        $_thumb = sprintf($_thumbString, $thumb, get_the_title($post->ID));

                        unset($_thumbString, $_thumbUrl, $thumb);
                      }
                      else
                      {
                         $_thumb = sprintf('<img src="%s/timthumb.php?src=%s&amp;w=240&amp;h=240&amp;zc=1" alt="%s">',
                                get_bloginfo('template_directory'),
                                getImageForThumb('1'),
                                get_the_title($_post_id)
                              );
                      }

                      ?>
              <?php print($_thumb); ?>
            <?php } ?>

      <div class="entry right">
        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

        <?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
        <?php the_excerpt(); ?>
      </div>

      </div>

    </article>

  <?php endwhile; ?>

  <?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

  <?php else : ?>

    <h2>Not Found</h2>

  <?php endif; ?>
  </div>
  <div class="right">

    <?php get_sidebar(); ?>

  </div>
  </div>

<?php get_footer(); ?>
