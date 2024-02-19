<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if (isset($_POST['up_city'])) {
    $wh['name'] = $_POST['add_city'];
    $wh['lable'] = "city";
    //unique
    $count = $obj->count_record("tbl_location", $wh);

    if ($count == 0) {
        //insert
        $data['name'] = $_POST['add_city'];
        $data['parent_id'] = $_POST['state'];

        $ans = $obj->my_update("tbl_location", $data, array("location_id" => $_GET['up']));
        header('location:managecity.php');
    } else {   //eroor
        $er = $_POST['add_city'] . " Already Exist.";
    }
}

if (isset($_POST['city'])) {

    $data['name'] = $_POST['add_city'];
    $data['lable'] = "city";
    $data['parent_id'] = $_POST['state'];

    $c = $obj->count_record("tbl_location", $data);
    if ($c == 0) {
        $ans = $obj->my_insert("tbl_location", $data);
    } else {
        $er = $_POST['add_city'] . " " . " Already Exist!";
    }
}
if (isset($_GET['del'])) {
    $where['location_id'] = $_GET['del'];
    $obj->my_delete("tbl_location", $where);
    header('location:managecity.php');
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
                        Manage City
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Location</a>
                        </li>
                        <li class="active">
                            City
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <?php
                                if (isset($_GET['up'])) {
                                    $d = $obj->my_select("tbl_location", NULL, array("location_id" => $_GET['up']))->fetch_object();

                                    $dd = $obj->my_select("tbl_location", NULL, array("location_id" => $d->parent_id))->fetch_object();
                                    ?>
                                    <!-- update form -->    
                                    <form class="comment-form respond-form" action="" method="post" id="myform">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                                <br/>
                                                <h4 style="font-size: 14px;">Update City..</h4>
                                                <br/>
                                                <?php
                                                $hh['lable'] = "country";

                                                $data = $obj->my_select("tbl_location", NULL, $hh);
                                                ?>
                                                <select class="form-control" data-bvalidator="required" onchange="set_combo('state', this.value);" style="font-size: 13px">
                                                    <option value="">Select Country</option>
                                                    <?php
                                                    while ($row = $data->fetch_object()) {
                                                        ?>
                                                        <option value="<?php echo $row->location_id; ?>" <?php
                                                        if ($dd->parent_id == $row->location_id) {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $row->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>

                                                </select>
                                                <br/>
                                                <select class="form-control" data-bvalidator="required" name="state" id="state" style="font-size: 13px">
                                                    <option value="">Select State</option>
                                                    <?php
                                                    $st = $obj->my_select("tbl_location", NULL, array("parent_id" => $dd->parent_id));
                                                    while ($row = $st->fetch_object()) 
                                                    {
                                                    ?>
                                                        <option value="<?php echo $row->location_id; ?>" 
                                                    <?php
                                                        if ($d->parent_id == $row->location_id) 
                                                        {
                                                            echo "selected";
                                                        }
                                                        ?>><?php echo $row->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>
                                                <br/>

                                                <input type="text" class="form-control" name="add_city" value="<?php echo $d->name; ?>" style="font-size: 13px"  placeholder="Enter City" data-bvalidator="required"/>

                                            </div>

                                        </div>
                                        <div class="form-submit">
                                            <span class="button-set padding-30"><br/>
                                                <button  type="submit" name="up_city" class="btn btn-button global-bg white">Update</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <a href="managecity.php" class="btn btn-button global-bg white">Cancel</a>
                                            </span>
                                            <?php
                                            if (isset($er)) {
                                                ?>    
                                                <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $er; ?></span>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </form>
                                    <?php
                                } else {
                                    ?>

                                    <!-- Insert form -->
                                    <form class="comment-form respond-form" action="" method="post" id="myform">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                                <br/>
                                                <h4 style="font-size: 14px;">Add City..</h4>
                                                <br/>
                                                <?php
                                                $wh['lable'] = "country";

                                                $data = $obj->my_select("tbl_location", NULL, $wh);
                                                ?>
                                                <select class="form-control" data-bvalidator="required" onchange="set_combo('state', this.value);" style="font-size: 13px">
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
                                                <select class="form-control" data-bvalidator="required" name="state" id="state" style="font-size: 13px">
                                                    <option value="">Select State</option>

                                                </select>
                                                <br/>

                                                <input type="text" class="form-control" name="add_city"  style="font-size: 13px"  placeholder="Enter City" data-bvalidator="required"/>

                                            </div>

                                        </div>
                                        <div class="form-submit">
                                            <span class="button-set padding-30"><br/>
                                                <button  type="submit" name="city" class="btn btn-button global-bg white">Add</button>
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
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <table class="table table-responsive nova-pagging" style="text-transform: capitalize;">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Country
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                State
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                City
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Remove
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Update
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $c = 0;
                                        $query = "SELECT city.location_id,city.name as city,state.name as state,cn.name as country FROM tbl_location as city,tbl_location as state,tbl_location as cn WHERE city.parent_id = state.location_id AND state.parent_id = cn.location_id";
                                        $data = $obj->my_query($query);

                                        while ($row = $data->fetch_object()) {
                                            $c++;
                                            ?>

                                            <tr style="text-align: center;">
                                                <td style="width: 10%; padding: 0px;" >
                                                    <?php echo $c; ?>
                                                </td>

                                                <td>
                                                    <?php echo $row->country; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->state; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->city; ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managecity.php?del=<?php echo $row->location_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" name="del" title="Remove"></i></a>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managecity.php?up=<?php echo $row->location_id; ?>"><i class="fa fa-pencil remove" title="Update"></i></a>
                                                </td>
                                            </tr>
                                            <?PHP
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>

            </aside>
        </div>
        <div id = "qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
        </script>
    </body>
</html>
