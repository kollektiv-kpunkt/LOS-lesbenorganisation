<?php
global $i18n;
$lang = get_option( 'los_lang' );
?>

</div>

<footer class="mdcont">
    <div id="footer-grid" class="foot-2-grid">
        <?php
            get_template_part("modules/nl-form");
        ?>
        <div id="footer-inner-grid">
            <?php
            wp_nav_menu( array(
                'menu'              => "Footer", 
                'menu_class'        => "foot-menu"
            ) );
            ?>
        </div>
    </div>
    <hr class="footer-hr">
    <div id="footer-upper" class="foot-2-grid">
        <img src="<?= get_template_directory_uri() ?>/img/footer-logo.svg" alt="LOS Logo">
        <p><?= $lang["footer_upper"] ?></p>
    </div>
    <hr class="footer-hr">
    <div id="donate-cont">
        <small><?= $i18n["footer_donate"] ?></small>
        <div id="sm-cont">
            <?php
            if (isset($i18n["fb-link"])) { ?>
                <a href="<?= $i18n["fb-link"] ?>" target="_blank" rel="noreferrer"><i class="ri-facebook-fill"></i></a>
            <?php }
            if (isset($i18n["insta-link"])) { ?>
                <a href="<?= $i18n["insta-link"] ?>" target="_blank" rel="noreferrer"><i class="ri-instagram-line"></i></a>
            <?php }
            if (isset($i18n["twitter-link"])) { ?>
                <a href="<?= $i18n["twitter-link"] ?>" target="_blank" rel="noreferrer"><i class="ri-twitter-line"></i></a>
            <?php } ?>
        </div>
    </div>
    <hr class="footer-hr">
    <div id="bottom-bar">
        <small><?= $i18n["footer_copyright"] ?></small>
        <small id="dataprotec"><a href="<?= $i18n["dataprotec-link"] ?>" target="_blank"><?= $i18n["dataprotec-text"] ?></a></small>
        <small id="imprint"><a href="<?= $i18n["imprint-link"] ?>" target="_blank"><?= $i18n["imprint-text"] ?></a></small>
        <small>Built with 💜 | <a href="https://www.kpunkt.ch" target="_blank" rel="noreferrer">Webdesign by <strong>K.</strong></a></small>
    </div>
</footer>

<div id="page-transition"></div>

<script src="https://cdn.jsdelivr.net/gh/manucaralmo/GlowCookies@3.1.1/src/glowCookies.min.js"></script>
<link rel="stylesheet" href="<?= get_template_directory_uri() ?>/style/iv/cookies.css">
<script>
    glowCookies.start('en', { 
        hideAfterClick: true,
        border: 'none',
        customScript: [{ 
            type: 'custom', 
            position: 'head', 
            content: `
                var _paq = window._paq = window._paq || [];
                _paq.push(['trackPageView']);
                _paq.push(['enableLinkTracking']);
                (function() {
                var u="//analytics.los.ch/";
                _paq.push(['setTrackerUrl', u+'matomo.php']);
                _paq.push(['setSiteId', '<?= $i18n["matomo-id"]?>']);
                var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
                g.type='text/javascript'; g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
                })();    
        ` }],
        policyLink: "<?= $i18n["dataprotec-link"] ?>",
        bannerDescription: "<?= $i18n["cookie-banner"] ?>",
        bannerLinkText: "<?= $i18n["learnmore"] ?>",
        bannerBackground: "#f5f5f5",
        bannerColor: "#232323",
        bannerHeading: "<span style='color: var(--red)'><?= $i18n["cookie-title"] ?></span>",
        bannerHeadingColor: "var(--red)",
        acceptBtnText: "<?= $i18n["accept-button"] ?>",
        acceptBtnColor: "#ffffff",
        acceptBtnBackground: "var(--red)",
        rejectBtnText: "<?= $i18n["reject-button"] ?>",
        rejectBtnColor: "#ffffff",
        rejectBtnBackground: "#232323"
    });
</script>

<?php 
get_template_part("modules/mobile-menu");
wp_footer();
?>

</body>
</html>