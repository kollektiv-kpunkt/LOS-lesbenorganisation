<?php
global $i18n;
?>

<div class="donate-box aspect-ratio" ar-width="16" ar-height="10" ar-min="850">
    <div class="donate-cont">
        <h3><?= $i18n["donate-title"] ?></h3>
        <p><strong><?= $i18n["donate-text"] ?></strong></p>
        <div class="amount-grid">
            <div class="amount-cont aspect-ratio" ar-width="3" ar-height="2.5" ar-min="0" rnw-amount="10">
                <span class="currency buttonfont bf-1">CHF</span>
                <span class="amount">10</span>
            </div>
            <div class="amount-cont active aspect-ratio" ar-width="3" ar-height="2.5" ar-min="0" rnw-amount="30">
                <span class="currency buttonfont bf-1">CHF</span>
                <span class="amount">30</span>
            </div>
            <div class="amount-cont aspect-ratio" ar-width="3" ar-height="2.5" ar-min="0" rnw-amount="80">
                <span class="currency buttonfont bf-1">CHF</span>
                <span class="amount">80</span>
            </div>
            <div class="amount-cont aspect-ratio" ar-width="3" ar-height="2.5" ar-min="0" rnw-amount="100">
                <span class="currency buttonfont bf-1">CHF</span>
                <span class="amount">100</span>
            </div>
        </div>
        <a href="<?= $i18n["donate-page"] ?>" class="button fullwidth buttonfont bf-1" id="donate-submit"><?= $i18n["donate-button"] ?></a>
    </div>
</div>

<?php
wp_enqueue_style( 'donate-box', get_template_directory_uri() . "/style/elements/donate-box.css" );
wp_enqueue_script( 'donate-box', get_template_directory_uri() . '/js/elements/donate-box.js', array ( 'jquery' ), 1.1, true);
?>