<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$feaimg = get_the_post_thumbnail_url();
$author_id = get_field("post_author");
$author_name = get_the_title($author_id);
$author_img_id = get_field("person_img", $author_id);
$author_img_url = wp_get_attachment_image_url($author_img_id, "thumbnail");
?>

<div class="mdcont">
    <p class="buttonfont bf-1 post-subtitle"><?= the_field("post_subtitle") ?></p>
    <h2 class="post-title"><?= the_title() ?></h2>
    <main class="post-content">
        <p class="lead"><?= the_field("post_lead") ?></p>

        <div class="info-box">
            <img src="<?= $author_img_url ?>" alt="<?= $author_name ?>, Autor:in" class="author">
            <span class="info-text"><?= $i18n["author_by"] ?> <b><?= $author_name ?></b> | <?= the_date("d.m.Y") ?></span>
        </div>

        <img class="feaimg" src="<?= $feaimg ?>" alt="">


        <?php
        if( have_rows('pb_rows') ):
            $numrows = count( get_field('pb_rows'));
            $i = 1;
            while ( have_rows('pb_rows') ) : the_row(); ?>
            <div class='module m4 <?= get_row_layout() ?>' id="row-id-<?= get_the_ID()?>-<?= $i ?>"> <?php
                if( get_row_layout() == 'pb_simple_text' ):
                    get_template_part("modules/builder/simple-text");
                elseif( get_row_layout() == 'pb_simple_img' ):
                    get_template_part("modules/builder/simple-img");
                elseif( get_row_layout() == 'pb_text_img' ):
                    get_template_part("modules/builder/text-img");
                elseif( get_row_layout() == 'pb_blockquote' ):
                    get_template_part("modules/builder/blockquote");
                elseif( get_row_layout() == 'pb_yt_video' ):
                    get_template_part("modules/builder/yt-video");
                elseif( get_row_layout() == 'pb_post_link' ):
                    get_template_part("modules/builder/post-link");
                elseif( get_row_layout() == 'pb_button' ):
                    get_template_part("modules/builder/button");
                elseif( get_row_layout() == 'pb_toggle' ):
                    get_template_part("modules/builder/toggle");
                elseif( get_row_layout() == 'pb_person_grid' ):
                    get_template_part("modules/builder/person-grid");
                endif; ?>
            </div> 
            <?php
            $i++;
            endwhile;
        else :
        endif;
        ?>
    </main>
    <div class="teasers-cont">
        <?php
        $next = get_adjacent_post(false, "", false);
        if ($next->ID) { 
            $id = $next->ID;
            ?>
            <div class="blog-card">
                <p class="buttonfont blog-subtitle"><?= $i18n["next-post"] ?></p>
                <hr class="blog-hr">
                <a href="<?= get_the_permalink($id) ?>"><div class="blog-feaimg aspect-ratio" ar-width="16" ar-height="9" ar-min="0" style="background-image:url('<?= get_the_post_thumbnail_url($id, "large") ?>')"></div></a>
                <a href="<?= get_the_permalink($id) ?>"><h3 class="red"><?= get_the_title($id) ?></h3></a>
                <p class="card-excerpt"><?= the_field("post_excerpt", $id) ?></p>
                <a class="readmore buttonfont red" href="<?= get_the_permalink($id) ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
            </div>
        <?php }


        $prev = get_adjacent_post(false, "", true);
        if ($prev->ID) {
            $id = $prev->ID;
            ?>
            <div class="blog-card">
                <p class="buttonfont blog-subtitle"><?= $i18n["last-post"] ?></p>
                <hr class="blog-hr">
                <a href="<?= get_the_permalink($id) ?>"><div class="blog-feaimg aspect-ratio" ar-width="16" ar-height="9" ar-min="0" style="background-image:url('<?= get_the_post_thumbnail_url($id, "large") ?>')"></div></a>
                <a href="<?= get_the_permalink($id) ?>"><h3 class="red"><?= get_the_title($id) ?></h3></a>
                <p class="card-excerpt"><?= the_field("post_excerpt", $id) ?></p>
                <a class="readmore buttonfont red" href="<?= get_the_permalink($id) ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
            </div>
        <?php }
        ?>
    </div>
</div>

<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
wp_enqueue_style( 'single', get_template_directory_uri() . "/style/elements/single.css" );
get_footer();
?>