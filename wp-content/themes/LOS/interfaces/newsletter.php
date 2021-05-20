<?php
require_once(__DIR__ . "/../../../../wp-load.php");
$lang_settings = get_option( 'los_lang' ); 
global $i18n;
include __DIR__ . "/../i18n/{$lang_settings['gen']}.php";

require_once(__DIR__ . '/../vendor/autoload.php');

$client = new MailchimpMarketing\ApiClient();

$client->setConfig([
    'apiKey' => $i18n["mc_api"],
    'server' => $i18n["mc_prefix"],
]);

$email = $_POST["email"];
$fname = $_POST["fname"];
$lname = $_POST["lname"];

$response = $client->lists->addListMember($i18n["mc_l-news_ID"], [
    "email_address" => $email,
    'merge_fields' => [
        "FNAME" => $fname,
        "LNAME" => $lname
    ],
    "status" => "subscribed",
]);

if ($response->email_address == $email) {
    $return = array(
        "status" => 200,
        "text" => $i18n["thx-nl"],
        "type" => "success"
    );
} else {
    $return = array(
        "status" => 500,
        "text" => $i18n["error-nl"],
        "type" => "error"
    );
}

header('Content-type: application/json');

echo(json_encode($return))

?>