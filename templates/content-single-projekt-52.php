<?php   $thumb_id = get_post_thumbnail_id();
        $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
        $title = get_the_title(); preg_match('/(W.*)/', $title, $title_new);

        $attachements = get_attached_media( 'image' );
        $i = 0;
?>

<?php foreach ( $attachements as $attachement ) {

    if ( $attachement->ID != get_post_thumbnail_id() ) {
        $i++ ?>
        <li>
            <a href="<?php the_permalink(); ?>">
                <img src="<?php echo $attachement->guid; ?>">
                <h2 class="entry-title"><span><?php echo $title_new[1]; ?></span></h2>
            </a>
        </li>
        <?php
    }

    if ( $i >=2 ) break;
} ?>