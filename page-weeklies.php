<?php
/*
Template Name: Weeklies Overview
*/
?>

<div class="large-8 medium-8 small-12 column">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>

<?php
  $args = array( 'post_type' => 'weeklies', 'posts_per_page' => -1 );
  $loop = new WP_Query( $args );
?>

  <div class="weeklies-overview">
      <?php if (!$loop->have_posts()) : ?>
        <div class="alert alert-warning">
          <?php _e('Sorry, no results were found.', 'roots'); ?>
        </div>
        <?php get_search_form(); ?>
      <?php endif; ?>

      <ul class="small-block-grid-1 medium-block-grid-2 large-block-grid-3">
          <?php while ($loop->have_posts()) : $loop->the_post(); ?>
            <li><?php get_template_part('templates/content', 'single-woechentliches'); ?></li>
          <?php endwhile; ?>
      </ul>
  </div>
</div>

<aside class="sidebar large-4 medium-4 small-12 column" role="complementary">
  <?php dynamic_sidebar('sidebar-primary'); ?>
</aside><!-- /.sidebar -->