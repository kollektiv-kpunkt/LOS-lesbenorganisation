<aside class="aside-content <?php print (get_field("cta_type") == 2) ? "nl-cta" : "" ?>">
    <?php

    if (get_field("cta_type") == 2) {
        get_template_part("modules/nl-form");
    } else { ?>
        <h4 class="nohyphen"><?= the_field("cta_title") ?></h4> <?php
        // Check value exists.
        if( have_rows('cta_layout') ):
    
            // Loop through rows.
            while ( have_rows('cta_layout') ) : the_row();
    
                // Case: Paragraph layout.
                if( get_row_layout() == 'cta_text_layout' ): ?>
                    <p><?= the_sub_field("cta_text") ?></p>
                <?php 
                elseif( get_row_layout() == 'cta_button_layout' ):
                    if (get_sub_field("btn_type") == "Internal") {
                        $url = get_the_permalink(get_sub_field("btn_obj"));
                    } else if (get_sub_field("btn_type") == "External") {
                        $url = get_sub_field("btn_url");
                    }
                    ?>
                    <a class="button mg fullwidth" href="<?= $url ?>"><?= the_sub_field("btn_text") ?></a>
                <?php
                endif;
    
            // End loop.
            endwhile;
    
        // No value.
        else :
            // Do something...
        endif;
    }

    ?>
</aside>