<article <?php post_class(); ?>>
    <?php $connectedPost = get_post_meta(get_the_ID(), 'weeklies_checkbox');
          $weeklyID = get_the_ID();
        if ( $connectedPost[0] == 'yes') {
        $post = get_posts( array(
           'numberposts' => 1, // we want to retrieve all of the posts
           'post_type' => 'post',
           'weeklies' => basename(get_permalink()), // we want posts who are tagged with the actors taxonomy term with the slug 'tom-hanks'
           'suppress_filters' => false // this argument is required for CPT-onomies
        ) );

        $thumb_id = get_post_thumbnail_id($post[0]->ID);
        $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
        $taxonomies = get_the_terms($weeklyID, 'type');
        $taxonomy = array_shift(array_slice($taxonomies, 0, 1)) ?>

        <a href="<?php echo $post[0]->guid; ?>">
            <header class="<?php echo $taxonomy->slug; ?>" style="background-image:url(<?php echo $thumb_url[0]; ?>)">
                <span class="categories">
                    <?php
                        echo $taxonomy->name;
                    ?>
                </span>
            </header>
        </a>

        <div class="post-content">
            <div class="entry-content">
                <?php echo $post[0]->post_excerpt; ?>
                <p class="read-more"><a href="<?php echo $post[0]->guid; ?>"><?php _e('Continue reading', 'roots'); ?></a></p>
            </div>
            <?php include(locate_template('templates/social-box.php')); ?>
        </div>

    <?php } else { ?>

        <?php   $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
                $taxonomies = get_the_terms(get_the_ID(), 'type');
                $taxonomy = array_shift(array_slice($taxonomies, 0, 1)) ?>

        <a href="<?php the_permalink(); ?>">
            <header class="<?php echo $taxonomy->slug; ?>" style="background-image:url(<?php echo $thumb_url[0]; ?>)">
                <span class="categories">
                    <?php
                        echo $taxonomy->name;
                    ?></span>
            </header>
        </a>

        <div class="post-content">
            <div class="entry-content">
                <?php the_excerpt(); ?>
            </div>
            <?php include(locate_template('templates/social-box.php')); ?>
        </div>
    <?php } ?>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
</article>