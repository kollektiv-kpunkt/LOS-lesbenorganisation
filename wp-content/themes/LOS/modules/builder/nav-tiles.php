<div class="navtiles">
    <?php
    if( have_rows('nt_grid') ):
        while ( have_rows('nt_grid') ) : the_row();
            
            if (get_sub_field("nt_type") == 1) {
                $postid = get_sub_field("nt_site");
                $url = get_the_permalink($postid);
                $target = "";
            } else {
                $url = get_sub_field("nt_url");
                $target = " target='_blank'";
            }
            ?>
                <a href="<?= $url ?>"<?= $target ?> class="navtile aspect-ratio" ar-width="1" ar-height="1" ar-min="0" style="background-image: linear-gradient(0deg, rgba(190, 22, 34, 0.6), rgba(190, 22, 34, 0.6)), url('<?= the_sub_field("nt_img") ?>')">
                    <div class="navtile-text buttonfont bf-2"><?= the_sub_field("nt_title") ?></div>
                </a>
        <?php
        endwhile;
    endif;
    ?>
</div>

<?php
wp_enqueue_style( 'navtiles', get_template_directory_uri() . "/style/modules/navtiles.css" );
?>