
<!-- https://www.google.com/settings/security/lesssecureapps -->
<?php
require_once './PHPMailerAutoload.php';


if (isset($_REQUEST['btn'])) {

    require ("class.phpmailer.php");
    $mail = new PHPMailer();

    
    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'ssl://smtp.gmail.com';             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'happymoment0000@gmail.com';          // SMTP username
    $mail->Password = '000000000000'; // SMTP password
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                          // TCP port to connect to

    $mail->setFrom('happymoment0000@gmail.com', 'Happy Moment');
    $mail->addReplyTo('happymoment0000@gmail.com', 'Happy Moment');
    $mail->addAddress('ankitramani900@gmail.com');   // Add a recipient
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    $mail->isHTML(true);  // Set email format to HTML

    $bodyContent = 'This is Demo Mail';
    
    $mail->Subject = 'Demo';
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent';
    }
}

?>
<html>
    <head>

    </head>
    <body>
        <form method="post">
            
            <button name="btn" type="submit">Send mail</button>
        </form>
    </body>
</html>