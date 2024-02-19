<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$dt = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();

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
                    <div style="background-color: #FF4500; height: 200px; padding: 5%; margin: -21px; display: block; border: 1px solid gray">
                    </div>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10" style=" margin-top: -130px;">
                            <div class="row" style="background-color: white; border: 1px solid #ddd;  padding: 25px 15px;"><a href="updateprofile.php"><i style="color: #000;" class="fa fa-pencil navbar-right" title="Edit Profile"></i></a>
                                <span class="col-md-2">
                                    <?php
                                    if($dt->profile == "")
                                    {
                                    ?>
                                    <img src="profile/a.jpg" width="150px" style="height: 150px;" title="<?php echo $dt->user_name; ?>" />  
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                    <img src="<?php echo $dt->profile; ?>" width="150px" style="height: 150px;" title="<?php echo $dt->user_name; ?>" />  
                                    <?php
                                    }
                                    ?>
                                </span>
                                <span class="col-md-10" style="padding-left:40px ">
                                    <h3 style="margin: 0px; text-transform: capitalize" >
                                        <?php
                                                if($dt->user_name == "")
                                                {
                                                    echo 'Not Specified';
                                                }
                                                else
                                                { 
                                                    echo $dt->user_name; 
                                                }    
                                                ?>
                                    </h3>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row" style="margin-top: 40px">
                        <div class="col-md-5 col-md-offset-1" >
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading" style="border-radius: 3px 3px 0 0">Basic Information <a href="updateprofile.php"><i style="color: white" title="Edit Profile" class="fa fa-pencil navbar-right"></i></a></div>
                                <div class="panel-body" style="padding: 10px; min-height: 150px">
                                    <table class="seller-info">
                                        <tr>
                                            <td>
                                                Name
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td style="text-transform: capitalize">
                                                <?php
                                                if($dt->user_name == "")
                                                {
                                                    echo 'Not Specified';
                                                }
                                                else
                                                { 
                                                    echo $dt->user_name; 
                                                }    
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Gender
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <?php
                                                if($dt->gender == "")
                                                {
                                                    echo 'Not Specified';
                                                }
                                                else
                                                { 
                                                    echo $dt->gender; 
                                                }    
                                                ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                D.O.B.
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <?php
                                                if($dt->dob == "")
                                                {
                                                    echo 'Not Specified';
                                                }
                                                else
                                                { 
                                                    echo $dt->dob; 
                                                }    
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading"style="border-radius: 3px 3px 0 0">Contact Information<a href="updateprofile.php"><i style="color: white" title="Edit Profile" class="fa fa-pencil navbar-right"></i></a></div>
                                <div class="panel-body" style="padding: 10px; min-height: 150px">
                                    <table class="seller-info">
                                        <tr>
                                            <td>
                                                E-mail
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <?php echo $dt->email; ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Contact No.
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                               <?php
                                                if($dt->contact_no == "")
                                                {
                                                    echo 'Not Specified';
                                                }
                                                else
                                                { 
                                                    echo $dt->contact_no; 
                                                }    
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>
                </section>

            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
    </body>
</html>