<?php
require_once '../connection.php';
$obj = new model();

if(!isset($_SESSION['company_name']))
{
    header('location:index.php');
}

if (isset($_POST['btn'])) 
{
    if ($_FILES['photo']['error'] == 0) 
    {
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) 
        {
                $exet = substr($_FILES['photo']['type'], 6);
                if ($exet == "jpeg") 
                {
                    $aa = $obj->my_query("SELECT max(seller_id) as mx FROM tbl_seller")->fetch_object();
                    if($aa->mx == "")
                    {
                        $filename = "profile/profile_0.".$exet;
                    }
                    else
                    {
                        $filename = "profile/profile_".$aa->mx.".".$exet;
                    }
                    
                    
                    $full_path = dirname(__FILE__) ."/". $filename;

                    move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                    $_SESSION['path'] = $filename;

                    header('location:registration3.php');
                } 
                else 
                {
                    $err = 'Only .jpeg profile Allow.';
                }
        } 
        else 
        {
            $err = 'Maximum 4 MB Size Allow';
        }
    } 
    else 
    {
        $err = "Something Wrong. Try Again.";
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

                <div class="col-md-4 col-md-offset-1">
                    <div class="admin-login" style="background: rgba(0,0,0,0.1)">
                        <div class="admin-login-heading">
                            <h1 style="color: white"><b>Welcome, <?php echo $_SESSION['company_name']; ?></b></h1>
                        </div>
                        <div style="text-align: center;">
                            <form action="" id="myform" method="post" enctype="multipart/form-data">
                                <h1>
                                    <img src="../user/profile/a.jpg" title="Select Photo" id="dp" style="width: 150px;height: 150px;border-radius: 150px;" />
                                </h1>
                                <br/>
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                    <input type="file" name="photo" onchange="ch_dp(this,'dp');" class="form-control" id="file" style="display: none;" data-bvalidator="required"/>
                                    <label for="file" style="cursor: pointer; color: white">
                                        <i class="fa fa-upload" style="font-size: 15px; "></i> Select File
                                    </label>
                                </div>
                                <br/><br/>
                                <div class="row">
                                    <div class="col-md-6" >   
                                        <div style="padding: 20px;padding-top: 0px;">
                                            <div class="form-group">
                                                <a href="index.php" class="btn btn-primary btn-block" >< Previous</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div style="padding: 20px;padding-top: 0px;">
                                            <div class="form-group">
                                                <input type="submit" name="btn" value="Next >" class="btn btn-primary btn-block"/>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
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
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
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
        <script type="text/javascript">
        function ch_dp(a,target) {
            if (a.files && a.files[0]) {
                //alert(a.files[0]);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#'+target).attr('src', e.target.result);
                }
                reader.readAsDataURL(a.files[0]);
            }
        }
        </script>
    </body>
</html>