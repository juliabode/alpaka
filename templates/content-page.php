<div class="page-content">
    <div class="page-header">
        <h1 class="entry-title">
            <span><?php echo roots_title(); ?></span>
        </h1>
    </div>
    <?php the_content(); ?>
    <?php wp_link_pages(array('before' => '<nav class="pagination">', 'after' => '</nav>')); ?>
</div>