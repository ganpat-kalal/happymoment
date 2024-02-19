<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_POST['up_main']))
{
    $wh['name'] = $_POST['maincategory'];
    $wh['label'] = "maincategory";
    //unique
    $count = $obj->count_record("tbl_category",$wh);
    
    if($count == 0)
    {
        $data['name'] = $_POST['maincategory'];
    
        $ans = $obj->my_update("tbl_category", $data,array("category_id"=>$_GET['up']));
        header('location:managemain.php');
    }
    else
    {  
        $er = $_POST['maincategory']." Already Exist.";
    }
}

if (isset($_GET['del'])) {
    $where['category_id'] = $_GET['del'];
    $obj->my_delete("tbl_category", $where);
    header('location:managemain.php');
}

if (isset($_POST['add_main'])) {
    $data['name'] = $_POST['maincategory'];

    $data['label'] = "maincategory";
    //print_r($data);
    //unique
    $count = $obj->count_record("tbl_category", $data);

    if ($count == 0) {
        //insert
        $ans = $obj->my_insert("tbl_category", $data);
        
    } else {   //eroor
        $er = $_POST['maincategory'] . " Already Exist.";
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
                        Manage Categories
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
                            Main Categorie
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
                                        $data = $obj->my_select("tbl_category",NULL,array("category_id"=>$_GET['up']))->fetch_object();
                                ?>
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;">Update Main Category</h4>
                                            <br/>
                                            <input type="text" name="maincategory" class="form-control" style="font-size: 13px" value="<?php echo $data->name; ?>"  placeholder="Enter Main Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button type="submit" name="up_main" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="managemain.php" class="btn btn-button global-bg white">Cancel</a>
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
                                            <h4 style="font-size: 14px;">Add Main Category</h4>
                                            <br/>
                                            <input type="text" name="maincategory"  class="form-control" style="font-size: 13px"  placeholder="Enter Main Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button type="submit" name="add_main" class="btn btn-button global-bg white">Add</button>
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
                                        $w['label'] = 'maincategory';
                                        $data = $obj->my_select("tbl_category", NULL, $w);
                                        while ($row = $data->fetch_object()) {
                                            $c++;
                                            ?>
                                            <tr style="text-align: center;">
                                                <td style="width: 10%; padding: 0px;" >
                                                    <?php echo $c; ?>
                                                </td>

                                                <td>
                                                    <?php echo $row->name; ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managemain.php?del=<?php echo $row->category_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" title="Remove"></i></a>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="managemain.php?up=<?php echo $row->category_id; ?>" <i class="fa fa-pencil remove" title="Update"></i></a>
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
</html>