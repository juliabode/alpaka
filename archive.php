<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">

    <?php if (have_posts()) : ?>

      <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>

      <?php /* If this is a category archive */ if (is_category()) { ?>
        <h2>Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category</h2>

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

    <h2>Nothing found</h2>

  <?php endif; ?>
  </div>
  <div class="right">

    <?php get_sidebar(); ?>

  </div>
  </div>

<?php get_footer(); ?>
