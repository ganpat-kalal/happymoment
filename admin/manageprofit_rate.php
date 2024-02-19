<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();


if (isset($_POST['add'])) 
{
    $wh['profit_rate'] = $_POST['profit_rate'];
    
        
        $ans = $obj->my_insert("tbl_profit_rate", $wh);
}
if(isset($_POST['up']))
{
    $wh['profit_rate'] = $_POST['profit_rate'];
    
        
        $ans = $obj->my_update("tbl_profit_rate", $wh,array("profit_rate_id"=>'2'));
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
                        Manage Profit Rate
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Product</a>
                        </li>
                        <li class="active">
                            Profit Rate
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                
                                <?php
                                
                                $data = $obj->count_record("tbl_profit_rate",array("profit_rate_id"=>"2"));
                                
                                if($data == 1)
                                {
                                    $dt = $obj->my_select("tbl_profit_rate");
                                    
                                    $l = $dt->fetch_object();
                                   ?>
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;">Update Profit Rate</h4>
                                            <br/>
                                            <input type="text" name="profit_rate" value="<?php echo $l->profit_rate; ?>" class="form-control" style="font-size: 13px"  placeholder="Enter Profit Rate" data-bvalidator="required,digit"/>

                                        </div>

                                    </div>
                                    <label>Note that the Product rate is increase by the above percentage and it is your profit.</label>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="up" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        
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
                                            <h4 style="font-size: 14px;">Add Profit Rate</h4>
                                            <br/>
                                            <input type="text" name="profit_rate" class="form-control" style="font-size: 13px"  placeholder="Enter Profit Rate" data-bvalidator="required,digit"/>

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
                                        ?>
                                    </div>
                                </form>
                                <?php
                                }
                                ?>
                              </div>
                            <div style="width: 45%; padding: 20px; background-color: #FF4500;" class="col-sm-6 col-md-6 col-lg-6">
                                <div>
                                    <center><h2 style="color: white">Profit Rate</h2></center>
                                </div>
                                <div>
                                    <center><h1 style="font-size: 40px; color: white"><?php echo $l->profit_rate; ?> %</h1></center>
                                </div>
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