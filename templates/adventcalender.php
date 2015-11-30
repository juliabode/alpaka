<?php
    $i = 1;
    $custom_posts = get_posts( array(
           'numberposts' => 1, // we want to retrieve all of the posts
           'post_type' => 'weeklies',
           'type' => 'adventcalender'
        ) );
?>

<link href='http://fonts.googleapis.com/css?family=Vollkorn:700' rel='stylesheet' type='text/css'>
<div class="row adventcalender snow">
    <?php for ($j=0; $j<=50; $j++) {

        echo "<div class='flake'></div>";

    } ?>

    <h2><?php _e('Advent Calender', 'roots'); ?></h2>
    <ul class="small-block-grid-3 medium-block-grid-4 large-block-grid-6">

        <?php foreach ($custom_posts as $post) { ?>
            <?php $thumb_id = get_post_thumbnail_id();
                  $thumb_url = wp_get_attachment_image_src($thumb_id,'thumbnail', true); ?>
            <?php echo "<li><a href='" . $post->guid . "'><div class='door open' style='background-image:url(" . $thumb_url[0] . "'>" . $i. "</div></a></li>";
                  $i++ ?>
        <?php } ?>

        <?php for ($i; $i<=24; $i++) {

            echo "<li><div class='door'>" . $i . "</div></li>";

        } ?>
    </ul>
</div>