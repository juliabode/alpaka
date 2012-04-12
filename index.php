<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <div class="inner-wrapper">

            <?php if ( has_post_thumbnail() ) {
                    the_post_thumbnail();
                  } else { ?>

            <img class="left" src="<?php bloginfo('template_directory'); ?>/timthumb.php?src=<?php echo getImageForThumb('1'); ?>&w=240&h=240&zc=1" width="240" height="240"/>

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
