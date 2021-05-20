<?php
$status = get_sub_field("toggle_status");
global $i18n;
?>


<details <?php print ($status == 2) ? "open" : "";?>>
    <summary>
        <div class="safari-fix">
            <span><?= get_sub_field("module_toggle_summary") ?></span>
            <i class="ri-arrow-drop-down-line control-icon control-icon-expand"></i>
            <i class="ri-close-line control-icon control-icon-close"></i>
        </div>
    </summary>

    <?php
    $numrows = count( get_sub_field('module_toggle_layouts'));
    if( have_rows('module_toggle_layouts') ):
        $i = 1;
        while ( have_rows('module_toggle_layouts') ) : the_row(); ?>
        <div <?php print ($i < $numrows) ? "class='module m2'" : "";?> <?php print ($i = 1) ? "style='margin-top:1rem'" : "" ?>> <?php
            if( get_row_layout() == 'toggle_text' ):
                get_template_part("modules/builder/simple-text");
            elseif( get_row_layout() == 'toggle_video' ):
                get_template_part("modules/builder/yt-video");
            elseif( get_row_layout() == 'toggle_button' ):
                get_template_part("modules/builder/button");
            endif; ?>
        </div> <?php
        $i++;
        endwhile;
    else :
    endif;
    ?>

</details>

<?php
wp_enqueue_style( 'toggle', get_template_directory_uri() . "/style/modules/toggle.css" );
?>