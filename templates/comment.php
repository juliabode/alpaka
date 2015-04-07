<?php echo get_avatar($comment, $size = '64'); ?>
<div class="media-body">
    <p class="media-heading"><?php echo get_comment_author_link(); ?></p>
    <p class="media-date"><time datetime="<?php echo get_comment_date('c'); ?>"><?php printf(__('%1$s', 'roots'), get_comment_date('j. F Y'),  get_comment_time('G:i:s')); ?></time></p>

    <?php if ($comment->comment_approved == '0') : ?>
    <div class="alert alert-info">
        <?php _e('Your comment is awaiting moderation.', 'roots'); ?>
    </div>
    <?php endif; ?>

    <div class="media-comment"><?php comment_text(); ?></div>
    <div class="comment-reply-box">
        <?php comment_reply_link(array_merge($args, array(
            'depth' => $depth,
            'max_depth' => $args['max_depth'],
            'after' => ' <i class="fa fa-chevron-right"></i>'))); ?>
    </div>