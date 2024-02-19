<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_POST['add']))
{
    $data['offer_name'] = $_POST['offer_name'];
    $data['rate'] = $_POST['rate'];
    $data['min_price'] = $_POST['min_price'];
    $data['max_price'] = $_POST['max_price'];
    $data['start_date'] = $_POST['start_date'];
    $data['end_date'] = $_POST['end_date'];
    $data['category_id'] = $_POST['peta'];
    $data['max_price'] = $_POST['max_price'];
    
    $c = $obj->count_record("tbl_offer", $data);
    if($c == 0)
    {
        $ans = $obj->my_insert("tbl_offer", $data);
        header('location:manageoffer.php');
    }
    else 
    {
        $er = $_POST['name']." "."Already Exist!";
    }
}
if(isset($_POST['up']))
{
    $data['offer_name'] = $_POST['offer_name'];
    $data['rate'] = $_POST['rate'];
    $data['min_price'] = $_POST['min_price'];
    $data['max_price'] = $_POST['max_price'];
    $data['start_date'] = $_POST['start_date'];
    $data['end_date'] = $_POST['end_date'];
    $data['category_id'] = $_POST['peta'];
    $data['max_price'] = $_POST['max_price'];
    
    $c = $obj->count_record("tbl_offer", $data);
    
    if($c == 0)
    {
        $obj->my_update("tbl_offer", $data,array("offer_id"=>$_GET['up']));
        header('location:manageoffer.php');
    }
    else 
    {
        $er = $_POST['name']." "."Already Exist!";
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
                        Manage Offers
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
                            Manage Offers
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
                                        $dt = $obj->my_select("tbl_offer",NULL,array("offer_id"=>$_GET['up']))->fetch_object();
                                        
                                        $peta = $obj->my_select("tbl_category",NULL,array("category_id"=>$dt->category_id))->fetch_object();
                                        
                                        $sub = $obj->my_select("tbl_category",NULL,array("category_id"=>$peta->parent_id))->fetch_object();
                                        
                                       
                            ?>
                            <!--  Update form   -->    
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <input type="text" name="offer_name" value="<?php echo $dt->offer_name; ?>" tabindex="1" class="form-control" style="font-size: 13px"  placeholder="Enter Offer Name" data-bvalidator="required,alphanum"/>
                                            <br />
                                            <input type="number" name="rate" value="<?php echo $dt->rate; ?>" tabindex="2" class="form-control" style="font-size: 13px"  placeholder="Enter Offer Rate(%)" data-bvalidator="required,digit"/>
                                            <br/>
                                            <?php
                                            $hh['label'] = "maincategory";

                                            $data = $obj->my_select("tbl_category", NULL, $hh);
                                            ?>
                                            
                                            <select class="form-control" onchange="set_combo('sub',this.value)" style="font-size: 13px">
                                                <option value="">Select Main Category</option>
                                                <?php
                                                    while ($row = $data->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($sub->parent_id == $row->category_id){echo "selected";} ?>><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="sub" id="sub" onchange="set_combo('peta',this.value) style="font-size: 13px">
                                                <option value="">Select Sub Category</option>
                                                <?php
                                                    $st = $obj->my_select("tbl_category",NULL,array("category_id"=>$sub->category_id));
                                                    while ($row = $st->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $row->category_id; ?>" <?php if($row->category_id == $peta->parent_id){echo "selected";} ?>><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                            <br/>
                                            <select class="form-control" name="peta" id="peta" style="font-size: 13px">
                                                <option value="0">All Peta Category</option>
                                                <?php
                                                    $pt = $obj->my_select("tbl_category",NULL,array("category_id"=>$dt->category_id));

                                                    while ($row = $pt->fetch_object()) 
                                                    {
                                                ?>
                                                <option value="<?php echo $p->category_id; ?>" <?php if($row->category_id == $dt->category_id){ echo "selected"; } ?> ><?php echo $row->name; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <div class="form-inline">
                                                <input type="number" name="min_price" value="<?php echo $dt->min_price; ?>" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Min-Price" data-bvalidator="required,alphanum"/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="number" name="max_price" value="<?php echo $dt->max_price; ?>" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Max-Price" data-bvalidator="required,alphanum"/>
                                            </div>
                                        </div>
                                        <br/><br/><br/>
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <div class="form-inline">
                                                Start Date : <input type="date" name="start_date" value="<?php echo $dt->start_date; ?>" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Start-Date" data-bvalidator="required,alphanum"/>
                                                <br/>
                                                <br/>
                                                End Date : &nbsp;&nbsp;<input type="date" name="end_date" value="<?php echo $dt->end_date; ?>" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter End-Date" data-bvalidator="required,alphanum"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="up" style= "width:10%" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" style= "width:10%" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="manageoffer.php" class="btn btn-button global-bg white">Cancel</a>
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
                                            <input type="text" name="offer_name" tabindex="1" class="form-control" style="font-size: 13px"  placeholder="Enter Offer Name" data-bvalidator="required,alphanum"/>
                                            <br />
                                            <input type="number" name="rate" tabindex="2" class="form-control" style="font-size: 13px"  placeholder="Enter Offer Rate(%)" data-bvalidator="required,digit"/>
                                            <br/>
                                            <?php
                                                $wh['label'] = "maincategory";
                                                $data = $obj->my_select("tbl_category", NULL, $wh);
                                            ?>
                                            
                                            <select class="form-control" tabindex="3" onchange="set_combo('sub',this.value)" style="font-size: 13px">
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
                                            <select class="form-control" name="sub" tabindex="4" id="sub" onchange="set_combo('peta',this.value)" style="font-size: 13px">
                                                <option value="">Select  Sub Category</option>
                                                
                                            </select>
                                            <br/> 
                                            <select class="form-control" name="peta" tabindex="4" id="peta" style="font-size: 13px">
                                                <option value="0">All  Peta Category</option>
                                                
                                            </select>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            
                                            <div class="form-inline">
                                                <input type="number" name="min_price" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Min-Price" data-bvalidator="required,alphanum"/>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="number" name="max_price" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Max-Price" data-bvalidator="required,alphanum"/>
                                            </div>
                                        </div>
                                        <br/><br/><br/>
                                        <div class="col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <div class="form-inline">
                                                Start Date : <input type="date" name="start_date" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter Start-Date" data-bvalidator="required,alphanum"/>
                                                <br/>
                                                <br/>
                                                End Date : &nbsp;&nbsp;<input type="date" name="end_date" tabindex="1" class="form-control" style="font-size: 13px; width: 35%"  placeholder="Enter End-Date" data-bvalidator="required,alphanum"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="add" style= "width:10%" class="btn btn-button global-bg white">Add</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" style= "width:10%" class="btn btn-button global-bg white">Clear</button>
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
                                                Name 
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Rate(%)
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Main category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Sub category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Peta category
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Min. Price
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Max. Price
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                Start Date
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="yes">
                                                End Date
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Status
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Update
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $c =0;
                                            $dd = $obj->my_select("tbl_offer");
                                            while($row = $dd->fetch_object())
                                            {
                                                $c++;
                                        ?>
                                        <tr style="text-align: center;">
                                                <td style="width: 10%; padding: 0px;" >
                                                    <?php echo $c; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->offer_name; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->rate; ?>
                                                </td>
                                                <?php 
                                                    $yy = $row->category_id;
                                                    $reco = $obj->my_query("select pt.category_id,sb.name as sub_category, main.name as main_category, pt.name as peta_category from tbl_category as pt, tbl_category as sb, tbl_category as main WHERE sb.parent_id = main.category_id AND pt.parent_id = sb.category_id AND pt.category_id = $yy")->fetch_object();    
                                                ?>
                                                <td>
                                                    <?php
                                                        if($yy == 0)
                                                        {
                                                            echo "All";
                                                        }
                                                        else
                                                        {
                                                            echo $reco->main_category;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($yy == 0)
                                                        {
                                                            echo "All";
                                                        }
                                                        else
                                                        {
                                                            echo $reco->sub_category;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                        if($yy == 0)
                                                        {
                                                            echo "All";
                                                        }
                                                        else
                                                        {
                                                            echo $reco->peta_category;
                                                        }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->min_price; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->max_price; ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d-m-Y', strtotime($row->start_date)); ?>
                                                </td>
                                                <td>
                                                    <?php echo date('d-m-Y', strtotime($row->end_date)); ?>
                                                </td>
                                                <td>
                                                    <?php 
                                                    if($row->status == 0)
                                                    {
                                                    ?>
                                                    <i class="fa fa-toggle-off" title="Not Running Now" style="font-size:15px; cursor: pointer"></i>
                                                    <?php
                                                    }
                                                    else
                                                    {
                                                    ?>
                                                    <i class="fa fa-toggle-on" title="Running Now" style="font-size:15px; cursor: pointer"></i>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <a href="manageoffer.php?up=<?php echo $row->offer_id; ?>"><i class="fa fa-pencil remove" title="Update"></i></a>
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
