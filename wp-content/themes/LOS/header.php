<?php 
$lang_settings = get_option( 'los_lang' ); 
global $i18n;
include __DIR__ . "/i18n/{$lang_settings['gen']}.php";

?>
<!--
                                                                                                    
    s-     `/hdo    /+hddddddh-     s-         -o   sohddh-    -o   s-     `/hdo   `sddddddddddds`  
    MMy  .omMNh-   `Mdosyyyyysyy.  `MMy      -hMh  `MMhsNMMy.-hMh  `MMs  .omMNh-   `oyyyyyhyyyyy/`  
   -MMm.sNMNs-     -MMm      oMMo  -MMm      oMMo  -MMm .yNNdoMMo  -MMm.sNMms-          .yd:        
   /MMssmd+.       /MMs      yMM/  /MMs      yMM/  /MMs   ---yMM/  /MMssmd+.            +MMo        
   .yshdddhhho`    .yshhhhhhhyso`  .y/`      `oo`  .y/`      `oo`  .yshdddhhho`         `+s.        
   /yoyhhhhhhyy+   /yoyhhhhhh/`    /y:       -y+   /y:       -y+   /yoyhhhhhhyy+        -ss         
   NMM`     -NMd   NMM`            NMN`     -NMd   NMN`     -NMd   NMN`     -NMd       `NMN         
  .MMN      +MMs  .MMN            .MMN      +MMs  .MMN      +MMs  .MMN      +MMs       :MMd         
  :Mm+      :mM+  :Mm+             +ysyyyyyyoyo`  :Mm+      :mM+  :Mm+      :mM+       +MMs         
  :/`        `+-  :/`                ohhhhhh/     :/`        `+-  :/`        `+-       .yo`         
                                                                                                    
-->
<!DOCTYPE html>
<html lang="<?= $lang_settings["gen"] ?>" class="post-id-<?= get_the_ID()?> <?= get_post_type() ?>" style="--vh:1vh; --vw:1vw; --mcpad:15vw;">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=5.0">
    <?php wp_head() ?>
</head>
<body>

<nav id="nav-menu" class="mdcont">

    <a href="/" id="logo-link"><img src="<?= get_template_directory_uri() ?>/img/logo.svg" alt="LOS Logo"></a>

    <div id="menu-outer">
        <div id="head-nav" class="buttonfont">
            <?php
            wp_nav_menu( array(
                'menu'              => "Header", 
                'menu_class'        => "head-menu"
            ) );
            ?>
            <div id="lang-pickers">
                <a href="#" class="lang-pick current" data-lang="<?= $i18n["_CODE"] ?>"><?= $i18n["_CODE"] ?></a> /
                <a href="#" class="lang-pick" data-lang="<?= $i18n["_NOT1-url"] ?>"><?= $i18n["_NOT1"] ?></a>
            </div>
        </div>
        <div id="main-nav">
            <?php
            wp_nav_menu( array(
                'menu'              => "MAIN", 
                'menu_class'        => "main-menu"
            ) );
            ?>
        </div>
    </div>
    <div id="mobile-navmenu" class="buttonfont" id="openmenu">
        <span>Menu</span><img src="<?= get_template_directory_uri()?>/img/menu.svg" alt="*">
    </div>

</nav>

<div id="main-content">