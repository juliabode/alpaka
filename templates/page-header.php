<?php
if ( has_post_thumbnail() ) {
    $thumb_id = get_post_thumbnail_id();
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true); ?>

    <header style="background-image:url(<?php echo $thumb_url[0]; ?>)"></header>
<?php }?>
