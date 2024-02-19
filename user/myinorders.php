<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Panel</title>
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
                        My Orders
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            My Orders
                        </li>
                    </ol>
                </section>
                <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">

                            <!-- / Order History-->
                            <section class="oder-history">
                                <div class="page-title "><span>Order History</span></div>
                                <div class="shopping-content marging-30">
                                    <form method="post" action="#">
                                        <div class="table-responsive">
                                            <table class="cart-table data-table" style="margin-top: 15px;width: 92%;">
                                               <!-- list --> 
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">img</th>
                                                        <th class="text-left">product name</th>
                                                        <th class="text-left">qty</th>
                                                        <th class="text-left">Price</th>
                                                        <th class="text-right">Discount</th>
                                                        <th class="text-right">Orderd on</th>
                                                        <th class="text-right">Action</th>
                                                    </tr>
                                                </thead>
                                                <!-- / list -->
                                                <tbody>
                                                    <?php
                                                        $bill = $obj->my_select("tbl_bill",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();
                                                        $transaction = $obj->my_select("tbl_transaction",NULL,array("bill_id"=>$bill->bill_id));
                                                        while($trans = $transaction->fetch_object())
                                                        {
                                                    ?>
                                                   <!-- item -->
                                                    <tr>
                                                        <?php
                                                            $pro = $obj->my_select("tbl_product",NULL,array("product_id"=>$trans->product_id))->fetch_object();
                                                        ?>
                                                        <td class="text-center">
                                                            <a href="#" title="<?php echo $pro->product_name; ?>">
                                                                <?php 
                                                                    $img = $obj->my_select("tbl_product_image",NULL,array("product_id"=>$trans->product_id))->fetch_object();
                                                                    $imgarr = explode(",", $img->path);
                                                                ?>
                                                                <img src="../seller/<?php echo $img->path; ?>" style="height: 70px" />
                                                            </a>
                                                        </td>
                                                        <td class="text-left">
                                                            <ul>
                                                                <li><a href="../productdetail.php?id=<?php echo $pro->product_id; ?>"><?php echo $pro->product_name; ?></a></li>
                                                            </ul>
                                                        </td>
                                                        <td class="text-left">x <?php echo $trans->qty; ?></td>
                                                        <td class="text-right">₹ <?php echo $trans->final_price; ?></td>
                                                        <td class="text-right">₹ <?php echo $trans->discount; ?></td>
                                                        <?php
                                                            $date = $obj->my_select("tbl_bill",NULL,array("bill_id"=>$trans->bill_id))->fetch_object();
                                                        ?>
                                                        <td class="text-right"><?php echo date('d-m-Y',strtotime($date->date)); ?></td>
                                                        <td class="text-right">
                                                            <div class="float-right">
                                                                <a href="../productdetail.php?id=<?php echo $pro->product_id; ?>" class="btn btn-button global-bg white">Re Order</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- / item -->
                                                    <?php
                                                        }
                                                    ?>    
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                    <div class="buttons padding-top-product" style="margin: 10px">
                                        <a href="../index.php" class="btn btn-button global-bg white"> Go For Shop </a>
                                    </div>
                                </div>
                            </section>
                            <!-- / Order History -->
                        </div>
                    </div>
                </div>
            </section>
            </aside>    
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
            $("#myform1").bValidator();
            
            function printbill()
            {
                //alert("hii");
                var p = document.getElementById('billdiv');
                var pp = window.open('','_blank');
                
                pp.document.open();
                pp.document.write('<html><body onload="window.print()">' + p.innerHTML + '</html>');
                pp.document.close();
            }
        </script>
    </body>
</html>
