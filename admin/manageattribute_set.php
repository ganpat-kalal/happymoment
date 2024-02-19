<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if(isset($_GET['del']))
{
    $where['attribute_set_id']=$_GET['del'];
    $obj->my_delete("tbl_attribute_set", $where);
    header('location:manageattribute_set.php');
}

if(isset($_POST['add_set']))
{
    $data['set_name'] = $_POST['set_name'];
    $data['category_id'] = $_POST['sub'];
    
    $c = $obj->count_record("tbl_attribute_set", $data);
    if($c == 0)
    {
        $ans = $obj->my_insert("tbl_attribute_set", $data);
    }
    else 
    {
        $er = $_POST['set_name']." "."Already Exist!";
    }
}

if(isset($_POST['up_set']))
{
    $data['set_name'] = $_POST['set_name'];
    $data['category_id'] = $_POST['sub'];
    
    $c = $obj->count_record("tbl_attribute_set", $data);
    
    if($c == 0)
    {
        $obj->my_update("tbl_attribute_set", $data,array("attribute_set_id"=>$_GET['up']));
        header('location:manageattribute_set.php');
    }
    else 
    {
        $er = $_POST['set']." "."Already Exist!";
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
                        Manage Attribute Set
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
                            Attribute set
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <?php
                                    if(isset($_GET['up']))
                                    {
                                        $dt = $obj->my_select("tbl_attribute_set",NULL,array("attribute_set_id"=>$_GET['up']))->fetch_object();
                                        
                                        $main = $obj->my_select("tbl_category",NULL,array("category_id"=>$dt->category_id))->fetch_object();
                                ?>
                                
                            <!-- update form -->    
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Update Attribute Set</h4>
                                            <br/>
                                            <select class="form-control" name="main" onchange="set_combo('sub',this.value);"  data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Main Category</option>
                                                <?php
                                                    $hh['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $hh);
                                                
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($row->category_id == $main->parent_id){ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Sub Category</option>
                                                <?php
                                                    $data = $obj->my_select("tbl_category", NULL, array("parent_id"=>$main->parent_id));
                                                
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($row->category_id == $dt->category_id){ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <input type="text" class="form-control" name="set_name" style="font-size: 13px" value="<?php echo $dt->set_name; ?>" placeholder="Enter Attribute set" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="up_set" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="manageattribute_set.php" class="btn btn-button global-bg white">Cancel</a>
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
                                    else 
                                    {
                                ?>
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Add Attribute Set</h4>
                                            <br/>
                                            <select class="form-control" name="main" onchange="set_combo('sub',this.value);"  data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Main Category</option>
                                                <?php
                                                    $hh['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $hh);
                                                
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Sub Category</option>
                                                
                                            </select>
                                            <br/>
                                            <input type="text" class="form-control" name="set_name" style="font-size: 13px"  placeholder="Enter Attribute set" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="add_set" class="btn btn-button global-bg white">Add</button>
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
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Attribute Set
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
                                            $c =0;
                                            $dd = $obj->my_query("SELECT att.attribute_set_id,att.set_name,sub.name as sub,main.name as main FROM tbl_attribute_set as att,tbl_category as sub,tbl_category as main WHERE sub.category_id = att.category_id AND main.category_id = sub.parent_id");
                                            while($row = $dd->fetch_object())
                                            {
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
                                                <?php echo $row->sub ?>
                                            </td>
                                            <td>
                                                <?php echo $row->set_name; ?>
                                            </td>
                                           
                                            <td style="width: 10%" >
                                                <a href="manageattribute_set.php?del=<?php echo $row->attribute_set_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                                            </td>
                                            <td style="width: 10%" >
                                                <a href="manageattribute_set.php?up=<?php echo $row->attribute_set_id; ?>"><i class="fa fa-pencil remove" title="Update"></i></a>
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