<?php
$id = get_sub_field("module_img");
$src = wp_get_attachment_image_src( $id, 'large' );
$srcset = wp_get_attachment_image_srcset( $id, 'large' );
$sizes = wp_get_attachment_image_sizes( $id, 'large' );
$alt = get_post_meta( $id, '_wp_attachment_image_alt', true);
$placement = get_sub_field("module_img_placement");
$imgdesc = get_sub_field("module_img_desc");
?>

<div class="text-img-cont">

<?php
if ($placement == 1):
?>

<div class="module-text-cont">
    <?= the_sub_field("module_text") ?>
</div>

<div class="module-img-cont">
    <img class="simple-img" src="<?php echo esc_attr( $src );?>"
        srcset="<?php echo esc_attr( $srcset ); ?>"
        sizes="<?php echo esc_attr( $sizes );?>"
        alt="<?php echo esc_attr( $alt );?>" />
    <?php if ($imgdesc != "") { ?> <p class="img-desc"><small><?= the_sub_field("module_img_desc") ?></small></p> <?php } ?>
</div>

<?php
elseif ($placement == 2):
?>

<div class="module-img-cont">
    <img class="simple-img" src="<?php echo esc_attr( $src );?>"
        srcset="<?php echo esc_attr( $srcset ); ?>"
        sizes="<?php echo esc_attr( $sizes );?>"
        alt="<?php echo esc_attr( $alt );?>" />
    <?php if ($imgdesc != "") { ?> <p class="img-desc"><small><?= the_sub_field("module_img_desc") ?></small></p> <?php } ?>
</div>

<div class="module-text-cont">
    <?= the_sub_field("module_text") ?>
</div>


<?php
endif;
?>
</div>

<?php
wp_enqueue_style( 'simple-img', get_template_directory_uri() . "/style/modules/simple-img.css" );
wp_enqueue_style( 'text-img', get_template_directory_uri() . "/style/modules/text-img.css" );
?>