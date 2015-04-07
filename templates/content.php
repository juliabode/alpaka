<article <?php post_class(); ?>>
    <?php   $thumb_id = get_post_thumbnail_id();
            $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); ?>
    <a href="<?php the_permalink(); ?>"><header style="background-image:url(<?php echo $thumb_url[0]; ?>)"></header></a>

    <div class="post-content">
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="meta"><?php get_template_part('templates/entry-meta'); ?></div>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>

        <?php get_template_part('templates/social-box'); ?>
    </div>
</article>
