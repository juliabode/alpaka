<div class="row">
    <div class="large-8 medium-8 small-12 column">

        <?php $query_args = array(
                'cat'            => $cat,
                'posts_per_page' => -1,
                'post__not_in'  => array(19, 676, 744),
              );
              query_posts($query_args);
        ?>

        <?php if (!have_posts()) : ?>
          <div class="alert alert-warning">
            <?php _e('Sorry, no results were found.', 'roots'); ?>
          </div>
          <?php get_search_form(); ?>
        <?php endif; ?>

        <ul class="small-block-grid-1 medium-block-grid-1 large-block-grid-2 project-52-page">
            <?php while (have_posts()) : the_post(); ?>
              <?php get_template_part('templates/content', 'single-projekt-52'); ?>
            <?php endwhile; ?>
        </ul>

        <?php if ($wp_query->max_num_pages > 1) : ?>
          <nav class="post-nav">
            <ul class="pager">
              <li class="previous"><?php next_posts_link(__('&larr; Older posts', 'roots')); ?></li>
              <li class="next"><?php previous_posts_link(__('Newer posts &rarr;', 'roots')); ?></li>
            </ul>
          </nav>
        <?php endif; ?>
    </div>

    <aside class="sidebar large-4 medium-4 small-12 column" role="complementary">
      <?php dynamic_sidebar('sidebar-primary'); ?>
    </aside><!-- /.sidebar -->
</div>