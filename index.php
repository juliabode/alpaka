<div class="large-8 medium-8 small-12 column">

    <?php //echo do_shortcode('[adventcalender]'); ?>

    <?php if (!have_posts()) : ?>
      <div class="alert alert-warning">
        <?php _e('Sorry, no results were found.', 'roots'); ?>
      </div>
      <?php get_search_form(); ?>
    <?php endif; ?>

    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/content', get_post_format()); ?>
    <?php endwhile; ?>

    <?php if ($wp_query->max_num_pages > 1) : ?>
      <nav class="post-nav">
        <ul class="pager">
          <li class="previous left"><?php next_posts_link(__('<i class="fa fa-chevron-left"></i> Older posts', 'roots')); ?></li>
          <li class="next right"><?php previous_posts_link(__('Newer posts <i class="fa fa-chevron-right"></i>', 'roots')); ?></li>
        </ul>
      </nav>
    <?php endif; ?>
</div>

<aside class="sidebar large-4 medium-4 small-12 column" role="complementary">
  <?php dynamic_sidebar('sidebar-primary'); ?>
</aside><!-- /.sidebar -->