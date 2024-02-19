<?php
require_once './connection.php';

$obj = new model();

if (!isset($_SESSION['user'])) {
    header('location:index.php');
}

$count = $obj->count_record("tbl_cart", array("registration_id" => $_SESSION['user']));

if ($count == 0) {
    header('location:cart.php');
}
if(isset($_POST['pay']))
{
    $_SESSION['pay'] = $_POST['pay'];
    if($_SESSION['paymode'] == "" && $_SESSION['address'] == "")
    {
        $err = "Please, Select Payment Method AND Shipping Address...!";
    }
    
    if(isset($_POST['payment_method']))
        {
            $_SESSION['paymode'] = $_POST['payment_method'];
        }
        else
        {
            $err = "Please, Select Payment Method...!";
        }

        if(!isset($_SESSION['address']))
        {
            $err = "Please, Select Shipping Address...!";
        }
    
    if($err == "")
    {
        header('location:confirmorder.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HappyMoment | Celebrate Your Happy Moment with us</title>
        <meta name="keywords" content="business, ecommerce, ecommerce psd, fashion, online shopping, shopping">
        <meta name="description" content="Prallax-Multipurpose eCommerce html Template is a the best design for shopping 2016. any kinds of Store eCommerce theme Based on Bootstrap, 12 column Responsive grid Template. “Prallax” is a smooth and colorful E-commerce html Template, perfect suitable for , clothing or fashion e-commerce online shop / store websites. It includes everything you need for the website development such as eCommerce online store .PSD files are well organized also you can customize very easy . we have include 24 html file for you">
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body>
        <div class="wrapper">
            <div class="page">
                <header>
                    <?php
                    require_once 'headline.php';
                    ?>
                    <?php
                    require_once 'header.php';
                    ?>
                    <?php
                    require_once 'menubar.php';
                    ?>
                </header>
                <section class="breadcrumb-area padding-30">
                    <div class="container">
                        <div class="breadcrumb breadcrumb-box">
                            <ul>
                                <li><a href="index.php"><span ><span>Home</span></span></a></li>
                                <li style="color: #FF4500"><span>Checkout</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="main-page container">
                    <div class="main-container col1-layout">
                        <div class="main">
                            <div class="col-main">
                                <section class="shopping-cart">
                                    <div class="page-title ">
                                        <span>checkout</span>
                                    </div>
                                    <form method="POST" action="">
                                    <div class="checkout-area marging-30">
                                        <div id="accordion" class="panel-group">
                                            <!-- CheckOut option -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-checkout-confirm"><span>1</span> Confirm Order <i class="fa fa-caret-down"></i>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse-checkout-confirm" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">No</th>
                                                                        <th class="text-center">Product</th>
                                                                        <th class="text-center">Product Name</th>
                                                                        <th class="text-right">Unit Price</th>
                                                                        <th class="text-center">Discount</th>
                                                                        <th class="text-center">Net Price</th>
                                                                        <th class="text-left">Qty</th>
                                                                        <th class="text-right">Total</th>

                                                                    </tr>
                                                                </thead>
                                                                <!-- / list -->
                                                                <tbody>
                                                                    <!-- item -->
                                                                    <?php
                                                                    $c = 0;
                                                                    $total = 1;
                                                                    $totalprice = 0;
                                                                    $r_id = $_SESSION['user'];

                                                                    $cart = $obj->my_select("tbl_cart", NULL, array("registration_id" => $r_id));
                                                                    while ($ca = $cart->fetch_object()) {
                                                                        //print_r($ca);
                                                                        $c++;
                                                                        $pr = $obj->my_select("tbl_product", NULL, array("product_id" => $ca->product_id))->fetch_object();
                                                                        ?>
                                                                        <tr>
                                                                            <td class="text-left">
                                                                                <ul>
                                                                                    <li><a href="#"><?php echo $c; ?></a></li>
                                                                                </ul>
                                                                            </td>
                                                                            <td class="text-center">
                                                                                <?php
                                                                                $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pr->product_id))->fetch_object();

                                                                                $imgarr = explode(",", $img->path);
                                                                                ?>
                                                                                <a href="#">
                                                                                    <img alt="" src="seller/<?php echo $imgarr[0]; ?>" width="100px">
                                                                                </a>
                                                                            </td>
                                                                            <td class="text-left"><?php echo $pr->product_name; ?></td>

                                                                            <?php
                                                                            $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                            $rs = ($pr->price * $profit->profit_rate) / 100;
                                                                            $net = $rs + $pr->price;
                                                                            $net = round($net);

                                                                            if ($pr->offer_id != 0) {
                                                                                $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $pr->offer_id))->fetch_object();
                                                                                $rs = ($net * $rate->rate) / 100;
                                                                                $nett = $net - $rs;
                                                                                $nett = round($nett);
                                                                                ?>
                                                                                <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                                <td class="text-right">₹ <?php echo $rs; ?> /-</td>
                                                                                <td class="text-right">₹ <?php echo $nett; ?> /-</td>
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                                <td class="text-right">₹ 00</td>
                                                                                <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                            <td class="text-left">
                                                                                <?php echo $ca->qty; ?>
                                                                            </td>
                                                                            <?php
                                                                            $total = $net * $ca->qty;
                                                                            ?>
                                                                            <td class="text-right">₹ <?php echo $total; ?></td>

                                                                        </tr>
                                                                        <?php
                                                                        $totalprice = $totalprice + $total;
                                                                    }
                                                                    ?>
                                                                    <!-- / item -->
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td class="text-right" colspan="7"><strong>Total Paybal Amount</strong></td>
                                                                        <td class="text-right">₹ <?php echo $totalprice; ?></td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                            <div class="button-set">
                                                                <a href="cart.php" class="btn btn-button global-bg white">Update Order</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / CheckOut option -->
                                            <!-- Delivery Details -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-shipping-address"><span>2</span> Delivery Details <i class="fa fa-caret-down"></i>
                                                        </a>
                                                    </h4>
                                                    <h4 class="panel-title"></h4>
                                                </div>
                                                <div id="collapse-shipping-address" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="row" id="setaddress">
                                                            <div><label> <b>SELECT ADDRESS</b></label></div>
                                                            <?php
                                                            $address = $obj->my_select("tbl_shipment", NULL, array("registration_id" => $_SESSION['user']));

                                                            while ($add = $address->fetch_object()) {
                                                                if ($add->shipment_id == $_SESSION['address']) {
                                                                    ?>
                                                                    <div class="col-sm-2 col-md-3 col-lg-3" style="background-color: #ddd; border: 1px solid orangered; margin: 20px;margin-right: 70px; min-height: 140px;">
                                                                        <button type="button" name="address" onclick="c_address(<?php echo $add->shipment_id; ?>)" style="background: transparent;padding: 11px;padding-top: 28px;border: none;"><?php echo $add->address ?><br/><br/><b style="color: rgba(0,128,0,0.5); font-size: 25px" class="fa fa-check-circle">Selected</b></button>
                                                                    </div>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="col-sm-2 col-md-3 col-lg-3" style="background-color: #ddd; border: 1px solid orangered; margin: 20px;margin-right: 70px; min-height: 140px;">
                                                                        <button type="button" name="address" onclick="c_address(<?php echo $add->shipment_id; ?>)" style="background: transparent;padding: 11px;padding-top: 28px;border: none;"><?php echo $add->address; ?></button>
                                                                    </div>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="button-set">
                                                            <a href="user/myaddress.php" class="btn btn-button global-bg white">Set New Address ?</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Delivery Details -->
                                            <!-- Payment Method -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a class="accordion-toggle collapsed" data-parent="#accordion" data-toggle="collapse" href="#collapse-payment-method"><span>3</span> Payment <i class="fa fa-caret-down"></i>
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse-payment-method" class="panel-collapse collapse">
                                                    <div class="panel-body">
                                                        <div class="panel-body">
                                                            <div class="row">
                                                                <div class="col-sm-3 col-md-6">    
                                                                    <p>Please select the preferred payment method to use on this order.</p>
                                                                    <?php
                                                                        if($_SESSION['paymode'] == "cod")
                                                                        {
                                                                    ?>
                                                                    <div class="radio">
                                                                        <label><input type="radio" checked="" value="cod" name="payment_method"> Cash On Delivery </label>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                    <div class="radio">
                                                                        <label><input type="radio" value="cod" name="payment_method"> Cash On Delivery </label>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                <!-- card -->    
                                                                    <?php
                                                                        if($_SESSION['paymode'] == "card")
                                                                        {
                                                                    ?>
                                                                    <div class="radio">
                                                                        <label><input type="radio" checked="" value="card" name="payment_method"> Credit Card/Debit Card </label>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                    <div class="radio">
                                                                        <label><input type="radio" value="card" name="payment_method"> Credit Card/Debit Card </label>
                                                                    </div>
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                                <div class="col-sm-3 col-md-6"  id="setpromo">
                                                                    <div>
                                                                        <a id="couponbtn" style="cursor: pointer;"><b>Have any Promocode ?</b></a>
                                                                    </div>
                                                                    <div id="viewcoupon">
                                                                    <?php
                                                                    $amount = $_SESSION['final'];
                                                                    $promocode = $obj->my_query("SELECT * from tbl_promocode WHERE status = 1 AND min_bill_price < $amount");
                                                                    while ($promo = $promocode->fetch_object()) 
                                                                    {
                                                                        if ($promo->promocode_id == $_SESSION['promo']) 
                                                                        {
                                                                        ?>
                                                                            <div class="radio">
                                                                                <label style="font-size: 18px; color: orangered"><input checked="" type="radio" value="code" name="code"><?php echo $promo->code; ?></label>
                                                                                <p style="font-size: 12px">(₹ <?php echo $promo->amount; ?> will deduct from Total Amount by using this <?php echo $promo->code; ?> code.)</p>
                                                                            </div>
                                                                        <?php
                                                                        } 
                                                                        else 
                                                                        {
                                                                        ?>
                                                                            <div class="radio">
                                                                                <label style="font-size: 18px; color: orangered"><input onclick="promo(<?php echo $promo->promocode_id; ?>)" type="radio" value="code" name="code"><?php echo $promo->code; ?></label>
                                                                                <p style="font-size: 12px">(₹ <?php echo $promo->amount; ?> will deduct from Total Amount by using this <?php echo $promo->code; ?> code.)</p>
                                                                            </div>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                    </div>
                                                                    <div style="text-align: right; margin-top: 60px">
                                                                        <button type="submit" name="pay" class="btn btn-button global-bg white" >Proceed to Pay </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- / Payment Method -->
                                        </div>
                                    </div>
                                    </form>
                                    <?php
                                        if(isset($err))
                                        {
                                    ?>
                                    <div style="padding: 10px; color: red;font-size: 20px;">&nbsp;&nbsp;&nbsp;<?php echo $err; ?></div>
                                    <?php
                                        }
                                    ?>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
                <footer class="footer-area padding-45">
                    <?php
                    require_once 'footer1.php';
                    ?>
                    <?php
                    require_once 'footer2.php';
                    ?>
                    <?php
                    require_once 'footer3.php';
                    ?>
                </footer>
                <div style="display: block;" id="top-buttom" class="top-bottom"><span class="fa fa-long-arrow-right"></span></div>
            </div>
        </div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            
            $(document).ready(function(){
               
               $("#viewcoupon").hide(); 
               
               $("#couponbtn").click(function(){
                   
                   $("#viewcoupon").show(); 
                   
               });
            });
            
            jQuery(document).ready(function ($) {
                $(function () {
                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values: [50, 450],
                        slide: function (event, ui) {
                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        }
                    });
                    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                            " - $" + $("#slider-range").slider("values", 1));
                });
                /*  select  menu */
                $(function () {
                    $(".selector1").selectmenu();
                });
            });
        </script>
    </body>
</html>