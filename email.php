<?php
if (!defined('IN_WALLET')) define('IN_WALLET', true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

include_once('common.php');
$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);

$query = $mysqli->query("SELECT * FROM configuration WHERE id = 1;");
$config = $query->fetch_assoc();

function createConf($username, $newemail) {
    global $mysqli;
    $code = sha1('@s%a$l£t#'.rand(0, 32000));
    $date = date("c");
    $q = "INSERT INTO confirmations (user, email, code, date) VALUES ('$username', '$newemail', '$code', '$date');";
    $q = $mysqli->query($q);
    if ($mysqli) return $code;
    return null;
}

function sendEmail($tos, $subject, $body) {
    global $config;
    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 3;                                 // Enable verbose debug output
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = $config['email_host'];  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = $config['email_user'];                 // SMTP username
        $mail->Password = $config['email_pass'];                           // SMTP password
        $mail->SMTPSecure = $config['email_tls'] ? 'tls' : null;                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = $config['email_port'];                                    // TCP port to connect to

        //Recipients
        $mail->setFrom($config['email_from']);
        foreach ($tos as $to)
        $mail->addAddress($to);     // Add a recipient

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        //Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}
?>