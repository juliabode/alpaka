<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <?php   $thumb_id = get_post_thumbnail_id();
            $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); ?>
    <header style="background-image:url(<?php echo $thumb_url[0]; ?>)"></header>

    <div class="post-content">
        <h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
        <div class="meta"><?php if (!is_singular('weeklies')) get_template_part('templates/entry-meta'); ?></div>

        <div class="entry-content">
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
