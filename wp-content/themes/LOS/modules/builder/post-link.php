<?php
global $i18n;
global $post;
$id = get_sub_field("module_post_link");
$feaimg = get_the_post_thumbnail_url($id, 'medium');
$title = get_the_title($id);
$excerpt = get_field("post_excerpt", $id)
?>

<div class="single-card">

    <div class="card-img aspect-ratio" style="background-image: url('<?= $feaimg ?>')"></div>
    <div class="card-cont">
        <a href="<?= get_the_permalink($id) ?>"><h5 class="red"><?= $title ?></h5></a>
        <small class="date"><?= get_the_date("d.m.y", $id) ?> | <?= $i18n["author_by"] ?> Kathrin Meng</small>
        <p class="excerpt"><?= $excerpt ?></p>
        <a class="readmore buttonfont red" href="<?= get_the_permalink($id) ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
    </div>

</div>

<?php
wp_enqueue_style( 'post-link', get_template_directory_uri() . "/style/modules/post-link.css" );
?>