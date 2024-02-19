<?php
require_once './connection.php';

$obj = new model();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Search Result | HappyMoment</title>
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
                                <li style="color: #FF4500"><span>Products</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <form method="post">
                    <section class="main-page container">
                        <div class="main-container col2-left-layout">
                            <div class="main">
                                <div class="row">
                                    <aside class=" col-sm-8 col-md-12 col-lg-12" style="margin-top: -40px">
                                        <ul class="products-grid row medium-products" style="margin-top: 45px">
                                            <!-- item -->
                                            <?php
                                            $v = $_GET['value'];
                                            if ($_GET['action'] == "search") {
                                                $product = $obj->my_query("SELECT * FROM tbl_product WHERE product_name LIKE '%$v%' AND status = 1");
                                            }
                                            if ($_GET['action'] == "tag") {
                                                $product = $obj->my_query("SELECT pro.* FROM tbl_product as pro, tbl_tag t WHERE t.product_id = pro.product_id AND t.tag LIKE '%$v%' AND pro.status = 1");
                                            }

                                            while ($pro = $product->fetch_object()) {
                                                ?>
                                                <li class="col-xs-2 col-sm-2 col-md-3 col-lg-3">
                                                    <?php
                                                    if ($pro->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $pro->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png" width="70px"  />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item" style="width: 250px">
                                                        <div class="product-item-img">
                                                            <?php
                                                            $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pro->product_id))->fetch_object();

                                                            $imgarr = explode(",", $img->path);
                                                            ?>
                                                            <a href="productdetail.php?id=<?php echo $pro->product_id; ?>" title="<?php $pro->name; ?>"> 
                                                                <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px; width: 248px"/>
                                                            </a>
                                                            <!-- cart -->
                                                            <?php
                                                            $cart = $obj->count_record("tbl_cart", array("product_id" => $pro->product_id, "registration_id" => $_SESSION['user']));
                                                            if ($cart == 0) {
                                                                ?>
                                                                <div class="hover-box" id="wish<?php echo $pro->product_id; ?>">
                                                                    <button title="Add To Cart" id="stat<?php echo $pro->product_id; ?>" onclick="add_cart(<?php echo $pro->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
                                                                </div>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div class="hover-box" style="padding-left: 5px">
                                                                    <button title="Carted" id="heart" style="background: red;" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg"  type="button"><i class="fa fa-shopping-basket"></i></button>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                            <!-- wishlist  -->
                                                            <?php
                                                            $wished = $obj->count_record("tbl_wishlist", array("product_id" => $pro->product_id, "registration_id" => $_SESSION['user']));
                                                            if ($wished == 0) {
                                                                ?>
                                                                <div class="hover-box" id="wish<?php echo $pro->product_id; ?>">
                                                                    <button title="Wishlist" id="status<?php echo $pro->product_id; ?>" onclick="add_wish(<?php echo $pro->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
                                                                </div>
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <div class="hover-box" style="padding-left: 5px">
                                                                    <button title="Wished" id="heart" style="background: red;" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="item-bottom">
                                                            <div class="item-content">
                                                                <div class="product-name"><a href="productdetail.php?id=<?php echo $pro->product_id; ?>"><?php echo $pro->product_name; ?></a></div>
                                                                <div class="ratting-box">
                                                                    <div class="rating">
                                                                        <?php
                                                                        $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $pro->product_id; ")->fetch_object()->rt;
                                                                        $rating = round($rating);
                                                                        ?>
                                                                        <div class="rating">
                                                                            <?php
                                                                            for ($i = 1; $i <= 5; $i++) {
                                                                                if ($i <= $rating) {
                                                                                    ?>
                                                                                    <span class="star active"></span>
                                                                                    <?php
                                                                                } else {
                                                                                    ?>
                                                                                    <span class="fa fa-star-o" style="color: grey"></span>
                                                                                    <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                        </div>    
                                                                    </div>
                                                                </div>
                                                                <div class="product-price">
                                                                    <?php
                                                                    $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                    $rs = ($pro->price * $profit->profit_rate) / 100;
                                                                    $net = $rs + $pro->price;
                                                                    $net = round($net);

                                                                    if ($pro->offer_id != 0) {
                                                                        $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $pro->offer_id))->fetch_object();
                                                                        $rs = ($net * $rate->rate) / 100;
                                                                        $nett = $net - $rs;
                                                                        $nett = round($nett);
                                                                        ?>
                                                                        <span class="new-price">₹ <?php echo $nett; ?> /-</span>
                                                                        <span class="old-price">₹ <?php echo $net; ?> /-</span>
                                                                        <?php
                                                                    } else {
                                                                        ?>
                                                                        <span class="new-price">₹ <?php echo $net; ?> /-</span>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                            <!-- / item -->
                                        </ul>
                                    </aside>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>
                <footer class = "footer-area padding-45">
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