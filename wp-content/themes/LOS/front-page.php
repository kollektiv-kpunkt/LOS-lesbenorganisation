<?php
get_header();
?>

<div class="mdcont">

<div id="fp-hero-cont" class="module m5">
    <div id="fp-heroine" class="aspect-ratio" ar-width="16" ar-height="7" ar-min="980">
        <?php
        if( have_rows('fp_hero_posts') ):
            $i = 1;
            while ( have_rows('fp_hero_posts') ) : the_row();
            $postid = get_sub_field("fp_hero_post");
                ?>
                <div class="heroine-slide <?php print ($i == 1) ? "active" : ""; ?>" slide-id="<?=$i?>">
                    <div class="slide-img" style="background-image: url('<?=get_the_post_thumbnail_url($postid, "large") ?>');">
                    </div>
                    <div class="slide-cont">
                        <h5><?= get_field('post_subtitle', $postid) ?></h5>
                        <h3><?= get_the_title($postid) ?></h5>
                        <p class="slide-lead"><?= get_field('post_excerpt', $postid) ?></p>
                        <a class="readmore buttonfont" href="<?= get_the_permalink($postid) ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
                    </div>
                </div>
            <?php
            $i++;
        endwhile;
        endif;
        ?>
    </div>
    <div id="hero-bottom">
        <div id="page-cont">
            <?php
            for ($x = 1; $x < $i; $x++): ?>
            <div class="heroine-page <?php echo ($x == 1) ? "active" : "" ?>" page-id="<?= $x ?>"></div>    
            <?php endfor; 
            ?>
        </div>
        <div id="arrow-cont">
            <i class="ri-arrow-left-line page-arrow prev"></i>
            <i class="ri-arrow-right-line page-arrow next"></i>
        </div>
    </div>
</div>

<div class="module">
    <?php
    get_template_part("modules/builder/nav-tiles");
    ?>
</div>

<?php
get_template_part("modules/blog-fp");
?>

<?php

if (!get_field("donate_box_status") == "") {
    get_template_part("modules/donate-box");
}

?>

</div>


<?php
wp_enqueue_style( 'home', get_template_directory_uri() . "/style/pages/home.css" );
wp_enqueue_script( 'home', get_template_directory_uri() . '/js/pages/home.js', array ( 'jquery' ), 1.1, true);
get_footer();
?>