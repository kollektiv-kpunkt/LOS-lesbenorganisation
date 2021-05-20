<?php
/**
* Template Name: Navigation Page
*/
get_header();
if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="mdcont twocol">
    <main class="page-content">
        <h1 class="page-title"><?= the_title() ?></h1>
        <?= the_content() ?>
    </main>
    <div id="cta-desk">
        <?php
            if (!get_field("cta_status") == 1) {
                get_template_part("modules/cta");
            }
        ?>
    </div>
</div>
<div class="mdcont module mt m5">
    <?php
        get_template_part("modules/builder/nav-tiles");
        ?>
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

<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
get_footer();
?>