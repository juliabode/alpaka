<article <?php post_class(); ?>>
    <?php   $thumb_id = get_post_thumbnail_id();
            $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); ?>
    <header style="background-image:url(<?php echo $thumb_url[0]; ?>)">
        <span class="categories">
            <?php
                $taxonomies = get_the_terms(get_the_ID(), 'type'); 
                foreach ( $taxonomies as $taxonomy ) {
                    echo $taxonomy->name;
                }
            ?></span>
    </header>

    <div class="post-content">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

        <div class="entry-content">
            <?php the_excerpt(); ?>
        </div>
        <?php include(locate_template('templates/social-box.php')); ?>
    </div>
    <footer>
      <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
    </footer>
</article>