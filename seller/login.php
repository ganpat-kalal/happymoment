<?php
require_once '../connection.php';
$obj = new model();

if(isset($_POST['btn']))
{
    $count = $obj->count_record("tbl_seller",array("email"=>$_POST['email']));
    if($count == 1)
    {
        $admin = $obj->my_select("tbl_seller", NULL,array("email"=>$_POST['email']))->fetch_object();
        $rpass = $obj->decrypt($admin->password);
        
        if($_POST['password'] == $rpass)
        {
            if(isset($_POST['saveps']))
            {
                setcookie("selleremail", $_POST['email']);
                setcookie("sellerpassword", $rpass);
            }
             $_SESSION['seller'] = $admin->seller_id;
             $_SESSION['lastlogin'] = date('Y-m-d h:i:s');
             
             header('location:dashboard.php');
        }
        else 
        {
            $rr = "Invalid Login !";
        }
    }
    else 
    {
        $rr = "Invalid Login !";
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
                                <h1 style="color: #fff"><b>Already have account ?</b></h1>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">

                                <div class="form-group" >
                                    <label for="email" class="sr-only"> E-mail</label>
                                    <div>
                                        <input type="text" value="<?php if(isset($_COOKIE['selleremail'])){ echo $_COOKIE['selleremail']; } ?>" class="form-control"  data-bvalidator="required,email" name="email" placeholder="E-mail" style="font-size: 13px;padding: 20px;" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" value="<?php if(isset($_COOKIE['sellerpassword'])){ echo $_COOKIE['sellerpassword']; } ?>" id="ps"  data-bvalidator="required" name="password" placeholder="Password" style="font-size: 13px;padding: 20px;" />
                                        <span class="input-group-addon">
                                            <i class="fa fa-lock" id="ps-btn"></i>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div style="padding: 20px;padding-top: 0px;">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin: 0px;">
                                            <input type="checkbox" name="saveps" />
                                            <a href="#"><b>Remember me</b></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <a href="forgetpass.php" id="forgot" tabindex="4" name="fg_ps"><b> Forgot Password ? </b></a>
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group" style="width: 100px; margin-left: 280px">
                                    <input type="submit" name="btn" value="Log In" class="btn btn-primary btn-block"/>
                                </div>
                                <div class="row">
                                    <hr/>
                                    <div class="col-md-12" style="text-align: center;">
                                        <a href="index.php" class="forgot"><b style="font-size: 14px">Don't Have Account ?</b></a>
                                        <br/><br/>
                                    </div>
                                </div>
                                <div>
                                    <?php
                                        if(isset($rr))
                                        {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Oops !</strong> <?php echo $rr; ?>
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