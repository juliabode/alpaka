<time class="published" datetime="<?php echo get_the_time('c'); ?>"><i class="fa fa-calendar"></i> <?php echo get_the_date(); ?></time>
<p class="byline author vcard"><i class="fa fa-user"></i> <?php echo __('By', 'roots'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a></p>
<p><i class="fa fa-folder-o"></i><span class="categories"><?php echo get_the_category_list(', '); ?></span></p>
