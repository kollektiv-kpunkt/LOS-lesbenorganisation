<?php
/**
* Template Name: Events Page
*/
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); 

$feaevent = get_field("ep_featured");
$fe_crumb = get_field("event_crumb", $feaevent);
$fe_img = get_the_post_thumbnail_url($feaevent, "large");
$fe_date = date("d.m.Y", strtotime(get_field("event_date", $feaevent)));
$fe_day = explode(".", $fe_date)[0];
$fe_month = getMonth(explode(".", $fe_date)[1], $i18n["_CODE"]);
$fe_month_length = strlen($fe_month);
$fe_title = get_the_title($feaevent);
$fe_excerpt = get_field("event_excerpt", $feaevent);
$fe_link = get_the_permalink($feaevent);

?>

<div class="mdcont">
    <div id="fe-cont-desk">
        <div class="aspect-ratio featured-event" style="background-image: linear-gradient(0deg, rgba(190, 22, 34, 0.6), rgba(190, 22, 34, 0.6)), url('<?= $fe_img ?>');" ar-width="16" ar-height="8" ar-min="940">
            <div class="datebox aspect-ratio" ar-width="1" ar-height="1" ar-min="0">
                <div class="datebox-cont">
                    <span id="month" month-length="<?= $fe_month_length ?>"><?= $fe_month ?></span>
                    <span id="day"><?= $fe_day ?></span>
                </div>
            </div>
            <div class="fe-content">
                <p class="buttonfont fe-date"><?= $fe_crumb ?> </p>
                <h4 class="fe-title red"><?= $fe_title ?></h4>
                <p class="fe-excerpt"><?= $fe_excerpt ?></p>
                <a href="<?= $fe_link ?>" class="button fullwidth"><?= $i18n["learnmore"] ?></a>
            </div>
        </div>
    </div>
    <div id="fe-cont-mob">
        <div class="aspect-ratio featured-event" style="background-image: linear-gradient(0deg, rgba(190, 22, 34, 0.6), rgba(190, 22, 34, 0.6)), url('<?= $fe_img ?>');" ar-width="16" ar-height="8" ar-min="0"></div>
        <div class="mob-cont-inner">
            <p class="buttonfont fe-date"><?= $fe_date ?> </p>
            <h4 class="fe-title red"><?= $fe_title ?></h4>
            <p class="fe-excerpt"><?= $fe_excerpt ?></p>
            <a href="<?= $fe_link ?>" class="button fullwidth"><?= $i18n["learnmore"] ?></a>
        </div>
    </div>
</div>

<?php
// WP_Query arguments
$date_now = date('Y-m-d H:i:s');
$args = array(
    'post_type'         => array( 'event' ),
    'nopaging'          => true,
    'posts_per_page'	=> -1,
    'meta_query' => array(
        array(
            'key'           => 'event_date',
            'compare'       => '>=',
            'value'         => $date_now,
            'type'          => 'DATETIME',
        )
    ),
    'meta_key'			=> 'event_date',
    'orderby'			=> 'meta_value',
    'order'				=> 'ASC'
);

// The Query
$query = new WP_Query( $args );
$numevents = $query->found_posts;
// The Loop
if ( $query->have_posts() ) { ?>
    <div class="mdcont" id="eventgrid">
    <?php
        $i = 1;
        while ( $query->have_posts() ) {
            $query->the_post(); 
            $e_ID = $post->ID;
            $e_crumb = get_field("event_crumb", $e_ID);
            $e_img = get_the_post_thumbnail_url($e_ID, "medium");
            $e_date = date("d.m.Y", strtotime(get_field("event_date", $e_ID)));
            $e_day = explode(".", $e_date)[0];
            $e_month = getMonth(explode(".", $e_date)[1], $i18n["_CODE"]);
            $e_month_length = strlen($e_month);
            $e_title = get_the_title($e_ID);
            $e_excerpt = get_field("event_excerpt", $e_ID);
            $e_link = get_the_permalink($e_ID);
            if (!get_field("event_who", $e_ID) == "") {
                $los = "islos";
            } else {
                $los = "notlos";
            }
            ?>
            
            <div class="event-column-cont <?php print ($i > 6) ? "hidden" : "" ?>" >
                <p class="buttonfont crumb"><?= $e_crumb ?></p>
                <div class="event-card aspect-ratio <?= $los ?>" event-url="<?= $e_link ?>" style="background-image: url('<?= $e_img ?>');" ar-width="1" ar-height="1" ar-min="0">
                    <div class="ecard-overlay <?= $los ?>"></div>
                    <div class="event-date-cont">
                        <div class="event-date-inner">
                            <span id="month" month-length="<?= $e_month_length ?>"><?= $e_month ?></span>
                            <span id="day"><?= $e_day ?></span>
                        </div>
                    </div>
                </div>
                <div class="event-excerpt-cont">
                    <h4><?= $e_title ?></h4>
                    <p><?= $e_excerpt ?></p>
                    <a href="<?= $e_link ?>" class="button fullwidth mg"><?= $i18n["learnmore"] ?></a>
                </div>
            </div>
    
        
        <?php 
        $i++;
        } ?>
        </div> <?php
    } else {
        // no posts found
    }

    // Restore original Post Data
    wp_reset_postdata();
?>
<?php
if ($numevents > 6) { ?>
<div class="mdcont" id="loadmore-cont">
    <a href="#more" class="button end mg-2" id="loadmore"><?= $i18n["loadmore"] ?></a>
</div>
<?php } ?>


<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
wp_enqueue_style( 'events', get_template_directory_uri() . "/style/pages/events.css" );
wp_enqueue_script( 'events', get_template_directory_uri() . '/js/pages/events.js', array ( 'jquery' ), 1.1, true);
get_footer();
?>