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
if (!isset($_POST["support-type"])) {
    $return = array(
        "status" => 500,
        "text" => "Please select at least one way you want to support us.",
        "type" => "error"
    );
    header('Content-type: application/json');
    echo(json_encode($return));
    exit;
} else {
    $support_type = implode(", ", $_POST["support-type"]);
    if (isset($_POST["other-text"])) {
        $type_other = $_POST["other-text"];
    } else {
        $type_other = "";
    }
}


if (isset($_POST["places"])) {
    $places = implode(", ", $_POST["places"]);
} else {
    $places = "";
}

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$email = $_POST["email"];
if (isset($_POST["phone"]) && $_POST["phone"] != "" ) {
    $phone = $_POST["phone"];
} else {
    $phone = "";
}

$query = 
    $wpdb->query( 
        $wpdb->prepare( 
            "INSERT INTO `pn27_activists` 
                (`activist_UUID`, `activist_support_type`, `activist_support_type_other`, `activist_places`, `activist_fname`, `activist_lname`, `activist_email`, `activist_phone`) 
            VALUES 
                (%s, %s, %s, %s, %s, %s, %s, %s)
            ON DUPLICATE KEY UPDATE activist_UUID = activist_UUID;",
            $uuid,
            $support_type,
            $type_other,
            $places,
            $fname,
            $lname,
            $email,
            $phone
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


$message = "Hallo!<br><br>";
$message .= "Es hat sich ein:e neue:r Aktivist:in auf der LOS-Webseite eingetragen! Hier die Details:<br><br>";
$message .= "<strong>Vorname:</strong> {$fname}<br>";
$message .= "<strong>Nachname:</strong> {$lname}<br>";
$message .= "<strong>E-Mail:</strong> {$email}<br>";
if ($phone != "") {
    $message .= "<strong>Telefonnummer:</strong> {$phone}<br>";
}
$message .= "<br>";
$message .= "Die:Der Aktivist:in möchte euch in folgenden Bereichen unterstützen: {$support_type}<br>";
if ($type_other != "") {
    $message .= "Sonstiges heisst: {$type_other}<br>";
}
$message .= "<br>";
if ($places != "") {
    $message .= "Ausserdem könnte sie:er in folgenden Städten vor Ort sein: {$places}<br><br>";
}

$message .= "Das war's auch schon!<br>";
$message .= "Tschäse!<br><br>";
$message .= "<em>Timothy <3</em><br>";
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
    $mail->addAddress($i18n["activist-to-email"]);

    //Content
    $mail->isHTML(true);
    $mail->Subject = "Neue:r Aktivist:in: {$fname} {$lname}";
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
        "text" => $i18n["activist-thx"],
        "type" => "success"
    );
}

header('Content-type: application/json');
echo(json_encode($return))
?>