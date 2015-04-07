<footer class="content-info" role="contentinfo">
  <?php $options = get_option('plugin_options');?>
  <div class="row">
    <div class="column small-12">
        <p>
             &copy; <?php echo date('Y'); ?> <a class="no-link" href="/wp-admin"><?php bloginfo('name'); ?></a>
            <?php if ($options['alpaka_imprint_link']) :
                    echo '<a class="imprint" href="' . $options['alpaka_imprint_link'] . '">';
                    _e('Imprint', 'roots');
                    echo '</a>' ;
                endif;?>
        </p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
