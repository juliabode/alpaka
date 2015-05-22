<?php
/*
Template Name: About Me
*/

?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>

        <div class="large-12 medium-12 small-12 column about-me-page">
            <?php get_template_part('templates/page', 'header'); ?>

            <div class="page-content">
                <div class="page-header">
                    <h1 class="entry-title">
                        <span><?php echo roots_title(); ?></span>
                    </h1>
                </div>

                <div class="row entry-content">
                    <div class="column small-8">
                        <?php the_content(); ?>
                    </div>
                    <div class='column small-4'>
                        <?php the_widget( 'alpaka_widget' ); ?>
                    </div>
                </div>
        </div>
    <?php endwhile; ?>
<?php endif; ?>