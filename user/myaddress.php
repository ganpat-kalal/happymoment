<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_POST['add'])) 
{

    $data['registration_id'] = $_SESSION['user'];
    $data['city'] = $_POST['city'];
    $data['address'] = $_POST['address'];
    
    $ans = $obj->my_insert("tbl_shipment", $data);
}

if (isset($_GET['del'])) {
    $where['shipment_id'] = $_GET['del'];
    $obj->my_delete("tbl_shipment", $where);
    header('location:myaddress.php');
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
                <section class="content-header">
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li class="active">
                            My Address
                        </li>
                    </ol>
                </section>
                <section class="content sec-mar">
                    <section class="main-page container" style="width: 1070px">
                        <div class="main-container col1-layout">
                            <div class="main">
                                <div class="col-main">

                                    <!-- / Order History-->
                                    <section class="wishlist-box oder-history">
                                        <div class="page-title margign-30"><span>My Address</span></div>
                                        <br/>
                                        <form class="comment-form respond-form" action="" method="post" id="myform">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 comment-form-name">
                                                    <?php
                                                    $wh['lable'] = "country";

                                                    $data = $obj->my_select("tbl_location", NULL, $wh);
                                                    ?>
                                                    <select class="form-control" tabindex="1" data-bvalidator="required" onchange="set_seller_combo('state', this.value);" style="font-size: 13px">
                                                        <option value="">Select Country</option>
                                                        <?php
                                                        while ($row = $data->fetch_object()) {
                                                            ?>
                                                            <option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <br/>
                                                    <select class="form-control" tabindex="2" data-bvalidator="required" onchange="set_seller_combo('city', this.value);" name="state" id="state" style="font-size: 13px">
                                                        <option value="">Select State</option>

                                                    </select>
                                                    <br/>
                                                    <select class="form-control" tabindex="3" data-bvalidator="required" name="city" id="city" style="font-size: 13px">
                                                        <option value="">Select City</option>

                                                    </select>
                                                    <br/>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 comment-form-name">
                                                    <textarea style="resize: none" rows="6" tabindex="4" name="address" data-bvalidator="required" placeholder="Enter Address" class="form-control border-radius"></textarea>
                                                </div>    
                                            </div>
                                            <div class="form-submit">
                                                <span class="button-set padding-30"><br/>
                                                    <button  type="submit" name="add" class="btn btn-button global-bg white">Add</button>
                                                </span>
                                                <span class="button-set padding-30">
                                                    <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                                </span>
                                                <?php
                                                if (isset($ans)) {
                                                    if ($ans == 1) {
                                                        ?>
                                                        <span style="color: green;font-size: 12px;">&nbsp;&nbsp;&nbsp;Insert Successfully.</span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;Something is Wrong. Try Again.</span>
                                                        <?php
                                                    }
                                                }
                                                if (isset($er)) {
                                                    ?>    
                                                    <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $er; ?></span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </form>
                                </div>
                                <div>
                                <table class="table table-responsive nova-pagging" style="text-transform: capitalize;">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                City
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Address
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Remove
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $c = 0;
                                        $id = $_SESSION['user'];
                                        $query = "SELECT ship.shipment_id, ship.address as address ,city.name as city FROM tbl_shipment as ship, tbl_location as city WHERE city.location_id = ship.city AND registration_id = $id";
                                        $data = $obj->my_query($query);

                                        while ($row = $data->fetch_object()) {
                                            $c++;
                                            ?>
                                            <tr style="text-align: center;">
                                                <td>
                                                    <?php echo $c; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->city; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->address; ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="myaddress.php?del=<?php echo $row->shipment_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" name="del" title="Remove"></i></a>
                                                </td>
                                            </tr>
                                            <?PHP
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                                </section>
                                <!-- / Order History -->
                            </div>
                        </div>
                        </div>
                    </section>
                </section>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
    </body>
</html>