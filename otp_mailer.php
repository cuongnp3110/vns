<?php
// include_once("connection.php");

// include "mail/src/PHPMailer.php";
// include "mail/src/Exception.php";
// include "mail/src/OAuth.php";
// include "mail/src/POP3.php";
// include "mail/src/SMTP.php";
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// $mail = new PHPMailer(true);
// function generateNumericOTP($n) {
//     $generator = "1357902468";
//     $result = "";
//     for ($i = 1; $i <= $n; $i++) {
//         $result .= substr($generator, (rand()%(strlen($generator))), 1);
//     }
//     return $result;
//   }
// $randomOTP = generateNumericOTP(6);

// if(isset($_GET['mailer']))
// {
//   //echo "<script>alert('$randomOTP')</script>";
//   try {
//     $mail->SMTPDebug = 0;
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'vns.direct.service@gmail.com';
//     $mail->Password = 'bgbronbblpnujmsr';
//     $mail->SMTPSecure = 'tls';
//     $mail->Port = 587;

//     //Recipients
//     $mail->setFrom("vns.direct.service@gmail.com", "VNS Mailer");
//     $mail->addAddress($_GET['mailer'], 'User');

//     //Content
//     $mail->isHTML(true);
//     $mail->Subject = 'OTP Sending';
//     $mail->Body    = 'Your OTP is: <b>'.$randomOTP.'</b>';

//     $mail->send();
//     echo json_encode($randomOTP);
//   } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }

// }

// if(isset($_GET['recover']))
// {
//   //echo "<script>alert('$randomOTP')</script>";
//   try {
//     $mail->SMTPDebug = 0;
//     $mail->isSMTP();
//     $mail->Host = 'smtp.gmail.com';
//     $mail->SMTPAuth = true;
//     $mail->Username = 'vns.direct.service@gmail.com';
//     $mail->Password = 'bgbronbblpnujmsr';
//     $mail->SMTPSecure = 'tls';
//     $mail->Port = 587;

//     //Recipients
//     $mail->setFrom("vns.direct.service@gmail.com", "VNS Mailer");
//     $mail->addAddress($_GET['recover'], 'User');

//     //Content
//     $mail->isHTML(true);
//     $mail->Subject = 'OTP Sending';
//     $mail->Body    = 'Your recover OTP is: <b>'.$randomOTP.'</b>';

//     $mail->send();
//     echo json_encode($randomOTP);
//   } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//   }

// }


include "mail/src/PHPMailer.php";
include "mail/src/Exception.php";
include "mail/src/OAuth.php";
include "mail/src/POP3.php";
include "mail/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
function generateNumericOTP($n) {
    $generator = "1357902468";
    $result = "";
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    return $result;
  }
$randomOTP = generateNumericOTP(6);

if(isset($_GET['recover']))
{
  try {
    $smtp_debug = true;
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vns.direct.service@gmail.com';
    $mail->Password = 'fpekgdrmhqlpaztx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom("vns.direct.service@gmail.com", "VNS Mailer");
    $mail->addAddress($_GET['recover'], 'User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP Sending';
    $mail->Body    = 'Your recover OTP is: <b>'.$randomOTP.'</b>';

    $mail->send();
    echo json_encode($randomOTP);
  } catch (Exception $e) {
    "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}

if(isset($_GET['mailer']))
{
  //echo "<script>alert('$randomOTP')</script>";
  try {
    $mail->SMTPDebug = 0;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'vns.direct.service@gmail.com';
    $mail->Password = 'fpekgdrmhqlpaztx';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    //Recipients
    $mail->setFrom("vns.direct.service@gmail.com", "VNS Mailer");
    $mail->addAddress($_GET['mailer'], 'User');

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'OTP Sending';
    $mail->Body    = 'Your OTP is: <b>'.$randomOTP.'</b>';

    $mail->send();
    echo json_encode($randomOTP);
  } catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }

}




?>