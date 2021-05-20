<?php
$id = explode("=", get_sub_field("module_yt_url"))[1];
$videodesc = get_sub_field("module_yt_desc");
?>

<iframe class="aspect-ratio yt-video" ar-width="<?= the_sub_field("module_ar_width") ?>" ar-height="<?= the_sub_field("module_ar_height") ?>" ar-min="0" src="https://www.youtube.com/embed/<?= $id ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
<?php if ($videodesc != "") { ?> <p class="video-desc"><small><?= $videodesc ?></small></p> <?php } ?>

<?php
wp_enqueue_style( 'yt-video', get_template_directory_uri() . "/style/modules/yt-video.css" );
?>