<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">

    <?php if (have_posts()) : ?>

      <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

      <?php /* If this is a category archive */ if (is_category()) { ?>
        <h2><?php _e("Archive for the &#8216;", "alpaka"); single_cat_title(); ?><?php _e("&#8217; Category", "alpaka"); ?></h2>

      <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
        <h2>Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;</h2>

      <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
        <h2>Archive for <?php the_time('F jS, Y'); ?></h2>

      <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
        <h2>Archive for <?php the_time('F, Y'); ?></h2>

      <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
        <h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>

      <?php /* If this is an author archive */ } elseif (is_author()) { ?>
        <h2 class="pagetitle">Author Archive</h2>

      <?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
        <h2 class="pagetitle">Blog Archives</h2>

      <?php } ?>

      <?php include (TEMPLATEPATH . '/_/inc/nav.php' ); ?>

      <?php while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <div class="inner-wrapper">

            <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                  } else { ?>                    <?php
                      $_origin_id = get_post_meta($post->ID, 'origin_id', TRUE);
                      $containsThumb = preg_match('/timthumb/', getImageForThumb('1'));

                      if ((!empty($_origin_id)) || (!empty($containsThumb)))
                      {
                        $_thumbString = '<img src="%s" alt="%s">';
                        $_thumbUrl = urldecode(getImageForThumb('1'));
                          $thumb = str_replace('w=636', 'w=240', $_thumbUrl);
                          $thumb = str_replace('w=313', 'w=240', $thumb);
                          $thumb = str_replace('h=315', 'h=240', $thumb);

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

    <h2>Nothing found</h2>

  <?php endif; ?>
  </div>
  <div class="right">

    <?php get_sidebar(); ?>

  </div>
  </div>

<?php get_footer(); ?>
