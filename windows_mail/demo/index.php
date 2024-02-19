
<!-- https://www.google.com/settings/security/lesssecureapps -->
<?php
require_once './PHPMailerAutoload.php';


if (isset($_REQUEST['btn'])) {

    $mail = new PHPMailer;

    $mail->isSMTP();                            // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                     // Enable SMTP authentication
    $mail->Username = 'novamaildemo55@gmail.com';          // SMTP username
    $mail->Password = 'novamaildemo'; // SMTP password
    $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                          // TCP port to connect to

    $mail->setFrom('novamaildemo55@gmail.com', 'Nova Mail Demo');
    $mail->addReplyTo('info@codexworld.com', 'Nova Mail');
    $mail->addAddress('nishantthummar005@gmail.com');   // Add a recipient
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    $mail->isHTML(true);  // Set email format to HTML

    $bodyContent = '<h1>How to Send Email using PHP in Localhost by NOVA</h1>';
    $bodyContent .= '<p>This is the HTML email sent from localhost using PHP script by <b>NOVA One Click Solution</b></p>';

    $mail->Subject = 'Email from Localhost by NOVA';
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