<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_GET['del']))
{
    $where['wishlist_id']=$_GET['del'];
    $obj->my_delete("tbl_wishlist", $where);
    header('location:mywishlist.php');
}

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
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li class="active">
                            My Wishlist
                        </li>
                    </ol>
                </section>
                <section class="content sec-mar">
                    <section class="main-page container" style="width: 1070px">
                        <div class="main-container col1-layout">
                            <div class="main">
                                <div class="col-main">

                                    <!-- / Order History-->
                                    <section class="wishlist-box oder-history">
                                        <div class="page-title margign-30"><span>wishlist</span></div>
                                        <br/>
                                        <div class="shopping-content">
                                                <div class="table-responsive">
                                                    <table class="cart-table data-table">
                                                        <!-- list --> 
                                                        <thead>
                                                            <tr>
                                                                <th class="text-center">img</th>
                                                                <th class="text-left">product name</th>
                                                                <th class="text-left">Stock</th>
                                                                <th class="text-left">Unit Price</th>
                                                                <th class="text-right">action</th>
                                                            </tr>
                                                        </thead>
                                                        <!-- / list -->
                                                        <tbody>
                                                            <?php
                                                                $ww = $obj->my_select("tbl_wishlist",NULL,array("registration_id"=>$_SESSION['user']));
                                                                while($www = $ww->fetch_object())
                                                                {
                                                                    //echo $www->product_id;
                                                            ?>
                                                            <tr>
                                                                <?php
                                                                    $pro = $obj->my_select("tbl_product",NULL,array("product_id"=>$www->product_id))->fetch_object();
                                                                ?>
                                                                <td class="text-center">
                                                                    <?php
                                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $www->product_id))->fetch_object();
                                                                        
                                                                        $imgarr = explode(",", $img->path);
                                                                        ?>
                                                                        <a href="" title="<?php echo $pro->product_name; ?>"> 
                                                                            <img src="../seller/<?php echo $imgarr[0]; ?>" style="height: 50px"/>
                                                                        </a>
                                                                </td>
                                                                <td class="text-left">
                                                                    <ul>
                                                                        <li><a href="../productdetail.php?id=<?php echo $pro->product_id; ?>"><?php echo $pro->product_name; ?></a></li>
                                                                    </ul>
                                                                </td>
                                                                <?php
                                                                if($pro->stock_status == 0)
                                                                {
                                                                ?>
                                                                <td class="text-left">In Stock</td>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <td class="text-left">Out of Stock</td>
                                                                <?php
                                                                }
                                                                ?>
                                                                <td class="text-right new">
                                                                    <?php
                                                                        $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                        $rs = ($pro->price * $profit->profit_rate) / 100;
                                                                        $net = $rs + $pro->price;
                                                                        $net = round($net);
                                                                        ?>
                                                                    <span class="new">₹ <?php echo $net; ?></span>
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="float-right">
                                                                        <?php
                                                                            $cart = $obj->count_record("tbl_cart", array("product_id" => $www->product_id, "registration_id" => $_SESSION['user']));
                                                                            if ($cart == 0) 
                                                                                {
                                                                                ?>
                                                                                <div id="wish<?php echo $www->product_id; ?>" style="float: left;margin-right: -50px">
                                                                                    <button id="stat<?php echo $www->product_id; ?>" onclick="add_cartt(<?php echo $www->product_id; ?>)" class="btn btn-button global-bg white" title="Add to Cart" data-toggle="tooltip" data-placement="top"><i class="fa fa-shopping-cart"></i></button>
                                                                                </div>
                                                                                <?php
                                                                                } 
                                                                                else 
                                                                                {
                                                                                ?>
                                                                                    <button class="btn btn-button global-bg white" title="Added to Cart" data-toggle="tooltip" style="background: orangered;" data-placement="top"><i class="fa fa-shopping-cart"></i></button>
                                                                                <?php
                                                                                }
                                                                            ?>
                                                                        <a href="mywishlist.php?del=<?php echo $www->wishlist_id; ?>" onclick="return confirm('Are you sure want to delete ?');" class="btn btn-button global-bg white" title="Remove" data-toggle="tooltip" data-placement="top"><span class="fa fa-remove"></span></a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        <?php
                                                                }
                                                        ?>
                                                    </table>
                                                </div>
                                            <br/>
                                            <div class="buttons padding-top-product">
                                                <a href="../cart.php" class="btn btn-button global-bg white"> Go To Cart </a>
                                            </div>
                                        </div>
                                    </section>
                                    <!-- / Order History -->
                                </div>
                            </div>
                        </div>
                    </section>
                </section>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
    </body>
</html>