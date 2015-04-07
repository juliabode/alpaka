<div class="share-box">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook"></i></a>
    <a href="https://twitter.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter"></i></a>
    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
    <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo $thumb_url[0]; ?>&amp;description=" target="_blank"><i class="fa fa-pinterest-p"></i></a>
    <a href="http://tumblr.com/widgets/share/tool?canonicalUrl=<?php the_permalink(); ?>&amp;posttype=photo&amp;caption=<?php the_title(); ?>&amp;content=<?php echo $thumb_url[0]; ?>" target="_blank"><i class="fa fa-tumblr"></i></a>
</div>