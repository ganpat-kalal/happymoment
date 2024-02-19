<?php
require_once './connection.php';

$obj = new model();

if(!isset($_SESSION['user']))
{
    header('location:index.php');
}

if(isset($_POST['checkout']))
{
    $finalprice = $obj->my_select("tbl_cart",NULL,array("registration_id"=>$_SESSION['user']));
    
    while($final = $finalprice->fetch_object())
    {
        $qty = $final->qty;
        $price = $final->final_price;
        $totamount = $qty * $price;
        $totalamount +=  $totamount;
    }
    
    $_SESSION['final'] = $totalamount;
    header('location:checkout.php');
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
                            <li style="color: #FF4500"><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </section>
                <section class="main-page container" id="cart_data">
                    <div class="main-container col1-layout">
                        <div class="main">
                            <div class="col-main">
                                <!-- start shopping cart area-->
                                <section class="shopping-cart">
                                    <div class="page-title margin-buttom-product"><span>cart Item</span><span style="float: right"><button class="btn btn-button global-bg white" onclick="remove_cart('all')">Remove All</button></span></div>
                                    <div class="shopping-content padding-30">
                                        <form method="post" action="#">
                                            <?php
                                                $count = $obj->count_record("tbl_cart", array("registration_id"=>$_SESSION['user']));
                                                if($count == 0)
                                                {
                                                ?>
                                                    <div style="padding: 40px">
                                                        <center><i class="fa fa-shopping-bag" style="color: #ddd; font-size: 40px" ></i><br/><h1 style="color: #ddd">Sorry, Your cart is empty !</h1></center>
                                                    </div>
                                                <?php
                                                }
                                                else 
                                                {
                                            ?>
                                            <div class="table-responsive">
                                                <table class="cart-table data-table">
                                                   <!-- list -->
                                                    <thead>
                                                        <tr>
                                                            <th class="text-right">Remove</th>
                                                            <th class="text-center">No</th>
                                                            <th class="text-center">photo</th>
                                                            <th class="text-center">product</th>
                                                            <th class="text-right">Unit Price</th>
                                                            <th class="text-center">discount</th>
                                                            <th class="text-center">net price</th>
                                                            <th class="text-left">quantity</th>
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
                                                       
                                                       $cart = $obj->my_select("tbl_cart",NULL,array("registration_id"=>$r_id));
                                                       while($ca = $cart->fetch_object())                                                           
                                                       {
                                                           //print_r($ca);
                                                           $c++;
                                                           $pr = $obj->my_select("tbl_product", NULL, array("product_id" => $ca->product_id))->fetch_object();
                                                       ?>
                                                        <tr>
                                                            <td class="text-right">
                                                                <a onclick="remove_cart(<?php echo $ca->cart_id; ?>);"><i class="fa fa-remove" style="color: red; cursor: pointer"></i></a>
                                                            </td>
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

                                                                if ($pr->offer_id != 0) 
                                                                {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $pr->offer_id))->fetch_object();
                                                                    $rs = ($net * $rate->rate) / 100;
                                                                    $nett = $net - $rs;
                                                                    $nett = round($nett);
                                                                    ?>
                                                                    <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                    <td class="text-right">₹ <?php echo $rs; ?> /-</td>
                                                                    <td class="text-right">₹ <?php echo $nett; ?> /-</td>
                                                                    <?php
                                                                } 
                                                                else 
                                                                {
                                                                ?>
                                                                    <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                    <td class="text-right">₹ 00</td>
                                                                    <td class="text-right">₹ <?php echo $net; ?> /-</td>
                                                                <?php
                                                                }
                                                                ?>
                                                            <td class="text-left">
                                                                <input type="number" onchange="qty_change('<?php echo $ca->cart_id; ?>',this.value)" value="<?php echo $ca->qty; ?>" min="1" max="3" style="width: 80px; padding: 8px">                                      
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
                                                            <td class="text-right" colspan="8"><strong>Total Paybal Amount</strong></td>
                                                            <td class="text-center"><b>₹ <?php echo $totalprice; ?></b></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                            <?php
                                                }
                                            ?>
                                        
                                        <div class="buttons">
                                            <div class="float-right">
                                                <a class="btn btn-button global-bg white" href="product.php">CONTINUE SHOPPING </a>
                                                <button type="submit" name="checkout" class="btn btn-button global-bg white">PROCEED TO CHECKOUT</button>
                                            </div>
                                        </div>
                                            </form>
                                    </div>
                                </section>
                                <!-- / shopping cart area-->
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
    </body>


</html>