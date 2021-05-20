<?php
global $i18n;
$lang = get_option( 'los_lang' );
?>

<div class="nl-cont">
    <h4><?= $i18n["nl_title"] ?></h4>
    <p><?= $lang["nl_text"] ?></p>
    <form action="#" class="los-ajax nl-form" data-interface="newsletter">
        <div class="form-content">
            <input type="text" placeholder="<?= $i18n["fname"] ?> *" name="fname" required>
            <input type="text" placeholder="<?= $i18n["lname"] ?> *" name="lname" required>
            <input type="email" placeholder="<?= $i18n["email"] ?> *" name="email" required>
            <button type="submit"><?= $i18n["subscribe"] ?></button>
        </div>
        <div class="form-alert" id="form-alert"></div>
        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
    </form>
    <small><?= $i18n["nl_dataprotection"] ?></small>
</div>