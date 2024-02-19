<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seller Panel</title>
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
                    <h1>
                        Dashboard
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
                        <div class="col-md-3 bogda" title="Products">
                            <div class="bogda-heding">
                                <h1>Total Products</h1>
                            </div>
                            <div class="bogda-counter" >
                                <h1 id="tot_pro">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Active Products">
                            <div class="bogda-heding">
                                <h1>Active Products</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_acpro">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Pending Products">
                            <div class="bogda-heding">
                                <h1>Pending Products</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_pnpro">0</h1>
                            </div>
                        </div>
                    </div>
                </section>
                
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        $ss = $_SESSION['seller'];
        $tpro = $obj->my_query("SELECT count(*) as tpro FROM tbl_product WHERE seller_id = $ss")->fetch_object();
        $tac = $obj->my_query("SELECT count(*) as tac FROM tbl_product WHERE seller_id = $ss and status = 1")->fetch_object();
        $tpn = $obj->my_query("SELECT count(*) as tpn FROM tbl_product WHERE seller_id = $ss and status = 0")->fetch_object();
        
        ?>
        <?php
            $pro = $obj->my_select("tbl_product",NULL,array("seller_id"=>$_SESSION['seller']))->fetch_object();
        ?>
        <script type="text/javascript">
            counter('tot_pro',<?php echo $tpro->tpro; ?>);
            counter('tot_acpro',<?php echo $tac->tac; ?>);
            counter('tot_pnpro',<?php echo $tpn->tpn; ?>);
        </script>
    </body>
</html>