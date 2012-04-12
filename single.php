<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">

  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
          <div class="inner-wrapper">

      <h1 class="entry-title"><?php the_title(); ?></h1>

      <?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>

      <div class="entry-content">

        <?php the_content(); ?>

        <?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

        <?php the_tags( 'Tags: ', ', ', ''); ?>

      </div>

      <?php edit_post_link('Edit this entry','','.'); ?>

          </div>
    </article>

  <?php comments_template(); ?>

  <?php endwhile; endif; ?>

  </div>
  <div class="right">

    <?php get_sidebar(); ?>

  </div>
  </div>

<?php get_footer(); ?>