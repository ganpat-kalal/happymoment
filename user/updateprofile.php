<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$dt = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();

if(isset($_POST['updt']))
{
    if($_FILES['photo']['name']!="")
    {
        unlink($dt->profile);
        
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) 
        {
            $exet = substr($_FILES['photo']['type'], 6);
            if ($exet == "jpeg") 
                {
                    
                        $filename = "profile/".$_SESSION['user'].".".$exet;
                    
                    $full_path = dirname(__FILE__) ."/". $filename;

                    $size = $_FILES['photo']['size'] / 1024 / 1024;

                //move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                    $obj->compress($_FILES['photo']['tmp_name'], $full_path, $size);
                    
                    $dd = $obj->my_update("tbl_registration",array("profile"=>$filename),array("registration_id"=>$_SESSION['user']));
            
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
    
    $data['user_name'] = $_POST['user_name'];
    $data['gender'] = $_POST['gender'];
    $data['dob'] = $_POST['dob'];
    $data['contact_no'] = $_POST['contact_no'];
    
    $dd =$obj->my_update("tbl_registration", $data, array("registration_id"=>$_SESSION['user']));
    header('location:myprofile.php');
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
                <form method="post" id="myform" enctype="multipart/form-data">
                <section class="content-header">
                    <div style="background-color: #FF4500; height: 200px; padding: 5%; margin: -21px; display: block; border: 1px solid gray">

                    </div>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-10" style=" margin-top: -130px;">
                            <div class="row" style="background-color: white; border: 1px solid #ddd;  padding: 25px 15px;">
                                <span class="col-md-2">
                                    <?php
                                    if($dt->profile == "")
                                    {
                                    ?>
                                    <img src="profile/a.jpg" width="150px" style="height: 150px;" title="Not Specified" />  
                                    <?php
                                    }else
                                    {
                                    ?>
                                    <img src="<?php echo $dt->profile; ?>" id="dp" width="150px" style="height: 150px;" title="<?php echo $dt->user_name; ?>" />  
                                    <?php
                                    }
                                    ?>
                                </span>
                                <span class="col-md-10" style="padding-left:40px ">
                                    <h3 style="margin: 0px"><?php echo $dt->user_name; ?></h3>
                                    <br/>
                                    <input type="file" onchange="ch_dp(this,'dp');" name="photo" class="form-control" style="width: 40%;" />
                                        <br/>
                                        <span class="button-set padding-30">
                                            <button  type="submit" name="updt" class="btn btn-button global-bg white">Save Changes</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="myprofile.php" class="btn btn-button global-bg white">Cancel</a>
                                        </span>
                                        <div><?php echo $err; ?></div>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row" style="margin-top: 40px">
                        <div class="col-md-5 col-md-offset-1" >
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading" style="border-radius: 3px 3px 0 0">Personal Information</div>
                                <div class="panel-body" style="padding: 10px; min-height: 150px">
                                    <table class="seller-info">
                                        <tr>
                                            <td>
                                                Name
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="user_name" value="<?php echo $dt->user_name; ?>" style="font-size: 13px;" class="form-control">
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
                                                <select name="gender" style="font-size: 13px;" class="form-control">
                                                <option <?php if($dt->gender == ""){echo "selected";} ?>>Select Gender</option>
                                                <option <?php if($dt->gender == "Male"){echo "selected";} ?>>Male</option>
                                                <option <?php if($dt->gender == "Female"){echo "selected";} ?>>Female</option>
                                                <option <?php if($dt->gender == "Other"){echo "selected";} ?>>Other</option>
                                                </select>
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
                                                <input type="date" name="dob" value="<?php if($dt->dob != "0000-00-00"){echo $dt->dob;} ?>" style="font-size: 13px;"  class="form-control">
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading"style="border-radius: 3px 3px 0 0">Contact Information</div>
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
                                                <input type="text" name="email" readonly="" value="<?php echo $dt->email; ?>" class="form-control" style="font-size: 13px;" >
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
                                                <input type="text" name="contact_no" value="<?php echo $dt->contact_no; ?>" class="form-control" style="font-size: 13px;" >
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                </form>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
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