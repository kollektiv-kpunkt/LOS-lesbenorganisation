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
        <script src="https://tamaro.raisenow.com/sp-schweiz/latest/widget.js"></script>
        <script>
            window.rnw.tamaro.runWidget('.rnw-widget-container', {
            language: '<?= $i18n["_CODE"] ?>',
            testMode: true,
            debug: false,
            purposes: ['p1'],
            purposeDetails: {
                p1: {
                    stored_campaign_id: 28869669,
                },
                },
                paymentTypes: [
                  'onetime',
                  'recurring'
                ],
            translations: {
                    de: {
                    purposes: {
                        p1: 'CO2-Gesetz',
                    },
                },
                fr: {
                    purposes: {
                        p1: 'Loi sur le CO2',
                    },
                },
                it: {
                    purposes: {
                        p1: 'Legge sul CO2',
                    },
                }, 
            },
            showStoredCustomerEmailPermission: false,
            paymentFormPrefill: {
                stored_customer_email_permission: true,
                stored_customer_donation_receipt: true,
                stored_customer_country: 'CH',
                stored_sxt_address_source: '1008'
                },
                amounts: [
                {
                    "if": "paymentType() == onetime",
                        "then": [10,30,80,100],
                }
                ],
                paymentSlipDeliveryTypes: [
                {
                    "if": "paymentType() == onetime",
                        "then": ['download','mail'],
                },
                {
                    "if": "paymentType() == recurring",
                        "then": ['mail'],
                },
                ],
            })
        </script>
        <style>
            :root {
                --tamaro-primary-color: var(--red);
                --tamaro-primary-color__hover: rgba(190, 22, 34, 0.75);
                --tamaro-primary-bg-color: rgba(228,2,45,0.03);
                --tamaro-border-color: var(--grey);
                --tamaro-bg-color: var(--white);
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