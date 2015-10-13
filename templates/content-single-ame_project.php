<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php   $thumb_id = get_post_thumbnail_id();
            $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); ?>
    <header style="background-image:url(<?php echo $thumb_url[0]; ?>)"></header>

    <div class="post-content">
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

        <div class="entry-content">
            <div class="row project-details">
                <div class="column small-12 large-6">
                    <div class="note">
                        <div class="sticky-tape"></div>
                        <h4><?php _e("What's missing?", 'roots'); ?></h4>
                        <ul class="fa-ul">
                            <?php
                                $mykey_values = get_field('whats_missing');
                                foreach ( $mykey_values as $value ) {
                                    $link_icon = $value['finished'] ? 'fa-check-square-o' : 'fa-square-o';
                                    echo "<li><i class='fa-li fa " . $link_icon . "'></i>" . ($value['bullet_point']) . "</li>";
                                }

                            ?>
                        </ul>
                    </div>
                </div>
                <div class="column small-12 large-6">
                    <h4><?php _e("How far am I?", 'roots'); ?></h4>
                    <div class="bar-main-container">
                        <div class="bar-percentage">
                            <?php
                                echo get_field('how_much_progress') . '%';
                            ?>
                        </div>
                        <div class="bar-container">
                            <div class="bar" style="width:<?php echo get_field('how_much_progress'); ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php the_content(); ?>
        </div>
        <?php include(locate_template('templates/social-box.php')); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
    <?php related_posts(); ?>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
