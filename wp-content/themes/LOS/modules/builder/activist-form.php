<?php
global $i18n;
?>


<form action="#" class="los-ajax" data-interface="activist">
    <div class="form-content">
        <h5 class="form-subtitle"><?= $i18n["activist-support-type"] ?></h5>
        <div class="support-type-cont">
            <div class="input-group">
                <input type="checkbox" id="webpage" name="support-type[]" value="webpage">
                <label for="webpage"><?= $i18n["activist-support-type-webpage"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="events" name="support-type[]" value="events">
                <label for="events"><?= $i18n["activist-support-type-events"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="demos" name="support-type[]" value="demos">
                <label for="demos"><?= $i18n["activist-support-type-demos"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="proofread" name="support-type[]" value="proofread">
                <label for="proofread"><?= $i18n["activist-support-type-proofread"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="translate" name="support-type[]" value="translate">
                <label for="translate"><?= $i18n["activist-support-type-translate"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="photo" name="support-type[]" value="photo">
                <label for="photo"><?= $i18n["activist-support-type-photo"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="catering" name="support-type[]" value="catering">
                <label for="catering"><?= $i18n["activist-support-type-catering"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="bar" name="support-type[]" value="bar">
                <label for="bar"><?= $i18n["activist-support-type-bar"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="some" name="support-type[]" value="some">
                <label for="some"><?= $i18n["activist-support-type-some"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="meeting" name="support-type[]" value="meeting">
                <label for="meeting"><?= $i18n["activist-support-type-meeting"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="graphics" name="support-type[]" value="graphics">
                <label for="graphics"><?= $i18n["activist-support-type-graphics"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="other" name="support-type[]" value="other">
                <label for="other"><?= $i18n["activist-support-type-other"] ?></label>
            </div>
        </div>
        <input type="text" class="fullwidth" style="margin-top: 0.5rem; display: none" placeholder="<?= $i18n["activist-support-type-other-text"] ?> *" name="other-text">
        
        <hr class="form-hr inv">
        <h5 class="form-subtitle"><?= $i18n["activist-places"] ?></h5>
        <div class="places-cont">
            <div class="input-group">
                <input type="checkbox" id="zuerich" name="places[]" value="zuerich">
                <label for="zuerich"><?= $i18n["activist-places-zuerich"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="basel" name="places[]" value="basel">
                <label for="basel"><?= $i18n["activist-places-basel"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="bern" name="places[]" value="bern">
                <label for="bern"><?= $i18n["activist-places-bern"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="winti" name="places[]" value="winti">
                <label for="winti"><?= $i18n["activist-places-winti"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="luzern" name="places[]" value="luzern">
                <label for="luzern"><?= $i18n["activist-places-luzern"] ?></label>
            </div>
            <div class="input-group">
                <input type="checkbox" id="stgallen" name="places[]" value="luzern">
                <label for="stgallen"><?= $i18n["activist-places-stgallen"] ?></label>
            </div>
        </div>
        
        <hr class="form-hr">
        <h5 class="form-subtitle"><?= $i18n["activist-information"] ?></h5>
        <input type="text" placeholder="<?= $i18n["fname"] ?> *" name="fname" required>
        <input type="text" placeholder="<?= $i18n["lname"] ?> *" name="lname" required>
        <input type="email" placeholder="<?= $i18n["email"] ?> *" name="email" required>
        <input type="tel" placeholder="<?= $i18n["phone"] ?>" name="phone">
        
        <input type="hidden" value="<?= uniqid("activist_") ?>" name="uuid">

        <button type="submit"><?= $i18n["activist-submit"] ?></button>
    </div>
    <div class="form-alert"></div>
    <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
</form>
<small><?= $i18n["nl_dataprotection"] ?></small>

<?php
wp_enqueue_style( 'activist-form', get_template_directory_uri() . "/style/modules/activist-form.css" );
?>