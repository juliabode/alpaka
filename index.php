<div class="large-8 medium-8 small-12 column">

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
          <li class="previous left"><i class="fa fa-chevron-left"></i> <?php next_posts_link(__('Older posts', 'roots')); ?></li>
          <li class="next right"><?php previous_posts_link(__('Newer posts', 'roots')); ?> <i class="fa fa-chevron-right"></i></li>
        </ul>
      </nav>
    <?php endif; ?>
</div>

<aside class="sidebar large-4 medium-4 small-12 column" role="complementary">
  <?php dynamic_sidebar('sidebar-primary'); ?>
</aside><!-- /.sidebar -->