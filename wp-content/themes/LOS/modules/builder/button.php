<?php
if (get_sub_field("btn_type") == "Internal") {
    $url = get_the_permalink(get_sub_field("btn_obj"));
} else if (get_sub_field("btn_type") == "External") {
    $url = get_sub_field("btn_url");
}
?>
<a class="button" href="<?= $url ?>"><?= the_sub_field("btn_text") ?></a>