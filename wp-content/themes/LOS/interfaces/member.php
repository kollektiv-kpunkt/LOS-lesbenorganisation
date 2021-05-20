<?php
require_once(__DIR__ . "/../../../../wp-load.php");
$lang_settings = get_option( 'los_lang' ); 
global $i18n;
global $wpdb;
include __DIR__ . "/../i18n/{$lang_settings['gen']}.php";

require_once(__DIR__ . '/../vendor/autoload.php');

$uuid = $_POST["uuid"];
$type = $_POST["type"];

$anrede = $_POST["anrede"];
if (isset($_POST["orga"]) && $_POST["orga"] != "" ) {
    $orga = $_POST["orga"];
} else {
    $orga = "";
}
$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];

if (isset($_POST["fname2"]) && $_POST["fname2"] != "" ) {
    $fname2 = $_POST["fname2"];
} else {
    $orga = "";
}
if (isset($_POST["lname2"]) && $_POST["lname2"] != "" ) {
    $lname2 = $_POST["lname2"];
} else {
    $lname2 = "";
}
if (isset($_POST["email2"]) && $_POST["email2"] != "" ) {
    $email2 = $_POST["email2"];
} else {
    $email2 = "";
}

$street = $_POST["street"];
$plz = $_POST["plz"];
$place = $_POST["place"];

$amount = $_POST["amount"];

if (isset($amount["nl"]) && isset($amount["m-mails"])) {
    $amount = "both";
} else if (isset($amount["nl"])) {
    $amount = "nl";
} else if (isset($amount["m-mails"])) {
    $amount = "m-mails";
} else {
    $return = array(
        "status" => 500,
        "text" => "Please select at least either member mails or our newsletter",
        "type" => "error"
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
}

$lang = $_POST["lang"];

if (isset($_POST["phone"]) && $_POST["phone"] != "" ) {
    $phone = $_POST["phone"];
} else {
    $phone = "";
}
if (isset($_POST["year"]) && $_POST["year"] != "" ) {
    $year = $_POST["year"];
} else {
    $year = "";
}

if (isset($_POST["notes"]) && $_POST["notes"] != "" ) {
    $notes = $_POST["notes"];
} else {
    $notes = "";
}

$query = 
    $wpdb->query( 
        $wpdb->prepare( 
            "INSERT INTO `pn27_members` 
                (`member_UUID`, `member_type`, `member_anrede`, `member_orga`, `member_fname`, `member_lname`, `member_email`, `member_fname2`, `member_lname2`, `member_email2`, `member_street`, `member_plz`, `member_place`, `member_amount`, `member_lang`, `member_phone`, `member_year`, `member_notes`) 
            VALUES 
                (%s, %s, %d, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s);",
            $uuid,
            $type,
            $anrede,
            $orga,
            $fname,
            $lname,
            $email,
            $fname2,
            $lname2,
            $email2,
            $street,
            $plz,
            $place,
            $amount,
            $lang,
            $phone,
            $year,
            $notes,
        )
    )
;

if ($query != 1) {
    $return = array(
        "status" => 501,
        "text" => $i18n["error-nl"],
        "type" => "error"
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
}

$client = new MailchimpMarketing\ApiClient();

$client->setConfig([
    'apiKey' => $i18n["mc_api"],
    'server' => $i18n["mc_prefix"],
]);


if ($amount == "both" || $amount == "nl") {
    $interest = true;
} else {
    $interest = false;
}

$response = $client->lists->addListMember($i18n["mc_l-news_ID"], [
    "email_address" => $email,
    'merge_fields' => [
        "FNAME" => $fname,
        "LNAME" => $lname
    ],
    'interests'     => array( 
        'b0b91e884d' => $interest
    ),
    'tags' => ["mitglied"],
    "status" => "subscribed",
]);

if (isset($email2) && $email2 != "") {
    $response = $client->lists->addListMember($i18n["mc_l-news_ID"], [
        "email_address" => $email2,
        'merge_fields' => [
            "FNAME" => $fname2,
            "LNAME" => $lname2
        ],
        'interests'     => array( 
            'b0b91e884d' => $interest
        ),
        'tags' => ["mitglied"],
        "status" => "subscribed",
    ]);
}

if ($response->email_address == $email) {
    $return = array(
        "status" => 200,
        "text" => $i18n["member-thx"],
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