<?php
$author = get_sub_field("module_author");
$position = get_sub_field("module_position");
?>

<div class="blockquote-cont">
    <div class="quote"><?= the_sub_field("module_blockquote") ?></div>
    <?php if ($author != ""){ ?> <p class="author"><?= $author ?></p> <?php } ?>
    <?php if ($position != ""){ ?> <p class="position"><?= $position ?></p> <?php } ?>
</div>




<?php
wp_enqueue_style( 'blockquote', get_template_directory_uri() . "/style/modules/blockquote.css" );
?>