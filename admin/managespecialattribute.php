<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if(isset($_POST['add']))
{
    
    $data['sp_name'] = $_POST['sp_name'];
    $data['sp_value'] = $_POST['sp_value'];
    $data['category_id'] = $_POST['sub'];
    
    $c = $obj->count_record("tbl_sp_attribute", $data);
    if($c == 0)
    {
        $ans = $obj->my_insert("tbl_sp_attribute", $data);
    }
    else 
    {
        $er = $_POST['sp_name']." "."Already Exist!";
    }
}
if(isset($_GET['del']))
{
    $where['sp_attribute_id']=$_GET['del'];
    $obj->my_delete("tbl_sp_attribute", $where);
    header('location:managespecialattribute.php');
}
if(isset($_POST['up']))
{
    $data['sp_name'] = $_POST['sp_name'];
    $data['sp_value'] = $_POST['sp_value'];
    $data['category_id'] = $_POST['sub'];
    
    $c = $obj->count_record("tbl_sp_attribute", $data);
    
    if($c == 0)
    {
        $obj->my_update("tbl_sp_attribute", $data,array("sp_attribute_id"=>$_GET['up']));
        header('location:managespecialattribute.php');
    }
    else 
    {
        $er = $_POST['sp_name']." "."Already Exist!";
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
                        Manage Special Attribute
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
                            Manage Special Attribute
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12">
                                <?php
                                    if(isset($_GET['up']))
                                    {
                                        $dt = $obj->my_select("tbl_sp_attribute",NULL,array("sp_attribute_id"=>$_GET['up']))->fetch_object();
                                        
                                        $main = $obj->my_select("tbl_category",NULL,array("category_id"=>$dt->category_id))->fetch_object();
                                ?>
                            <!--  Update form  -->
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <select class="form-control" tabindex="1" name="main" onchange="set_combo('sub',this.value);"  data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Main Category</option>
                                                <?php
                                                    $h['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $h);
                                                
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($row->category_id == $main->parent_id){ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" tabindex="2" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px">
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
                                            </div>
                                        
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6" style="margin-top: -45px;">

                                                </div>
                                                <div col-sm-6 col-md-6 col-lg-6 >
                                                    <input type="text" tabindex="3" name="sp_name" value="<?php echo $dt->sp_name; ?>" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Special Attribute Name" data-bvalidator="required"/>
                                                    <br/>
                                                
                                                    <input type="text" tabindex="4" name="sp_value" value="<?php echo $dt->sp_value; ?>" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Special Attribute Value" data-bvalidator="required"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" tabindex="5" name="up" style= "width:10%" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" tabindex="6" style="width:10%" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="managespecialattribute.php" tabindex="7" class="btn btn-button global-bg white">Cancel</a>
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
                                    else 
                                    {
                                ?>
                        <!--  Insert form  -->    
                            <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <select class="form-control" tabindex="1" name="main" onchange="set_combo('sub',this.value);"  data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Main Category</option>
                                                <?php
                                                    $h['label'] = "maincategory";
                                                    $data = $obj->my_select("tbl_category", NULL, $h);
                                                
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" tabindex="2" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Sub Category</option>
                                                
                                            </select>
                                            </div>
                                        
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <div class="row">
                                                <div class="col-sm-6 col-md-6 col-lg-6" style="margin-top: -45px;">

                                                </div>
                                                <div col-sm-6 col-md-6 col-lg-6 >
                                                    <input type="text" tabindex="3" name="sp_name" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Special Attribute Name" data-bvalidator="required"/>
                                                    <br/>
                                                
                                                    <input type="text" tabindex="4" name="sp_value" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Special Attribute Value" data-bvalidator="required"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" tabindex="5" name="add" style= "width:10%" class="btn btn-button global-bg white">Add</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" tabindex="6" style="width:10%" class="btn btn-button global-bg white">Clear</button>
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
                                                Spe. Att. Name
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Spe. Att. value
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
                                            $dd = $obj->my_query("SELECT att.sp_attribute_id,att.sp_name,att.sp_value,sub.name as sub,main.name as main FROM tbl_sp_attribute as att,tbl_category as sub,tbl_category as main WHERE sub.category_id = att.category_id AND main.category_id = sub.parent_id");
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
                                                    <?php echo $row->sp_name ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->sp_value ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managespecialattribute.php?del=<?php echo $row->sp_attribute_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managespecialattribute.php?up=<?php echo $row->sp_attribute_id; ?>"><i class="fa fa-pencil remove" title="Update"></i></a>
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