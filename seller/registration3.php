<?php
require_once '../connection.php';
$obj = new model();

if (!isset($_SESSION['path'])) 
{
    header('location:index.php');
}

if (isset($_POST['btn'])) 
{
    
    $_SESSION['bank_benificiary_name'] = $_POST['bank_benificiary_name'];
    $_SESSION['bank_name'] = $_POST['bank_name'];
    $_SESSION['branch_name'] = $_POST['branch_name'];
    $_SESSION['ifsc_code'] = $_POST['ifsc_code'];
    $_SESSION['a/c_no'] = $_POST['a/c_no'];
    
    header('location:registration4.php');
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
                                <h1 style="color: white"><b>Welcome, <?php echo $_SESSION['company_name']; ?></b></h1>
                            </div>
                            <div style="padding: 20px;padding-bottom: 0px;">
                                <div class="form-group" >
                                    <input type="text" class="form-control"  data-bvalidator="required,alpha" name="bank_benificiary_name" placeholder="Bank Benificery Name" style="font-size: 13px;padding:05px;" />
                                </div>
                                <div class="form-group" >
                                    <select class="form-control"  data-bvalidator="required" name="bank_name" style="font-size: 13px;padding: 05px;" >
                                        <option value="">Select Bank</option>
                                        <option>ICICI Bank</option>
                                        <option>State bank of India</option>
                                        <option>Bank of Baroda</option>
                                        <option>IDBI Bank</option>
                                        <option>Axis Bank</option>
                                        <option>Union Bank of India</option>
                                    </select>
                                </div>
                                <div class="form-group input-group">
                                    <div class="row">
                                        <span class="col-sm-6 col-md-6 col-lg-6">    
                                            <input type="text" class="form-control"  data-bvalidator="required,alpha" name="branch_name" placeholder="Branch Name" style="width: 110%; font-size: 13px;padding: 05px; " />
                                        </span>
                                        <span class="col-sm-6 col-md-6 col-lg-6">
                                            <input type="text" class="form-control"   data-bvalidator="required,alphanum" name="ifsc_code" placeholder="IFSC Code" style=" width: 100%; font-size: 13px;padding: 05px;" />
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group" >
                                    <input type="text" class="form-control"  data-bvalidator="required,digit" name="a/c_no" placeholder="Account Number" style="font-size: 13px;padding: 05px;" />
                                </div>
                                <div style="padding: 20px;padding-top: 0px;">
                                    <div class="form-group">
                                        <input type="submit" name="btn" value="Next >" class="btn btn-primary btn-block"/>
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