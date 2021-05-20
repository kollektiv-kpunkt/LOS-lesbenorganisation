<?php
global $i18n;
?>

<div class="blog-grid-cont">
    
    <?php
    // WP_Query arguments
    if (get_sub_field("module_blog_category")) {
        $cat = implode(", ", get_sub_field("module_blog_category"));
        $args = array(
            'post_type' => array( 'post' ),
            'cat' => $cat,
            'nopaging' => true
        );
    } else {
        $args = array(
            'post_type' => array( 'post' ),
            'nopaging' => true
        );
    }

    // The Query
    $query = new WP_Query( $args );
    $numposts = $query->found_posts;

    // The Loop
    if ( $query->have_posts() ) {
        $i = 1;
        while ( $query->have_posts() ) {
            $query->the_post(); 
            $id = get_the_ID();
            ?>
            <div class="blog-card <?php print ($i > 2) ? "hidden" : "" ?>">
                <p class="buttonfont blog-subtitle"><?= get_field("post_subtitle", $id) ?></p>
                <hr class="blog-hr">
                <a href="<?= get_the_permalink($id) ?>"><div class="blog-feaimg aspect-ratio" ar-width="16" ar-height="9" ar-min="0" style="background-image:url('<?= get_the_post_thumbnail_url($id, "large") ?>')"></div></a>
                <a href="<?= get_the_permalink($id) ?>"><h3 class="red"><?= get_the_title($id) ?></h3></a>
                <p class="card-excerpt"><?= the_field("post_excerpt", $id) ?></p>
                <a class="readmore buttonfont red" href="<?= get_the_permalink($id) ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
            </div>

        <?php 
        $i++;
    }
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
    ?>
    
</div>

<?php
if ($numposts > 2) { ?>
<div id="loadmore-cont">
    <a href="#more" class="button end mg-2" id="loadmore"><?= $i18n["loadmore"] ?></a>
</div>
<?php } ?>

<?php
wp_enqueue_style( 'blog-grid', get_template_directory_uri() . "/style/modules/blog-grid.css" );
wp_enqueue_style( 'single', get_template_directory_uri() . "/style/elements/single.css" );
wp_enqueue_script( 'blog-grid', get_template_directory_uri() . '/js/blog-grid.js', array ( 'jquery' ), 1.1, true);
?>