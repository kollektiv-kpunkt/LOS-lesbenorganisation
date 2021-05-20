<?php
global $i18n;
?>


<form action="#" class="los-ajax" data-interface="member">
    <div class="form-content">
        <h5 class="form-subtitle"><?= $i18n["member-type"] ?></h5>
        <div class="type-cont">
            <div class="input-group">
                <input type="radio" id="regular" name="type" value="reg" checked required>
                <label for="regular"><?= $i18n["member-type-reg"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="reduced" name="type" value="reduced">
                <label for="reduced"><?= $i18n["member-type-reduced"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="u20" name="type" value="u20">
                <label for="u20"><?= $i18n["member-type-u20"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="couple" name="type" value="couple">
                <label for="couple"><?= $i18n["member-type-couple"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="group" name="type" value="group">
                <label for="group"><?= $i18n["member-type-group"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="sympi" name="type" value="sympi">
                <label for="sympi"><?= $i18n["member-type-sympi"] ?></label>
            </div>
        </div>
        <hr class="form-hr">
        <select name="anrede" id="anrede" class="fullwidth" required>
            <option selected disabled><em><?= $i18n["anrede"] ?></em></option>
            <option value="1"><?= $i18n["female"] ?></option>
            <option value="2"><?= $i18n["male"] ?></option>
            <option value="3"><?= $i18n["neutral"] ?></option>
        </select>
        <input type="text" placeholder="<?= $i18n["organisation"] ?> *" class="fullwidth" name="orga" style="display: none">
        <input type="text" placeholder="<?= $i18n["fname"] ?> *" name="fname" required>
        <input type="text" placeholder="<?= $i18n["lname"] ?> *" name="lname" required>
        <input type="email" class="fullwidth" placeholder="<?= $i18n["email"] ?> *" name="email" required>
        <div class="info-couple" style="display: none">
            <h5 class="form-subtitle"><?= $i18n["member-info-couple"] ?></h5>
            <div class="form-flex">
                <input type="text" placeholder="<?= $i18n["fname"] ?> *" name="fname2">
                <input type="text" placeholder="<?= $i18n["lname"] ?> *" name="lname2">
                <input type="email" class="fullwidth" placeholder="<?= $i18n["email"] ?> *" name="email2">
            </div>
        </div>
        <hr class="form-hr" id="couple-hr" style="display: none">
        <input type="text" class="fullwidth" placeholder="<?= $i18n["street"] ?> *" name="street" required>
        <input type="text" placeholder="<?= $i18n["plz"] ?> *" name="plz" required>
        <input type="text" placeholder="<?= $i18n["place"] ?> *" name="place" required>
        <hr class="form-hr">
        <h5 class="form-subtitle"><?= $i18n["member-amount"] ?></h5>
        <div class="amount-cont">
            <div class="input-group">
                <input type="checkbox" id="nl" name="amount[nl]" value="nl">
                <label for="nl"><?= $i18n["member-amount-nl"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="m-mails" name="amount[m-mails]" value="m-mails" checked>
                <label for="m-mails"><?= $i18n["member-amount-m-mails"] ?></label>
            </div>
        </div>
        <hr class="form-hr">
        <h5 class="form-subtitle"><?= $i18n["member-lang"] ?></h5>
        <div class="lang-cont">
            <div class="input-group">
                <input type="radio" id="lang-de" name="lang" value="de" checked required>
                <label for="lang-de"><?= $i18n["member-lang-de"] ?></label>
            </div>
            <div class="input-group">
                <input type="radio" id="lang-fr" name="lang" value="fr">
                <label for="lang-fr"><?= $i18n["member-lang-fr"] ?></label>
            </div>
        </div>
        <hr class="form-hr inv">
        <input class="fullwidth" type="tel" placeholder="<?= $i18n["phone"] ?>" name="phone">
        <small class="form-helper"><?= $i18n["phone-helper"] ?></small>
        <input class="fullwidth" type="number" placeholder="<?= $i18n["year"] ?>" name="year">
        <small class="form-helper"><?= $i18n["year-helper"] ?></small>
        <hr class="form-hr">
        <h5 class="form-subtitle"><?= $i18n["member-notes"] ?></h5>
        <input class="fullwidth" type="text" placeholder="<?= $i18n["member-notes-helper"] ?>" name="notes">
        <input type="hidden" value="<?= uniqid("member_") ?>" name="uuid">
        
        <hr class="form-hr inv">

        <button type="submit"><?= $i18n["member-submit"] ?></button>
    </div>
    <div class="form-alert"></div>
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</form>
<small><?= $i18n["nl_dataprotection"] ?></small>

<?php
wp_enqueue_style( 'member-form', get_template_directory_uri() . "/style/modules/member-form.css" );
?>