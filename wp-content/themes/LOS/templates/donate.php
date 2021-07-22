<?php
/**
* Template Name: Donate
*/
get_header();
?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

<div class="mdcont twocol">
    <main class="page-content">
        <h1 class="page-title"><?= the_title() ?></h1>
        <?= the_content() ?>
        <div class="rnw-widget-container module mt m4"></div>
        <script src="https://tamaro.raisenow.com/losle-49b2/latest/widget.js"></script> 
        <script>
            window.rnw.tamaro.runWidget('.rnw-widget-container', {
                language: '<?= $i18n["_CODE"] ?>',
                testMode: false, 
            })
        </script>
        <style>
            :root {
                --tamaro-primary-color: #BE1622;
                --tamaro-primary-color__hover: #be1622ba;
                --tamaro-primary-bg-color: rgba(228,2,45,0.03);
                --tamaro-border-color: #9D9D9D;
                --tamaro-bg-color: #f5f5f5;
            }      
        </style>
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

<?php endwhile; else: ?>

<h2><?php esc_html_e( '404 Error', 'phpforwp' ); ?></h2>
<p><?php esc_html_e( 'Sorry, content not found.', 'phpforwp' ); ?></p>

<?php endif; ?>

<?php
get_footer();
?>