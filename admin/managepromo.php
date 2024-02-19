<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if (isset($_POST['add'])) 
{
    $wh['code'] = $_POST['code'];
    
    $count = $obj->count_record("tbl_promocode",$wh);
    
    if($count == 0)
    {
        $data['code'] = $_POST['code'];
        $data['amount'] = $_POST['amount'];
        $data['min_bill_price'] = $_POST['min_bill_price'];
        
        $ans = $obj->my_insert("tbl_promocode", $data);
    }
    else
    {   //eroor
        $er = $_POST['code']." Already Exist.";
    }
        
}

if(isset($_GET['del']))
{
    $where['promocode_id']=$_GET['del'];
    $obj->my_delete("tbl_promocode", $where);
    header('location:managepromo.php');
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
                        Manage Promocodes
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
                            Promo Codes
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
                                        $data = $obj->my_select("tbl_promocode",NULL,array("promocode_id"=>$_GET['up']))->fetch_object();
                                        
                                ?>
                            <!--  update form  -->
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Update PromoCode</h4>
                                            <br/>
                                            <input type="text" name="code" value="<?php echo $data->code; ?>" class="form-control" style="font-size: 13px"  placeholder="Enter Promo Code" data-bvalidator="required,alphanum"/>
                                            <br/>
                                            <input type="text" name="amount" value="<?php echo $data->amount; ?>" class="form-control" style="font-size: 13px"  placeholder="Enter Amount" />
                                            <br/>
                                            <input type="text" name="min_bill_price" value="<?php echo $data->min_bill_price; ?>" class="form-control" style="font-size: 13px"  placeholder="Enter Minimum Bill Price" />

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="up" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <a href="managepromo.php" class="btn btn-button global-bg white">Cancel</a>
                                        </span>

                                        <?php
                                        if (isset($er)) 
                                        {
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
                        <!-- insert form  -->    
                            <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;"> Add PromoCode</h4>
                                            <br/>
                                            <input type="text" name="code" class="form-control" style="font-size: 13px"  placeholder="Enter Promo Code" data-bvalidator="required,alphanum"/>
                                            <br/>
                                            <input type="text" name="amount" class="form-control" style="font-size: 13px"  placeholder="Enter Amount" data-bvalidator="required,digit"/>
                                            <br/>
                                            <input type="text" name="min_bill_price" class="form-control" style="font-size: 13px"  placeholder="Enter Minimum Bill Price" data-bvalidator="required,digit"/>

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
                                        if (isset($er)) 
                                        {
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
                                <table class="table table-responsive nova-pagging" id="promo">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Promo Code
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Amount
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                Minimum Bill Price
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $c = 0;
                                        $data = $obj->my_select("tbl_promocode");
                                        while ($row = $data->fetch_object()) 
                                        {
                                            $c++;
                                        ?>
                                            <tr style="text-align: center;">
                                                <td style="width: 10%; padding: 0px;" >
                                                    <?php echo $c; ?>
                                                </td>

                                                <td>
                                                   <?php echo $row->code; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->amount; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row->min_bill_price; ?>
                                                </td>
                                                <td style="width: 10%" >
                                                    <?php
                                                        if($row->status == 0)
                                                        {
                                                    ?>
                                                    <i class="fa fa-toggle-off" title="Active Now" onclick="activation('promo','active',<?php echo $row->promocode_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                                     <?php
                                                        }
                                                        else
                                                        {
                                                     ?>
                                                     <i class="fa fa-toggle-on" title="Block Now" onclick="activation('promo','deactive',<?php echo $row->promocode_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                                     <?php
                                                        }
                                                     ?>
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