<?php get_header(); ?>

  <div class="article-wrap">
    <div class="left articles">

    <?php $query_args = array(
            'cat'            => 4,
            'posts_per_page' => -1,
            'post__not_in'  => array(19),
          );
          query_posts($query_args); ?>

    <?php if (have_posts()) : ?>

      <h2><?php single_cat_title(); ?></h2>

      <div id="category-project-52-wrapper" class="left">
        <div id="category-project-52-inner" class="left">
          <ul>

            <?php while (have_posts()) : the_post(); ?>
            <?php $title = get_the_title(); preg_match('/(W.*)/', $title, $title_new); ?>

            <li class="left">
              <div class="inner-wrapper">
                <a href="<?php the_permalink() ?>">

                <?php if ( has_post_thumbnail() ) {
                        $thumb = get_the_post_thumbnail();
                        $search = array('/src="/', '/.png"/', '/="240"/');
                        $replace = array('src="http://alpaka.localhost/wp-content/themes/alpaka/timthumb.php?src=', '.png&w=125&h=125&zc=1"', '="125"');
                        $thumb = preg_replace($search, $replace, $thumb);
                        //echo '<div class="' . $thumb . '"></div>';
                        echo $thumb;
                      } ?>

                </a>
                <h3><a href="<?php the_permalink() ?>"><?php echo $title_new[1]; ?></a></h3>
              </div>

            </li>

          <?php endwhile; ?>

        </ul>
      </div>
    </div>

  <?php else : ?>

    <h2>Nothing found</h2>

  <?php endif; ?>
  </div>
  <div class="right">

    <?php get_sidebar(); ?>

  </div>
  </div>

<?php get_footer(); ?>