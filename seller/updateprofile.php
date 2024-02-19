<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$dt = $obj->my_select("tbl_seller",NULL,array("seller_id"=>$_SESSION['seller']))->fetch_object();

if(isset($_POST['updt']))
{
    if($_FILES['photo']['name']!="")
    {
        unlink($dt->path);
        
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) 
        {
            $exet = substr($_FILES['photo']['type'], 6);
            if ($exet == "jpeg") 
                {
                    $filename = $dt->path;
                    $full_path = dirname(__FILE__) ."/". $filename;

                    $size = $_FILES['photo']['size'] / 1024 / 1024;

                //move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                    $obj->compress($_FILES['photo']['tmp_name'], $full_path, $size);
            
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
    
    $data['company_name'] = $_POST['company_name'];
    $data['contact_no'] = $_POST['contact_no'];
    $data['pincode'] = $_POST['pincode'];
    $data['pan'] = $_POST['pan'];
    $data['tin_no'] = $_POST['tin_no'];
    $data['address'] = $_POST['address'];
    $data['location_id'] = $_POST['location_id'];
    $data['bank_benificiary_name'] = $_POST['bank_benificiary_name'];
    $data['ifsc_code'] = $_POST['ifsc_code'];
    $data['bank_name'] = $_POST['bank_name'];
    $data['branch_name'] = $_POST['branch_name'];
    $data['ac_no'] = $_POST['ac_no'];
    
    $dd =$obj->my_update("tbl_seller", $data, array("seller_id"=>$_SESSION['seller']));
    header('location:myprofile.php');
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seller Panel</title>
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
                                    <img src="<?php echo $dt->path; ?>" width="150px" style="height: 150px;" title="<?php echo $dt->company_name; ?>" />  
                                </span>
                                <span class="col-md-10" style="padding-left:40px ">
                                    <h3 style="margin: 0px"><?php echo $dt->company_name; ?></h3>
                                    <br/>
                                    <input type="file" name="photo" class="form-control" style="width: 40%;" />
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
                                                <input type="text" name="company_name" value="<?php echo $dt->company_name; ?>" style="font-size: 13px;" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                PAN No.
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="pan" value="<?php echo $dt->pan; ?>" style="font-size: 13px;" class="form-control">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                TIN/VAT No.
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="tin_no" value="<?php echo $dt->tin_no; ?>" style="font-size: 13px;"  class="form-control">
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
                    <div class="row" style="margin-top: 20px">
                        <div class="col-md-5 col-md-offset-1" >
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading" style="border-radius: 3px 3px 0 0">Bank Information</div>
                                <div class="panel-body" style="padding: 10px; min-height: 250px">
                                   <table class="seller-info">
                                        <tr>
                                            <td>
                                                Benificiary Name
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td style="width: 55%">
                                                <input type="text" name="bank_benificiary_name" value="<?php echo $dt->bank_benificiary_name; ?>" class="form-control" style="font-size: 13px;" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Bank Name
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <select class="form-control"  data-bvalidator="required" name="bank_name" style="font-size: 13px;" >
                                                    
                                                    <option <?php if($dt->bank_name=="ICICI Bank"){echo "selected";} ?>>ICICI Bank</option>
                                                    <option <?php if($dt->bank_name=="State bank of India"){echo "selected";} ?>>State bank of India</option>
                                                    <option <?php if($dt->bank_name=="Bankof Baroda"){echo "selected";} ?>>Bank of Baroda</option>
                                                    <option <?php if($dt->bank_name=="IDBI Bank"){echo "selected";} ?>>IDBI Bank</option>
                                                    <option <?php if($dt->bank_name=="Axis Bank"){echo "selected";} ?>>Axis Bank</option>
                                                    <option <?php if($dt->bank_name=="Union Bank of India"){echo "selected";} ?>>Union Bank of India</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Branch Name
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="branch_name" value="<?php echo $dt->branch_name; ?>" class="form-control" style="font-size: 13px;" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                IFSC Code
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="ifsc_code" value="<?php echo $dt->ifsc_code; ?>" class="form-control" style="font-size: 13px;" >
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                A/C No.
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="ac_no" value="<?php echo $dt->ac_no; ?>" class="form-control" style="font-size: 13px;" >
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading"style="border-radius: 3px 3px 0 0">Location Information</div>
                                <div class="panel-body" style="padding: 10px; min-height: 250px">
                                    <?php
                                        $ct = $obj->my_select("tbl_location",NULL,array("location_id"=>$dt->location_id))->fetch_object();
                                        
                                        $st = $obj->my_select("tbl_location",NULL,array("location_id"=>$ct->parent_id))->fetch_object();
                                        
                                    ?>
                                    <table class="seller-info">
                                        <tr>
                                            <td>
                                                Country
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <select type="text" name="country" class="form-control" style="font-size: 13px;" onchange="set_seller_combo('state',this.value);">
                                                    <?php
                                                        $dd = $obj->my_select("tbl_location",NULL,array("lable"=>"country"));
                                                        while($ddd = $dd->fetch_object())
                                                        {
                                                    ?>
                                                    <option value="<?php echo $ddd->location_id; ?>" <?php if($ddd->location_id == $st->parent_id){ echo "selected"; } ?>><?php echo $ddd->name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                State
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <select type="text" name="state" class="form-control" style="font-size: 13px;" id="state" onchange="set_seller_combo('city',this.value);">
                                                    <?php
                                                        $dd = $obj->my_select("tbl_location",NULL,array("parent_id"=>$st->parent_id));
                                                        while($ddd = $dd->fetch_object())
                                                        {
                                                    ?>
                                                    <option value="<?php echo $ddd->location_id; ?>" <?php if($ddd->location_id == $st->location_id){ echo "selected"; } ?>><?php echo $ddd->name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                City
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <select type="text" name="location_id" class="form-control" style="font-size: 13px;" id="city" >
                                                    <?php
                                                        $dd = $obj->my_select("tbl_location",NULL,array("parent_id"=>$st->location_id));
                                                        while($ddd = $dd->fetch_object())
                                                        {
                                                    ?>
                                                    <option value="<?php echo $ddd->location_id; ?>" <?php if($ddd->location_id == $dt->location_id){ echo "selected"; } ?>><?php echo $ddd->name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Pickup Address
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td style="width: 55%">
                                                <textarea name="address" class="form-control"style="font-size: 13px; resize: none" ><?php echo $dt->address; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Pincode
                                            </td>
                                            <td>
                                                :
                                            </td>
                                            <td>
                                                <input type="text" name="pincode" value="<?php echo $dt->pincode; ?>" class="form-control" style="font-size: 13px;" >
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
    </body>
</html>