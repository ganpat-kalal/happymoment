<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if (isset($_POST['up_ps'])) {
    $dtt = $obj->my_select("tbl_admin_login", NULL, array("admin_login_id" => $_SESSION['admin']))->fetch_object();

    $decp = $obj->decrypt($dtt->password);

    if ($decp == $_POST['current']) {
        $p['password'] = $obj->encrypt($_POST['new']);

        $ch = $obj->my_update("tbl_admin_login", $p, array("admin_login_id" => $_SESSION['admin']));
        if ($ch == 1) {
            $ch = "Password changed.";
        } else {
            $wr = "Something wrong.Try again.";
        }
    } else {
        $wr = "Invalid Password";
    }
}

if (isset($_POST['upload'])) {
    if ($_FILES['photo']['error'] == 0) {
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) {
            $exet = substr($_FILES['photo']['type'], 6);
            if ($exet == "jpeg") {
                $filename = "profile/profile_0." . $exet;
                $full_path = dirname(__FILE__) . "/" . $filename;

                $size = $_FILES['photo']['size'] / 1024 / 1024;

                //move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                $obj->compress($_FILES['photo']['tmp_name'], $full_path, $size);


                $data['path'] = $filename;

                $obj->my_update("tbl_admin_login", $data, array("admin_login_id" => $_SESSION['admin']));
            } else {
                $err = 'Only .jpeg profile Allow.';
            }
        } else {
            $err = 'Maximum 4 MB Size Allow';
        }
    } else {
        $err = "Something Wrong. Try Again.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
    </head>
    <body class="skin-coreplus">
        <?php
        require_once 'headline.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php
            require_once 'sidebar.php';
            ?>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Setting
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            Setting
                        </li>
                    </ol>
                </section>
                <div class="row" style="padding: 10px 20px;">
                    <div class="col-md-offset-1 col-md-10" style="border: 1px solid #ccc;border-radius: 3px;">
                        <div class="row" style="padding: 10px;">
                            <div class="col-md-6 col-sm-6 col-lg-6">
                                <div style="text-align: center;">
                                    <form action="" id="myform" method="post" enctype="multipart/form-data">
                                        <h1>
                                            <?php
                                            $dt = $obj->my_select("tbl_admin_login", NULL, array("admin_login_id" => $_SESSION['admin']))->fetch_object();
                                            ?>
                                            <img src="<?php echo $dt->path; ?>" id="dp" style="width: 150px;height: 150px;border-radius: 150px;" />
                                        </h1>
                                        <br/>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <center><input type="file" onchange="ch_dp(this, 'dp');" name="photo" class="form-control" data-bvalidator="required" style="width: 230px;"/></center>
                                        </div>
                                        <br/><br/><br/>
                                        <button  type="submit" name="upload" class="btn btn-button global-bg white">Change Profile</button>
                                        <br/>
                                        <br/>
                                        <?php
                                        if (isset($err)) {
                                            ?>
                                            <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $err; ?></span>
                                            <?php
                                        }
                                        ?>
                                        <br/>

                                    </form>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <br/>
                                <div style="border:1px solid #ccc; border-radius: 3px; padding: 10px;width: 70%">
                                    <form action="" id="myform1" method="post" >
                                        <h4 style="padding-left: 30px;">Change Password</h4>
                                        <br/>
                                        <input type="password" name="current" tabindex="1" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="Current Password" data-bvalidator="required"/>
                                        <br/>
                                        <input type="password" name="new" id="pss" tabindex="2" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="New Password" data-bvalidator="required,minlength[8]"/>
                                        <br/>
                                        <input type="password" tabindex="2" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="Confirm Password" data-bvalidator="required,equalto[pss]"/>
                                        <br/>
                                        <center>
                                            <button type="submit" name="up_ps" class="btn btn-button global-bg white">Update</button>&nbsp;&nbsp;<button type="reset" class="btn btn-button global-bg white" >Clear</button>
                                        </center>
                                        <br/>
                                        <?php
                                        if (isset($wr)) {
                                            ?>
                                            <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $wr; ?></span>
                                            <?php
                                        }
                                        ?>
                                        <?php
                                        if (isset($ch)) {
                                            ?>
                                            <span style="color: green;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $ch; ?></span>
                                            <?php
                                        }
                                        ?>
                                        <br/>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
            $("#myform1").bValidator();
        </script>
        <script type="text/javascript">
            function ch_dp(a, target) {
                if (a.files && a.files[0]) {
                    //alert(a.files[0]);
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#' + target).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(a.files[0]);
                }
            }
        </script>
    </body>
</html>
