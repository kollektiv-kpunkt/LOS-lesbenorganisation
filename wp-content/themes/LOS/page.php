<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="mdcont twocol">
    <main class="page-content">
        <h1 class="page-title"><?= the_title() ?></h1>
        <?= the_content() ?>
        <?php
        if( have_rows('pb_rows') ):
            $numrows = count( get_field('pb_rows'));
            $i = 1;
            while ( have_rows('pb_rows') ) : the_row(); ?>
            <div <?php print ($i < $numrows) ? "class='module m4 " . get_row_layout() . "'" : "class='" . get_row_layout() . "'";?> id="row-id-<?= get_the_ID()?>-<?= $i ?>"> <?php
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
                elseif( get_row_layout() == 'pb_navtiles' ):
                    get_template_part("modules/builder/nav-tiles");
                elseif( get_row_layout() == 'pb_toggle' ):
                    get_template_part("modules/builder/toggle");
                elseif( get_row_layout() == 'pb_person_grid' ):
                    get_template_part("modules/builder/person-grid");
                elseif( get_row_layout() == 'pb_member_form' ):
                    get_template_part("modules/builder/member-form");
                elseif( get_row_layout() == 'pb_activist_form' ):
                    get_template_part("modules/builder/activist-form");
                elseif( get_row_layout() == 'pb_blog_grid' ):
                    get_template_part("modules/builder/blog-grid");
                endif; ?>
            </div> 
            <?php
            $i++;
            endwhile;
        else :
        endif;
        ?>
    </main>
    <div id="cta-desk">
        <?php
            if (!get_field("cta_status") == 1) {
                get_template_part("modules/cta");
            }
        ?>
    </div>
</div>

<div class="mdcont" id="cta-mob">
    <div id="cta-mob-cont">
        <?php
            if (!get_field("cta_status") == 1) {
                get_template_part("modules/cta");
            }
        ?>
    </div>
</div>

<div class="mdcont">
    <?php

    if (!get_field("donate_box_status") == "") {
        get_template_part("modules/donate-box");
    }
    ?>
</div>

<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
get_footer();
?>