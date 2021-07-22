<?php
require_once(__DIR__ . "/../../../../wp-load.php");
$lang_settings = get_option( 'los_lang' ); 
global $i18n;
global $wpdb;
include __DIR__ . "/../i18n/{$lang_settings['gen']}.php";
include __DIR__ . "/../config/config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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
    $fname2 = "";
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
        "type" => "error",
        "wpdberror" => $wpdb->last_error
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
}

$client = new MailchimpMarketing\ApiClient();

$client->setConfig([
    'apiKey' => $config["mc_api"][$lang_settings['gen']],
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

if ($response->email_address != $email) {
    $return = array(
        "status" => 500,
        "text" => $i18n["error-nl"],
        "type" => "error"
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
}



$message = "Hallo!<br><br>";
$message .= "Es hat sich ein neues Mitglied auf der LOS-Webseite eingetragen! Hier die Details:<br><br>";
$message .= "<em>Infos zum Mitglied</em><br>";
$message .= "<strong>Mitglied-Typ:</strong> {$type}<br>";
if ($anrede == 1) {
    $message .= "<strong>Anrede:</strong> 'Liebe'<br><br>";
}
if ($anrede == 2) {
    $message .= "<strong>Anrede:</strong> 'Lieber'<br><br>";
}
if ($anrede == 3) {
    $message .= "<strong>Anrede:</strong> 'Hallo!'<br><br>";
}
$message .= "<strong>Vorname:</strong> {$fname}<br>";
$message .= "<strong>Nachname:</strong> {$lname}<br>";
$message .= "<strong>E-Mail Adresse:</strong> {$email}<br><br>";
if ($phone != "") {
    $message .= "<strong>Telefonnummer:</strong> {$phone}<br><br>";
}
if ($year != "") {
    $message .= "<strong>Jahrgang:</strong> {$year}<br><br>";
}
$message .= "<strong>E-Mail Adresse:</strong> {$email}<br><br>";
if ($type == "couple") {
    $message .= "<em>Infos zur Partner*in</em><br>";
    $message .= "<strong>Vorname:</strong> {$fname2}<br>";
    $message .= "<strong>Nachname:</strong> {$lname2}<br>";
    $message .= "<strong>E-Mail Adresse:</strong> {$email2}<br><br>";
}
if ($type == "group") {
    $message .= "<strong>Organisation:</strong> {$orga}<br>";
}
$message .= "<strong>Adresse:</strong> {$street}<br>";
$message .= "<strong>PLZ, Ort:</strong> {$plz}, {$place}<br><br>";
$message .= "<em>Korrespondenz</em><br>";
if ($amount == "both") {
    $message .= "<strong>Häufigkeit:</strong> Newsletter und Mitgliedermails<br>";
} else if ($amount == "nl") {
    $message .= "<strong>Häufigkeit:</strong> Newsletter<br>";
} else if ($amount == "m-mails") {
    $message .= "<strong>Häufigkeit:</strong> Mitgliedermails<br>";
}
$message .= "<strong>Korrespondenzsprache:</strong> {$lang}<br><br>";

if ($notes != "") {
    $message .= "<em>Anmerkungen</em><br>";
    $message .= "«{$notes}» <br><br>";
}

$message .= "Das war's auch schon!<br>";
$message .= "Tschäse!<br><br>";
$message .= "<em>Timothy <3 </em><br>";
$message .= "Your loving code wizard";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->CharSet = 'UTF-8';
    $mail->isSMTP();
    $mail->Host       = $config["email-host"];
    $mail->SMTPAuth   = true;
    $mail->Username   = $config["email-user"];
    $mail->Password   = $config["email-pw"];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = $config["email-port"];

    //Recipients
    $mail->setFrom('webmaster@los.ch', $config["email-from"]);
    foreach ($config["email-to"] as $emailto) {
        $mail->addAddress($emailto);
    }
    $mail->addBcc("timothy@kpunkt.ch");

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Neues Mitglied: {$fname} {$lname}";
    $mail->Body    = $message;

    $mail->send();
    $mail_status = 1;
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

if ($mail_status != 1){
    $return = array(
        "status" => 502,
        "text" => $i18n["error-nl"],
        "type" => "error"
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
} else {
    $return = array(
        "status" => 200,
        "text" => $i18n["member-thx"],
        "type" => "success"
    );
}

header('Content-type: application/json');
echo(json_encode($return))


?>