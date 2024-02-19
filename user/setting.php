<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if (isset($_POST['up_ps'])) {
    $dtt = $obj->my_select("tbl_registration", NULL, array("registration_id" => $_SESSION['user']))->fetch_object();

    $decp = $obj->decrypt($dtt->password);

    if ($decp == $_POST['current']) {
        $p['password'] = $obj->encrypt($_POST['new']);

        $ch = $obj->my_update("tbl_registration", $p, array("registration_id" => $_SESSION['user']));
        if ($ch == 1) {
            $ch = "Password changed.";
        } else {
            $wr = "Something wrong.Try again.";
        }
    } else {
        $wr = "Invalid Password";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Panel</title>
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
                        <div class="row" style="padding: 10px;" >
                             <div style="text-align: center;">
                             <br/>
                            <div style="border:1px solid #ccc;  border-radius: 3px; padding: 10px;width: 70%; margin-left: 132px;">
                                <form action="" id="myform1" method="post" >
                                    <h4>Change Password</h4>
                                    <br/>
                                    <input type="password" name="current" tabindex="1" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="Current Password" data-bvalidator="required"/>
                                    <br/>
                                    <input type="password" name="new" id="pss" tabindex="2" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="New Password" data-bvalidator="required,minlength[8]"/>
                                    <br/>
                                    <input type="password" tabindex="2" class="form-control" style="font-size: 13px; width: 80%;margin-left: 10%;"  placeholder="Confirm Password" data-bvalidator="required,equalto[pss]"/>
                                    <br/>
                                    <center>
                                        <button type="submit" tabindex="3" name="up_ps" class="btn btn-button global-bg white">Update</button>&nbsp;&nbsp;<button type="reset" tabindex="4" class="btn btn-button global-bg white" >Clear</button>
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
                            <br/>
                        </div>
                    </div>
                </div>
                </div>
            </aside>    
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
            $("#myform1").bValidator();
        </script>
    </body>
</html>
