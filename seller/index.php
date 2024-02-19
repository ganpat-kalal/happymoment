<?php
require_once '../connection.php';
$obj = new model();


if(isset($_POST['btn'])) 
{
    $count = $obj->count_record("tbl_seller", array("email"=>$_POST['email']));
    
    if($count == 0)
    {
        $_SESSION['company_name'] = $_POST['company_name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['contact_no'] = $_POST['contact_no'];
        $_SESSION['pan'] = $_POST['pan'];
        $_SESSION['tin_no'] = $_POST['tin_no'];
    
        header('location:registration2.php');
    }
    else
    {
        $err= "Email is Already Registered";
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
    <body class="" style="background-image: url('../image/back.jpg') !important;background-size: 100% 100%;min-height: 662px;">
        <div class="container-fluid">
            <div class="row">
                <form action="" id="myform" method="post" class="">
                    <div class="col-md-4 col-md-offset-1">
                        <div class="admin-login" style="background: rgba(0,0,0,0.1)">
                            <div class="admin-login-heading">
                                <h1 style="color: white"><b>Register Now</b></h1>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">
                                <div class="form-group" >
                                    <input type="text" class="form-control"  data-bvalidator="required" name="company_name" placeholder="Company Name" style="font-size: 13px;padding:5px;" />
                                </div>
                                <div class="form-group" >
                                    <input type="text" class="form-control"  data-bvalidator="required,email" name="email" placeholder="E-mail" style="font-size: 13px;padding: 05px;" />
                                </div>
                                <div class="form-group input-group">
                                    <div class="row">
                                        <span class="col-sm-6 col-md-6 col-lg-6">    
                                            <input type="password" class="form-control" id="ps"  data-bvalidator="required,minlength[8]" name="password" placeholder="Password" style="width: 100%; font-size: 13px;padding: 05px; " />
                                        </span>
                                        <span class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="password" class="form-control"   data-bvalidator="required,equalto[ps]" name="cpassword" placeholder="Confirm Password" style=" width: 100%; font-size: 13px;padding: 05px;" />
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <input type="text" class="form-control"  data-bvalidator="required,digit" name="contact_no" placeholder="Mobile Number" style="font-size: 13px;padding: 05px;" />
                                </div>
                                <div class="form-group input-group">
                                    <div class="row">
                                        <span class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" class="form-control"  data-bvalidator="required,alphanum" name="pan" placeholder="Pan Number" style="width: 100%; font-size: 13px;padding: 05px;" />
                                        </span>
                                        <span class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" class="form-control"  data-bvalidator="required,alphanum" name="tin_no" placeholder="TIN/VAT Number" style=" width: 100%; font-size: 13px;padding: 05px;" />
                                        </span>
                                    </div>
                                </div>
                                <div style="padding: 20px 0px;padding-top: 10px;">
                                    <div class="form-group">
                                        <input type="submit" name="btn" value="Next >" class="btn btn-primary btn-block"/>
                                    </div>
                                    <div>
                                        <?php
                                            if(isset($err))
                                            {
                                        ?>
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <strong>Oops !</strong> <?php echo $err; ?>
                                        </div>
                                        <?php
                                            }
                                        ?>
                                    </div>
                                    <hr/>
                                    <div>
                                        <center><a href="login.php"><h5><b>Already have account ?</b></h5></a></center>
                                    </div> 
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
    </body>
</html>