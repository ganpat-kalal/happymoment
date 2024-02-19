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

$price = $_SESSION['final'];
$paymode = $_SESSION['paymode'];

if(isset($_SESSION['paymode']))
{
    $data['registration_id'] = $_SESSION['user'];
    $data['shipment_id'] = $_SESSION['address'];
    $data['promocode_id'] = $_SESSION['promo'];
    $data['payment_type'] = $_SESSION['paymode'];
    $data['amount'] = $_SESSION['final'];
    $data['date'] = date('Y-m-d');
    
    $ans = $obj->my_insert("tbl_bill", $data);
    
    $user = $_SESSION['user'];
    $bill = $obj->my_query("SELECT MAX(bill_id) as bill FROM tbl_bill WHERE registration_id = $user")->fetch_object();
    $billno = $bill->bill;
    $carti = $obj->my_select("tbl_cart",NULL,array("registration_id"=>$user));
    
    while($cart = $carti->fetch_object())
    {
        $ww['bill_id'] = $billno;
        $ww['product_id'] = $cart->product_id;
        $ww['qty'] = $cart->qty;
        $ww['discount'] = $cart->discount;
        $ww['growse_price'] = $cart->growse_price;
        $ww['final_price'] = $cart->final_price;
        
        $ins = $obj->my_insert("tbl_transaction", $ww);
        
        $qq = $cart->qty;
        $id = $cart->product_image_id;
        $aa = $obj->my_query("UPDATE tbl_product_image SET qty = qty - $qq  WHERE product_image_id = $id");
        
    }
    $where['registration_id'] = $_SESSION['user'];
    
    $del = $obj->my_delete("tbl_cart", $where);
    
    unset($_SESSION['address']);
    unset($_SESSION['promo']);
    unset($_SESSION['final']);
    
    if($_SESSION['paymode'] == "Credit Card/Debit Card")
    {
        unset($_SESSION['paymode']);
        header('location:https://www.payumoney.com');
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
                                <li style="color: #FF4500"><span>Confirm Order</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section>
                    <div style="margin: 50px 75px 30px 75px">    
                    <div>
                        <div><center><i style="color: green; font-size: 60px" class="fa fa-check-square-o"></i></center></div>
                        <?php
                            $nm = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();
                        ?>
                        <div><center><h3 style="color: #FF4500; font-weight: bold">Hello, <a href=""><?php echo $nm->user_name; ?>.</a> Thank you for your order.</h3></center></div>
                        <div><center><h4>HappyMoment received your order successfully.</h4></center></div>
                        <div><center><h5>Note that if you have any query then contact us via email.</h5></center></div>
                    </div>
                    <br/>
                    <hr/>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-md-offset-1">
                            <h4 style="color: #FF4500; font-weight: bold">Payable Amount </h4><h4> ₹ <?php echo $price; ?> /-</h4>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <h4 style="color: #FF4500; font-weight: bold">Estimated Delivery in </h4><h4> 4-5 Days</h4>
                        </div>
                        <div class="col-sm-12 col-md-2">
                            <h4 style="color: #FF4500; font-weight: bold">Payment Mode </h4><h4><?php echo $paymode; ?></h4>
                        </div>
                    </div>
                    <hr/>
                    <div>
                        <div style="text-align: right">
                            <a href="index.php" class="btn btn-button global-bg white">Continue Shopping</a>
                            <a href="user/dashboard.php" class="btn btn-button global-bg white">View Bill</a>
                            <a href="user/dashboard.php" class="btn btn-button global-bg white">Go to Account</a>
                        </div>
                    </div>
                    <hr/>
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
                   
               })
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