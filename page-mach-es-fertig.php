<?php
/*
Template Name: Finish It Projects
*/
?>

<div class="large-8 medium-8 small-12 column">
    <?php while (have_posts()) : the_post(); ?>
      <?php get_template_part('templates/page', 'header'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
    <?php endwhile; ?>
<?php

$args = array( 'post_type' => 'ame_project', 'posts_per_page' => -1 );
$loop = new WP_Query( $args );

function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
?>

    <div class="finish-it-wrapper">
        <ul class="small-block-grid-1 large-block-grid-2">

            <?php while ( $loop->have_posts() ) : $loop->the_post();

                $thumb_id = get_post_thumbnail_id();
                $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
                $taxonomies = get_the_terms(get_the_ID(), 'type'); ?>

                <li>
                    <a href="<?php the_permalink(); ?>">
                        <header style="background-image:url(<?php echo $thumb_url[0]; ?>)"></header>
                        <span class="title">
                            <h3><?php the_title(); ?></h3>
                            <?php the_excerpt(); ?>
                        </span>
                    </a>
                </li>

            <?php
            endwhile;
        ?>

    </div>

</div>

<aside class="sidebar large-4 medium-4 small-12 column" role="complementary">
  <?php dynamic_sidebar('sidebar-primary'); ?>
</aside><!-- /.sidebar -->