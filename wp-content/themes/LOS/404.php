<?php
get_header();

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,"https://api.thecatapi.com/v1/images/search");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

$headers = [
    'x-api-key: 643065fe-435e-4923-a1e5-db3482e2ef41'
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec ($ch);

$response = json_decode($response);

curl_close ($ch);

$büsi = $response[0]->url
?>

<div class="mdcont">
    <h1 class="page-title">404 - Büsi not found</h1>
    <p><?= $i18n["404"] ?></p>
    <a href="/" class="button mg">Home</a>
    <img id="error-buesi" src="<?=$büsi?>" alt="404 - Page not found">
</div>

<?php
wp_enqueue_style( 'home', get_template_directory_uri() . "/style/pages/404.css" );
get_footer();
?>