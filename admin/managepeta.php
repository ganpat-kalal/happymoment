<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if(isset($_POST['up_peta']))
{
    $wh['name'] = $_POST['peta'];
    $wh['parent_id'] = $_POST['sub'];
    //unique
    $count = $obj->count_record("tbl_category",$wh);
    
    if($count == 0)
    {
        //insert
        $data['name'] = $_POST['peta'];
        $data['parent_id'] = $_POST['sub'];
    
        $ans = $obj->my_update("tbl_category", $data,array("category_id"=>$_GET['up']));
        header('location:managepeta.php');
    }
    else
    {   //error
        $er = $_POST['add_peta']." Already Exist.";
    }
}

if(isset($_POST['add_peta']))
{
    $data['name'] = $_POST['peta'];
    $data['label'] = "petacategory";
    $data['parent_id'] = $_POST['sub'];
    
    $c = $obj->count_record("tbl_category", $data);
    if($c == 0)
    {
        $ans = $obj->my_insert("tbl_category", $data);
    }
    else 
    {
        $er = $_POST['peta']." "."Already Exist!";
    }
}
if(isset($_GET['del']))
{
    $where['category_id']=$_GET['del'];
    $obj->my_delete("tbl_category", $where);
    header('location:managepeta.php');
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
                        Manage Peta Category
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
                            Peta Category
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
                                        
                                        $dd = $obj->my_select("tbl_category",NULL,array("category_id"=>$d->parent_id))->fetch_object();
                                ?>
                            <!-- update form -->
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Update Peta Category</h4>
                                            <br/>
                                            <?php
                                            $hh['label'] = "maincategory";

                                            $data = $obj->my_select("tbl_category", NULL, $hh);
                                            ?>
                                            
                                            <select class="form-control" data-bvalidator="required" onchange="set_combo('sub',this.value)" style="font-size: 13px">
                                                <option value="">Select Main Category</option>
                                                <?php
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($dd->parent_id == $row->category_id){echo "selected";} ?>><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select Sub Category</option>
                                                <?php
                                                    $st = $obj->my_select("tbl_category",NULL,array("parent_id"=>$dd->parent_id));
                                                    while ($row = $st->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($d->parent_id == $row->category_id){echo "selected";} ?>><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <input type="text" class="form-control" name="peta" value="<?php echo $d->name;?>" style="font-size: 13px"  placeholder="Enter Peta Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="up_peta" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="managepeta.php" class="btn btn-button global-bg white">Cancel</a>
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
                                    }
                                    else
                                    {
                                ?>
                            
                            <!-- Insert form -->
                            <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Add Peta Category</h4>
                                            <br/>
                                            <?php
                                            $wh['label'] = "maincategory";

                                            $data = $obj->my_select("tbl_category", NULL, $wh);
                                            ?>
                                            
                                            <select class="form-control" tabindex="1" data-bvalidator="required" onchange="set_combo('sub',this.value)" style="font-size: 13px">
                                                <option value="">Select  Main Category</option>
                                                <?php
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="sub" tabindex="2" id="sub" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select  Sub Category</option>
                                                
                                            </select>
                                            <br/>
                                            <input type="text" class="form-control" name="peta" tabindex="3" style="font-size: 13px"  placeholder="Enter Peta Category" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="add_peta" tabindex="4" class="btn btn-button global-bg white">Add</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" tabindex="5" class="btn btn-button global-bg white">Clear</button>
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
                                                Main Category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Sub Category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Peta Category
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
                                        $query="SELECT peta.category_id, peta.name as petacategory, sub.name as subcategory, main.name as maincategory FROM tbl_category as main,tbl_category as sub,tbl_category as peta WHERE peta.parent_id=sub.category_id AND sub.parent_id=main.category_id";
                                        $data = $obj->my_query($query);
                                        
                                        while ($row = $data->fetch_object()) 
                                        {
                                            $c++;
                                            ?>

                                            <tr style="text-align: center;">
                                            <td style="width: 10%; padding: 0px;" >
                                                <?php echo $c; ?>
                                            </td>

                                            <td>
                                                <?php echo $row->maincategory; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->subcategory; ?>
                                            </td>
                                            <td>
                                                <?php echo $row->petacategory; ?>
                                            </td>
                                           
                                            <td style="width: 10%" >
                                                <a href="managepeta.php?del=<?php echo $row->category_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" name="del"  title="Remove"></i></a>
                                            </td>
                                            <td style="width: 10%" >
                                                <a href="managepeta.php?up=<?php echo $row->category_id; ?>"><i class="fa fa-pencil remove" style="color: black;"  title="Update"></i></a>
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