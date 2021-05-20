<?php
global $i18n
?>
<div class="blog-grid module">
    <?php
    // WP_Query arguments
    $args = array(
        'post_type'              => array( 'post' ),
        'nopaging'               => false,
        'posts_per_page'         => '2',
    );

    // The Query
    $query = new WP_Query( $args );

    // The Loop
    if ( $query->have_posts() ):
        while ( $query->have_posts() ):
            $query->the_post(); ?>
            <div class="blog-card">
                <p class="buttonfont bf-1 blog-subtitle"><?= the_field("post_subtitle") ?></p>
                <hr class="blog-hr">
                <a href="<?= get_the_permalink() ?>"><div class="blog-feaimg aspect-ratio" ar-width="16" ar-height="9" ar-min="0" style="background-image:url('<?= get_the_post_thumbnail_url() ?>')"></div></a>
                <a href="<?= get_the_permalink() ?>"><h3 class="red"><?= the_title() ?></h3></a>
                <p><?= the_field("post_excerpt") ?></p>
                <a class="readmore buttonfont red" href="<?= get_the_permalink() ?>"><span><?= $i18n["readmore"] ?></span><i class="ri-arrow-drop-right-line"></i></a>
            </div>
        <?php
        endwhile;
    endif;
    wp_reset_postdata();
    ?>
</div>