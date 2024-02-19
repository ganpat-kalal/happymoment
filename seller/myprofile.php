<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$dt = $obj->my_select("tbl_seller",NULL,array("seller_id"=>$_SESSION['seller']))->fetch_object();

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
                                    <img src="<?php echo $dt->path; ?>" width="150px" style="height: 150px;" title="<?php echo $dt->company_name; ?>" />  
                                </span>
                                <span class="col-md-10" style="padding-left:40px ">
                                    <h3 style="margin: 0px"><?php echo $dt->company_name; ?></h3>
                                </span>
                            </div>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                    <div class="row" style="margin-top: 40px">
                        <div class="col-md-5 col-md-offset-1" >
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading" style="border-radius: 3px 3px 0 0">Personal Information <a href="updateprofile.php"><i style="color: white" title="Edit Profile" class="fa fa-pencil navbar-right"></i></a></div>
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
                                                <?php echo $dt->company_name; ?>
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
                                                <?php echo $dt->pan; ?>
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
                                                <?php echo $dt->tin_no; ?>
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
                                                <?php echo $dt->contact_no; ?>
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
                                <div class="panel-heading" style="border-radius: 3px 3px 0 0">Bank Information<a href="updateprofile.php"><i style="color: white" title="Edit Profile" class="fa fa-pencil navbar-right"></i></a></div>
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
                                                <?php echo $dt->bank_benificiary_name; ?>
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
                                                <?php echo $dt->bank_name; ?>
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
                                                <?php echo $dt->branch_name; ?>
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
                                                <?php echo $dt->ifsc_code; ?>
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
                                                <?php echo $dt->ac_no; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="panel panel-primary" style="border: 1px solid #ddd;">
                                <div class="panel-heading"style="border-radius: 3px 3px 0 0">Location Information<a href="updateprofile.php"><i style="color: white" title="Edit Profile" class="fa fa-pencil navbar-right"></i></a></div>
                                <div class="panel-body" style="padding: 10px; min-height: 250px">
                                    
                                    <?php 
                                    
                                    $query="SELECT city.name as city ,state.name as state, country.name as country FROM `tbl_location` as city ,`tbl_location` as state,`tbl_location` as country WHERE city.location_id=$dt->location_id AND city.parent_id = state.location_id AND state.parent_id=country.location_id"; 
                                    $t = $obj->my_query($query)->fetch_object();
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
                                                <?php echo $t->country; ?>
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
                                                <?php echo $t->state; ?>
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
                                                <?php echo $t->city; ?>
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
                                                <?php echo $dt->address; ?>
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
                                                <?php echo $dt->pincode; ?>
                                            </td>
                                        </tr>
                                    </table>
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