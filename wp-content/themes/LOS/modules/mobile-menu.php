<?php
global $i18n;
?>

<div id="mobile-menu-cont" class="mdcont">
    <div id="mobile-main-menu">
        <?php
        wp_nav_menu( array(
            'menu'              => "MAIN", 
            'menu_class'        => "mobile-main-menu"
        ) );
        ?>
    </div>
    <div id="close-box" class="buttonfont bf-2"><i class="ri-close-line"></i><span id="close-text"><?= $i18n["close-menu"] ?></span></div>
    <div id="lang-box" class="buttonfont">
        <a href="#" class="lang-pick current" data-lang="1"><?= $i18n["_CODE"] ?></a> /
        <a href="#" class="lang-pick" data-lang="<?= $i18n["_NOT1-url"] ?>"><?= $i18n["_NOT1"] ?></a>
    </div>
    <div id="easter-egg" class="buttonfont">
        <small id="mobile-dataprotec"><a href="<?= $i18n["dataprotec-link"] ?>" target="_blank"><?= $i18n["dataprotec-text"] ?></a></small>
        <small><a href="https://www.kpunkt.ch" target="_blank" rel="noreferrer">Webdesign by <strong>K.</strong></a></small>
    </div>
</div>



<?php
wp_enqueue_style( 'mobile-menu', get_template_directory_uri() . "/style/elements/mobile-menu.css" );
?>