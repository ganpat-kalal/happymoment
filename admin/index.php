
<?php
require_once '../connection.php';
$obj = new model();

if (isset($_POST['btn'])) {
    $count = $obj->count_record("tbl_admin_login", array("email" => $_POST['email']));

    if ($count == 1) {
        $admin = $obj->my_select("tbl_admin_login", NULL, array("email" => $_POST['email']))->fetch_object();
        $rpass = $obj->decrypt($admin->password);

        if ($_POST['password'] == $rpass) 
        {
            if(isset($_POST['saveps']))
            {
                setcookie("adminemail", $_POST['email']);
                setcookie("adminpassword", $rpass);
            }
            $_SESSION['admin'] = $admin->admin_login_id;
            $_SESSION['logintime'] = date('y-m-d h:i:s');

            header('location:dashboard.php');
        } else {
            $rr = "Invalid Login !";
        }
    } else {
        $rr = "Invalid Login !";
    }
}
if(isset($_GET['send']))
{
    $data = $obj->my_select("tbl_admin_login",NULL,array("email"=>"happymoment0000@gmail.com"))->fetch_object()->password;
        $msg = $obj->decrypt($data);
        $email = "happymoment0000@gmail.com";
        require_once '../PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'ganpatkalal459@gmail.com';          // SMTP username
            $mail->Password = 'zxcvbnmlp'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->setFrom('ganpatkalal459@gmail.com', 'Happy Moment');
            $mail->addReplyTo('ganpatkalal459@gmail.com', 'Happy Moment');
            $mail->addAddress($email);   // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML

            $bodyContent = '<div style=" padding:15px; "><p style="padding:10px 0px;">Dear Admin,</p><p style = "padding:2px 0px;"> Your forgotten password is as follow. Please Next time be carefull.</p><div style = "display:inline-flex;"><p style = "padding:2px 0px;">Your Password : ';
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
        
        $rr = "Password succcessfully sent!";
        
    }
    else
    {
        $err = "E-mail address is Invalid or not registered with us."; 
    }
if(isset($_POST['close']))
{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login | HappyMoment</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body class="" style="background-image: url('img/back2.jpg') !important;background-size: 100% 100%;min-height: 662px;">
        <div class="container-fluid">
            <div class="row">
                <form action="" id="myform" method="post" class="">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="admin-login" style="background: rgba(0,0,0,0.1)">
                            <div class="admin-login-heading">
                                <h1><b>Admin Login</b></h1>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">

                                <div class="form-group" >
                                    <label for="email" class="sr-only"> E-mail</label>
                                    <div>
                                        <input type="text" class="form-control" tabindex="1" value="<?php if(isset($_COOKIE['adminemail'])){ echo $_COOKIE['adminemail']; } ?>"  name="email" placeholder="E-mail" style="font-size: 13px;padding: 20px;" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" tabindex="2" value="<?php if(isset($_COOKIE['adminpassword'])){ echo $_COOKIE['adminpassword']; } ?>" id="ps"  name="password" placeholder="Password" style="font-size: 13px;padding: 20px;" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock" id="ps-btn"></i>
                                        </span>

                                    </div>
                                </div>
                                <br/>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin: 0px;">
                                            <label>
                                            <input type="checkbox" name="saveps" />
                                            <a href="#"><b>Remember me</b></a>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="index.php?send=1" id="forgot" tabindex="4" name="password"> Forgot Password ? </a>
                                    </div>
                                </div>
                                <br/>
                                <?php
                                        if(isset($rr))
                                        {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" name="close" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $rr; ?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                <br/>
                                <br/>
                                <div style="padding: 20px;padding-top: 0px;">
                                    <div class="row">
                                        <div class="col-md-offset-8 col-md-4">
                                            <div class="form-group">
                                                <input type="submit" tabindex="5" name="btn" value="Log In" class="btn btn-primary btn-block"/>
                                            </div>
                                            <br/>                                        
                                        </div>
                                    </div>
                                    <div>
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

                    if (c == 0)
                    {
                        $("#ps").attr('type', 'text');
                        $("#ps-btn").attr('class', 'fa fa-unlock');
                        c = 1;
                    } else
                    {
                        $("#ps").attr('type', 'password');
                        $("#ps-btn").attr('class', 'fa fa-lock');
                        c = 0;
                    }
                });


            });
        </script>
    </body>
</html>