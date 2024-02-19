<?php
require_once '../connection.php';
$obj = new model();

if(isset($_POST['btn']))
{
    $count = $obj->count_record("tbl_seller", array("email"=>$_POST['email']));
    
    if($count == 1)
    {
        $data = $obj->my_select("tbl_seller",NULL,array("email"=>$_POST['email']))->fetch_object()->password;
        $msg = $obj->decrypt($data);
        $email = $_POST['email'];
        require_once '../PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'happymoment0000@gmail.com';          // SMTP username
            $mail->Password = '000000000000'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->setFrom('happymoment0000@gmail.com', 'Happy Moment');
            $mail->addReplyTo('happymoment0000@gmail.com', 'Happy Moment');
            $mail->addAddress($email);   // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML

            $bodyContent = '<div style=" padding:15px; "><p style="padding:10px 0px;">Dear Seller,</p><p style = "padding:2px 0px;"> Your forgotten password is as follow. Please Next time be carefull.</p><div style = "display:inline-flex;"><p style = "padding:2px 0px;">Your Password : ';
            $bodyContent.=$msg;
            $bodyContent .= '</p></div></div>';
            
            $subject = "Password Recovery";
            $mail->Subject = $subject;
            $mail->Body = $bodyContent;

            if (!$mail->send()) 
            {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
        
        $rr = "Your password succcessfully sent!";
        
    }
    else
    {
        $err = "E-mail address is Invalid or not registered with us."; 
    }
    
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sell Product on Happy Moment</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body style="background-image: url('../image/login.jpg') !important;background-size: 100% 100%;min-height: 662px" cz-shortcut-listen="true">
        <div class="container-fluid">
            <div class="row">
                <form action="" id="myform" method="post" class="">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="admin-login" style="background: rgba(0,0,0,0.2)">
                            <div class="admin-login-heading">
                                <h1 style="color: #fff"><b>Forget Password ?</b></h1>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">
                                <div class="form-group" >
                                    <label for="email" class="sr-only"> E-mail</label>
                                    <div>
                                        <input type="text" class="form-control"  data-bvalidator="required,email" name="email" placeholder="E-mail" style="font-size: 13px;padding: 20px;" />
                                    </div>
                                </div>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">
                                <div class="form-group" style="width: 100px;float: left">
                                    <a href="login.php" class="btn btn-primary btn-block">Back</a>
                                </div>
                                <div class="form-group" style="width: 100px; margin-left: 280px">
                                    <button type="submit" name="btn" class="btn btn-primary btn-block" >Send Mail</button>
                                </div>
                                <div style="clear: both"></div>
                                <div>
                                    <?php
                                        if(isset($rr))
                                        {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $rr; ?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if(isset($err))
                                        {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Oops !<br/></strong> <?php echo $err; ?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
        require_once './scriptlink.php';
        ?>
        <script type="text/javascript">


            $(document).ready(function () {
                c = 0;
                $("#ps-btn").click(function () {

                    if(c==0)
                    {
                        $("#ps").attr('type', 'text');
                        $("#ps-btn").attr('class','fa fa-unlock');
                        c=1;
                    }
                    else
                    {
                        $("#ps").attr('type', 'password');
                        $("#ps-btn").attr('class','fa fa-lock');
                        c=0;
                    }
                });


            });


        </script>
    </body>
</html>