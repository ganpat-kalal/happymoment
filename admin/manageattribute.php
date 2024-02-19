<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if (isset($_POST['add_att'])) {
    $data['att_name'] = $_POST['att_name'];
    $data['attribute_set_id'] = $_POST['set'];
    $data['value'] = $_POST['att_value'];
    $data['att_type'] = $_POST['att_type'];

    $c = $obj->count_record("tbl_attribute", $data);
    if ($c == 0) {
        $ans = $obj->my_insert("tbl_attribute", $data);
    } else {
        $er = $_POST['att_name'] . " " . "Already Exist!";
    }
}
if (isset($_GET['del'])) {
    $where['attribute_id'] = $_GET['del'];
    $obj->my_delete("tbl_attribute", $where);
    header('location:manageattribute.php');
}
if (isset($_POST['up'])) {
    $data['att_name'] = $_POST['att_name'];
    $data['attribute_set_id'] = $_POST['set'];
    $data['value'] = $_POST['att_value'];
    $data['att_type'] = $_POST['att_type'];

    $c = $obj->count_record("tbl_attribute", $data);

    if ($c == 0) {
        $obj->my_update("tbl_attribute", $data, array("attribute_id" => $_GET['up']));
        header('location:manageattribute.php');
    } else {
        $er = $_POST['set'] . " " . "Already Exist!";
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
                        Manage Attribute
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Products</a>
                        </li>
                        <li class="active">
                            Attribute
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">

                                <?php
                                if (isset($_GET['up'])) {
                                    $att = $obj->my_select("tbl_attribute", NULL, array("attribute_id" => $_GET['up']))->fetch_object();

                                    $dt = $obj->my_select("tbl_attribute_set", NULL, array("attribute_set_id" => $att->attribute_set_id))->fetch_object();

                                    $main = $obj->my_select("tbl_category", NULL, array("category_id" => $dt->category_id))->fetch_object();
                                    ?>    
                                    <!--    Update form  -->    
                                    <form class="comment-form respond-form" action="" method="post" id="myform">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">

                                                <select class="form-control" name="main" onchange="set_combo('sub', this.value);" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Main Category</option>
                                                    <?php
                                                    $h['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $h);

                                                    while ($row = $data->fetch_object()) {
                                                        ?>
                                                        <option value="<?php echo $row->category_id; ?>" <?php
                                                        if ($row->category_id == $main->parent_id) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $row->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>

                                                <br/>
                                                <select class="form-control" name="sub" id="sub"  onchange="set_combo('set', this.value);" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Sub Category</option>
                                                    <?php
                                                    $data = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->parent_id));

                                                    while ($row = $data->fetch_object()) {
                                                        ?>
                                                        <option value="<?php echo $row->category_id; ?>" <?php
                                                        if ($row->category_id == $dt->category_id) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $row->name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>

                                                <br/>
                                                <select class="form-control" name="set" id="set" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Attribute set</option>
                                                    <?php
                                                    $data = $obj->my_select("tbl_attribute_set");

                                                    while ($row = $data->fetch_object()) {
                                                        ?>
                                                        <option value="<?php echo $row->attribute_set_id; ?>" <?php
                                                        if ($row->attribute_set_id == $dt->attribute_set_id) {
                                                            echo "selected";
                                                        }
                                                        ?> ><?php echo $row->set_name; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                </select>

                                                <br/>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6" style="margin-top: -45px;">

                                                    </div>
                                                    <div col-sm-6 col-md-6 col-lg-6 >
                                                        <input type="text" tabindex="4" name="att_name" value="<?php echo $att->att_name; ?>" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Attribute Name" data-bvalidator="required"/>
                                                        <br/>
                                                        <select class="form-control" name="att_type" data-bvalidator="required" style="font-size: 13px; width:95%">
                                                            <option value="">Select Attribute Type</option>
                                                            <option <?php
                                                            if ($att->att_type == "Textbox") {
                                                                echo "selected";
                                                            }
                                                            ?>>Textbox</option>
                                                            <option <?php
                                                            if ($att->att_type == "Boolean") {
                                                                echo "selected";
                                                            }
                                                            ?>>Boolean</option>
                                                            <option <?php
                                                            if ($att->att_type == "Selectbox") {
                                                                echo "selected";
                                                            }
                                                            ?>>Selectbox</option>
                                                        </select>
                                                        <br/>
                                                        <input type="text" name="att_value" value="<?php echo $att->value; ?>" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Value" data-bvalidator="required"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-submit">
                                            <span class="button-set padding-30"><br/>
                                                <button  type="submit" name="up" style="width:10%" class="btn btn-button global-bg white">Update</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <button  type="reset" style= "width:10%" class="btn btn-button global-bg white">Clear</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <a href="manageattribute.php" class="btn btn-button global-bg white">Cancel</a>
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
                                            <hr/>
                                        </div>
                                    </form>
                                    <?php
                                } else {
                                    ?>
                                    <!-- Insert form  -->
                                    <form class="comment-form respond-form" action="" method="post" id="myform">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">

                                                <select class="form-control" tabindex="1" name="main" onchange="set_combo('sub', this.value);" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Main Category</option>
                                                    <?php
                                                    $h['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $h);

                                                    while ($row = $data->fetch_object()) {
                                                        ?>
                                                        <option value="<?php echo $row->category_id; ?>" ><?php echo $row->name; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>

                                                <br/>
                                                <select class="form-control" tabindex="2" name="sub" id="sub"  onchange="set_combo('set', this.value);" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Sub Category</option>

                                                </select>

                                                <br/>
                                                <select class="form-control" tabindex="3" name="set" id="set" data-bvalidator="required" style="font-size: 13px">
                                                    <option value="">Select Attribute set</option>

                                                </select>

                                                <br/>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                                <div class="row">
                                                    <div class="col-sm-6 col-md-6 col-lg-6" style="margin-top: -45px;">

                                                    </div>
                                                    <div col-sm-6 col-md-6 col-lg-6 >
                                                        <input type="text" tabindex="4" name="att_name" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Attribute Name" data-bvalidator="required"/>
                                                        <br/>
                                                        <select class="form-control" tabindex="5" onchange="set_combo('att_val', this.value);" name="att_type" data-bvalidator="required" style="font-size: 13px; width:95%">
                                                            <option value="">Select Attribute Type</option>
                                                            <option>Textbox</option>
                                                            <option>Boolean</option>
                                                            <option>Selectbox</option>
                                                        </select>
                                                        <br/>
                                                        <div id="att_val">

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-submit">
                                            <span class="button-set padding-30"><br/>
                                                <button  type="submit" tabindex="5" name="add_att" style="width:10%" class="btn btn-button global-bg white">Add</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <button  type="reset" tabindex="6" style= "width:10%" class="btn btn-button global-bg white">Clear</button>
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
                                            <hr/>
                                        </div>
                                    </form>
                                    <?php
                                }
                                ?>
                            </div>
                            <div>
                                <table class="table table-responsive nova-pagging">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Main Category 
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Sub Category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Attribute set
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Attribute Name
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Attribute Type
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Value
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
                                        $dd = $obj->my_query("SELECT att.attribute_id, att.att_name, att.att_type, att.value, sett.set_name, sub.name as sub, main.name as main FROM tbl_attribute as att, tbl_attribute_set as sett, tbl_category as sub, tbl_category as main WHERE att.attribute_set_id = sett.attribute_set_id AND sett.category_id = sub.category_id AND sub.parent_id = main.category_id");
                                        while ($row = $dd->fetch_object()) {
                                            $c++;
                                            ?>

                                            <tr style="text-align: center;">
                                                <td style="width: 10%; padding: 0px;" >
                                                    <?php echo $c; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->main; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->sub; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->set_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->att_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->att_type; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->value; ?>
                                                </td>


                                                <td style="width: 10%" >
                                                    <a href="manageattribute.php?del=<?php echo $row->attribute_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="manageattribute.php?up=<?php echo $row->attribute_id; ?>"><i class="fa fa-pencil remove" title="Update"></i></a>
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
        <div id="qn"></div>

        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
        </script>
    </body>
</html>