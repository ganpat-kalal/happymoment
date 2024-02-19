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
                    <h1 style="float: left">
                        Dashboard
                    </h1>
                    <h1 style="text-align: right">
                        <a href="../index.php" style="color: orangered" class="btn btn-button global-bg  white">Go For Shop</a>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li class="active">
                            Dashboard
                        </li>
                    </ol>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda" title="Total Bill">
                            <div class="bogda-heding">
                                <h1>Total Bill</h1>
                            </div>
                            <div class="bogda-counter" >
                                <h1 id="tot_bill">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Total Transaction">
                            <div class="bogda-heding">
                                <h1>Total Transaction</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_trans">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Coupon Used">
                            <div class="bogda-heding">
                                <h1>Coupon Used</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_coupon">0</h1>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda" title="Wishlist">
                            <div class="bogda-heding">
                                <h1>Products in Wishlist</h1>
                            </div>
                            <div class="bogda-counter" >
                                <h1 id="tot_wish">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Cart">
                            <div class="bogda-heding">
                                <h1>Products in Cart</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_cart">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Addresses">
                            <div class="bogda-heding">
                                <h1>Total Addresses</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_addr">0</h1>
                            </div>
                        </div>
                    </div>
                </section>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        
        $ss = $_SESSION['user'];
        $tbill = $obj->my_query("SELECT count(*) as tbill FROM tbl_bill WHERE registration_id = $ss")->fetch_object();
        $trans = $obj->my_query("SELECT count(t.transaction_id) as trans FROM tbl_transaction as t, tbl_bill as b WHERE t.bill_id = b.bill_id AND b.registration_id = $ss")->fetch_object();
        $tcop = $obj->my_query("SELECT count(promocode_id) as tcop FROM tbl_bill WHERE registration_id = $ss")->fetch_object();
        $twish = $obj->my_query("SELECT count(*) as twish FROM tbl_wishlist WHERE registration_id = $ss")->fetch_object();
        $tcart = $obj->my_query("SELECT count(*) as tcart FROM tbl_cart WHERE registration_id = $ss")->fetch_object();
        $taddr = $obj->my_query("SELECT count(*) as taddr FROM tbl_shipment WHERE registration_id = $ss")->fetch_object();
        ?>
        <script type="text/javascript">
            counter('tot_bill',<?php echo $tbill->tbill; ?>);
            counter('tot_trans',<?php echo $trans->trans; ?>);
            counter('tot_coupon',<?php echo $tcop->tcop; ?>);
            counter('tot_wish',<?php echo $twish->twish; ?>);
            counter('tot_cart',<?php echo $tcart->tcart; ?>);
            counter('tot_addr',<?php echo $taddr->taddr; ?>);
        </script>
    </body>
</html>