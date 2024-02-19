<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_POST['up_sub']))
{
    $wh['name'] = $_POST['txt_sub'];
    $wh['label'] = "subcategory";
    //unique
    $count = $obj->count_record("tbl_category",$wh);
    
    if($count == 0)
    {
        //insert
        $data['name'] = $_POST['txt_sub'];
        $data['parent_id'] = $_POST['maincategory'];
    
        $ans = $obj->my_update("tbl_category", $data,array("category_id"=>$_GET['up']));
        header('location:managesub.php');
    }
    else
    {   //eroor
        $er = $_POST['txt_sub']." Already Exist.";
    }
}

if(isset($_GET['del']))
{
    $where['category_id']=$_GET['del'];
    
    $obj->my_delete("tbl_category", $where);
    header('location:managesub.php');
}

if (isset($_POST['add_sub'])) 
{
    $data['name'] = $_POST['sub'];
    $data['label'] = "subcategory";
    $data['parent_id'] = $_POST['maincategory'];
    
    $c = $obj->count_record("tbl_category", $data);
    if ($c == 0) {
        $ans = $obj->my_insert("tbl_category", $data);
    } 
    else 
    {
        $er = $_POST['sub'] . " Already Exist.";
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
                        Manage Sub Category                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="#">Products</a>
                        </li>
                        <li class="active">
                            Sub Category
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
                                        $d = $obj->my_select("tbl_category",NULL,array("category_id"=>$_GET['up']))->fetch_object();
                                ?>
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Update Sub Category</h4>
                                            <br/>
                                            <?php
                                            $wh['label'] = "maincategory";

                                            $data = $obj->my_select("tbl_category", NULL, $wh);
                                            ?>
                                            <select name="maincategory" class="form-control" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select Main Category</option>
                                                <?php
                                                while ($row = $data->fetch_object()) {
                                                    ?>
                                                    <option value="<?php echo $row->category_id; ?>" <?php if($d->parent_id == $row->category_id){echo "selected";} ?>><?php echo $row->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <input type="text" name="txt_sub" class="form-control" style="font-size: 13px" value="<?php echo $d->name;?>" placeholder="Enter  Sub Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button name="up_sub" type="submit" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="managesub.php" class="btn btn-button global-bg white">Cancel</a>
                                        </span>
                                        
                                        <?php
                                        if (isset($ans)) {
                                            if ($ans == 1) {
                                                ?>
                                                
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
                                            <h4 style="font-size: 14px;"> Add Sub Category</h4>
                                            <br/>
                                            <?php
                                            $wh['label'] = "maincategory";

                                            $data = $obj->my_select("tbl_category", NULL, $wh);
                                            ?>
                                            <select name="maincategory" tabindex="1" class="form-control" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select Main Category</option>
                                                <?php
                                                while ($row = $data->fetch_object()) {
                                                    ?>
                                                    <option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <input type="text" name="sub" tabindex="2" class="form-control" style="font-size: 13px"  placeholder="Enter  Sub Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button name="add_sub" tabindex="3" type="submit" class="btn btn-button global-bg white">Add</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" tabindex="4" class="btn btn-button global-bg white">Clear</button>
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
                                         $query="SELECT sub.category_id,sub.name as sub,main.name as main FROM `tbl_category` as sub,  `tbl_category` as main WHERE sub.label = 'subcategory' AND main.category_id = sub.parent_id";
                                        $data = $obj->my_query($query);
                                        while ($row = $data->fetch_object()) {
                                            $c++;
                                            ?>
                                            <tr style="text-align: center;">
                                                <td style="width: 10%;text-align: center;">
                                                    <?php echo $c; ?>
                                                </td>
                                                <td style="width: 10%;text-align: center;">
                                                    <?php echo $row->main; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->sub; ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managesub.php?del=<?php echo $row->category_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" title="Remove"></i></a>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managesub.php?up=<?php echo $row->category_id; ?>"><i class="fa fa-pencil remove" style="color:black;"  title="Update"></i></a>
                                                </td>
                                            </tr>
                                            <?php
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
</html>1