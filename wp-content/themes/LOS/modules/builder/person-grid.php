<?php
global $i18n;
?>

<div class="person-grid">
    <?php
    if( have_rows('module_people') ):
        while ( have_rows('module_people') ) : the_row();
            $personid = get_sub_field("module_person");
            $person_img = wp_get_attachment_image_url(get_field("person_img", $personid), "large");
            $person_name = get_the_title($personid);
            $person_position = get_field("person_position", $personid);
            $person_email = get_field("person_email", $personid);
            $person_phone = get_field("person_phone", $personid);
            ?>
            <div class="person-column">
                <img src="<?= $person_img ?>" alt="<?= $person_name ?>" class="person-img">
                <div class="person-content">
                    <h3 class="person-name"><?= $person_name ?></h3>
                    <p class="person-position buttonfont bf-1"><?= $person_position ?></p>
                    <?php if (isset($person_phone)) { echo("<p class='text_small'>{$person_phone}</p>");} ?>
                    <p class="text_small" style="color:var(--red); text-decoration: underline; cursor: pointer"><em><span onclick="javascript: window.location.href='mailto:<?=$person_email?>'"><?= $i18n["email"] ?></span></em></p>
                </div>
            </div>
        <?php
        endwhile;
    endif;
    ?>
</div>

<?php
wp_enqueue_style( 'person-grid', get_template_directory_uri() . "/style/modules/person-grid.css" );
?>