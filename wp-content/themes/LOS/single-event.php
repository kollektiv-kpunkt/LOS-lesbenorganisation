<?php
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$feaimg = get_the_post_thumbnail_url();
$contact = get_field("event_contact");
if ($contact != "") {
    $contact_name = get_the_title($contact);
    $contact_email = get_field("person_email", $contact);
}
?>

<div class="mdcont">
    <p class="buttonfont bf-1 post-subtitle"><?= the_field("event_crumb") ?></p>
    <h2 class="post-title"><?= the_title() ?></h2>
    <main class="post-content">
        <p class="lead"><?= the_field("event_excerpt") ?></p>
        <div class="info-box">
            <div class="info-item">
                <i class="ri-calendar-line"></i><p class="buttonfont"><?= date("d.m.Y", strtotime(get_field("event_date"))) ?></p>
            </div>
            <div class="info-item">
                <i class="ri-map-pin-line"></i><p class="buttonfont"><?= the_field("event_place") ?></p>
            </div>
            <?php
            if (isset($contact_name)) { ?>
            <div class="info-item">
                <i class="ri-user-line"></i><p class="buttonfont"><a href="mailto: <?= $contact_email ?>"><?= $contact_name ?></a></p>
            </div>
            <?php } ?>
            <?php
            if (!get_field("event_who") == "") { ?>
            <div class="info-item">
                <i class="ri-shield-check-line"></i><p class="buttonfont">LOS Event</p>
            </div>
            <?php } ?>
        </div>
        <?php print ($feaimg) ? ('<img class="feaimg" src=" ' . $feaimg . '" alt="">') : "" ?>


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

    <?php
    get_template_part("modules/donate-box");
    ?>
</div>

<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
wp_enqueue_style( 'single', get_template_directory_uri() . "/style/elements/single.css" );
wp_enqueue_style( 'single-event', get_template_directory_uri() . "/style/elements/single-event.css" );
get_footer();
?>