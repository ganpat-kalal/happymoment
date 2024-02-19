<?php
require_once './connection.php';

$obj = new model();
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
                <div class="row">
                    <div class="col-md-9">
                        <figure class="slider-area">
                            <div class="slider-area-inner">
                                <div class="ajax_loading"><i class="fa fa-spinner fa-spin"></i></div>
                                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner" role="listbox">
                                        <?php
                                        $c = 0;
                                        $data = $obj->my_select("tbl_banner", NULL, array("status" => 1));
                                        while ($row = $data->fetch_object()) {
                                            $c++;
                                            if ($c == 1) {
                                                ?>
                                                <div class="item active">
                                                    <img src="<?php echo $row->path; ?>" style="height: 400px;width: 100%; padding: 10px">
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <div class="item">
                                                    <img src="<?php echo $row->path; ?>" style="height: 400px;width: 100%; padding: 10px">
                                                </div>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>

                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
<!--                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>-->
                                    </a>
                                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
<!--                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>-->
                                    </a>
                                </div>
                            </div>
                        </figure>
                    </div>


                    <div class="col-md-3" style="padding: 23px">
                        <div class="mhome-icons">
                            <br/>
                            <div class="row" style="margin: -25px">
                                <div class="col-md-6">
                                    <?php
                                    $main = $obj->my_select("tbl_category", NULL, array("name" => "Cake"))->fetch_object();
                                    ?>
                                    <a href="product.php?id=<?php echo $main->category_id; ?>">
                                        <img class="img-responsive img-rotate" src="image/cakes_icon.png">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $main = $obj->my_select("tbl_category", NULL, array("name" => "Gift"))->fetch_object();
                                    ?>
                                    <a href="product.php?id=<?php echo $main->category_id; ?>">
                                        <img class="img-responsive img-rotate" src="image/gifts_icon.png">
                                    </a>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <div class="row" style="margin: -25px">
                                <div class="col-md-6">
                                    <a href="product.php?id=91">
                                        <img class="img-responsive img-rotate" src="image/chocalate_icon.png">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $main = $obj->my_select("tbl_category", NULL, array("name" => "Combos"))->fetch_object();
                                    ?>
                                    <a href="product.php?id=<?php echo $main->category_id; ?>">
                                        <img class="img-responsive img-rotate" src="image/combo_icon.png">
                                    </a>
                                </div>
                            </div>
                            <br/>
                            <br/>
                            <br/>
                            <br/>
                            <div class="row" style="margin: -25px">
                                <div class="col-md-6">
                                    <?php
                                    $main = $obj->my_select("tbl_category", NULL, array("name" => "Flowers"))->fetch_object();
                                    ?>
                                    <a href="product.php?id=<?php echo $main->category_id; ?>">
                                        <img class="img-responsive img-rotate" src="image/flowers_icon.png">
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $main = $obj->my_select("tbl_category", NULL, array("name" => "Cake"))->fetch_object();
                                    ?>
                                    <a href="product.php?id=<?php echo $main->category_id; ?>">
                                        <img class="img-responsive img-rotate" src="image/sweets_icon.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="free-shipping padding-45">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 col-lg-3">
                            <div class="free-shgipping-box shipping-1 col-xs-top " style="height: 208px">
                                <div class="free-sp-icon-box-inner lagoon-blue-bg">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <div class="shipping-content">
                                    <h2 class="hadding-title  lagoon-blue-color"><span>Same Day Delivery</span></h2>
                                    <p>We collaborate with bakeries around the country to bring you the widest selection of cakes at your doorstep.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-3 col-lg-3 ">
                            <div class="free-shgipping-box shipping-2 " style="height: 208px">
                                <div class="free-sp-icon-box-inner Peel-bg">
                                    <i class="fa fa-recycle"></i>
                                </div>
                                <div class="shipping-content">
                                    <h2 class="hadding-title Peel-color"><span>Money Back !</span></h2>

                                    <p>Our no quibble money-back promise is simple. If you are not happy with the product, you will get your money back.</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-md-3 col-lg-3">
                            <div class="free-shgipping-box shipping-3" style="height: 208px">
                                <div class="free-sp-icon-box-inner lagoon-bg">
                                    <i class="fa fa-truck"></i>
                                </div>
                                <div class="shipping-content">
                                    <h2 class="hadding-title lagoon-color"><span>Free Home Delivery</span></h2>
                                    <p> With HappyMoment, enjoy free home delivery in all over India.</p>
                                </div>
                            </div>
                        </div>
                        <div class=" col-sm-6 col-md-3 col-lg-3">
                            <div class="free-shgipping-box shipping-4" style="height: 208px">
                                <div class="free-sp-icon-box-inner Pink-color-bg">
                                    <i class="fa fa-gift"></i>
                                </div>
                                <div class="shipping-content">
                                    <h2 class="hadding-title Pink-color"><span>Free Gift service</span></h2>

                                    <p>With our promise, We provide free gift service. We wrap your gift with not any extra charges.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="our-product-box padding-45">
                <div class="container">
                    <div class="tab-product">
                        <div class="tab-menu-box">
                            <!--  tab product title -->
                            <div class="ourproducts-heading product-heading">
                                <h2 class="no-margin">
                                    <span>Best Selling Products</span>
                                </h2>
                            </div>
                            <div class="tab-menu">
                                <ul role="tablist">
                                    <li class="active" role="presentation"><a data-toggle="tab" role="tab" href="#allproduct" aria-expanded="true"><span>All Product</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#cake" aria-expanded="false"><span>Cake</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#gift" aria-expanded="false"><span>Gift</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#flower" aria-expanded="false"><span>Flowers</span></a></li>
                                </ul>
                            </div>
                            <div class="tab-product-content">
                                <div class="tab-conten">
                                    <div id="allproduct" class="tab-pane fade in active " role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT * FROM tbl_product WHERE status = 1 ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="cake" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Cake' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="gift" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <!-- single item -->
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Gift' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="flower" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Flowers' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="promo-box1 padding-30">
                <div class="container">
                    <div class="promo1-inner">
                        <div class="promo1-inner1 row">
                            <div class="promo-item-3 promo-box col-md-4 sm-resize">
                                <a href="#"><img src="image/pic1.jpg" alt="" /></a>
                                <div class="ovrly"></div>
                            </div>
                            <div class="promo-item-4 promo-box col-md-4 sm-resize">
                                <img src="image/pic2.jpg" alt="" />
                                <div class="ovrly"></div>
                            </div>
                            <div class="promo-item-5 promo-box col-md-4 sm-resize">
                                <a href="#"><img src="image/pic3.jpg" alt="" /></a>
                                <div class="ovrly"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="our-product-box padding-45">
                <div class="container">
                    <div class="tab-product">
                        <div class="tab-menu-box">
                            <!--  tab product title -->
                            <div class="ourproducts-heading product-heading">
                                <h2 class="no-margin">
                                    <span>New Products</span>
                                </h2>
                            </div>
                            <div class="tab-menu">
                                <ul role="tablist">
                                    <li class="active" role="presentation"><a data-toggle="tab" role="tab" href="#allproducts" aria-expanded="true"><span>All Product</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#cakes" aria-expanded="false"><span>Cake</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#gifts" aria-expanded="false"><span>Gift</span></a></li>
                                    <li class="" role="presentation"><a data-toggle="tab" role="tab" href="#flowers" aria-expanded="false"><span>Flowers</span></a></li>
                                </ul>
                            </div>
                            <div class="tab-product-content">
                                <div class="tab-conten">
                                    <div id="allproducts" class="tab-pane fade in active " role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT * FROM tbl_product WHERE status = 1 ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="cakes" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Cake' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="gifts" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <!-- single item -->
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Gift' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                </div></div>
                                                            </div>
                                                            <div class="product-price">
                                                                <?php
                                                                $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <div id="flowers" class="tab-pane fade" role="tabpanel">
                                        <div class="our-product">
                                            <?php
                                            $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Flowers' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                                            while ($new = $newp->fetch_object()) {
                                                ?>
                                                <div class="product-item" style="width: 250px">
                                                    <?php
                                                    if ($new->offer_id != 0) {
                                                        $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                                        ?>
                                                        <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                                            <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                                            <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                                            <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <div class="product-item-img">
                                                        <?php
                                                        $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                                        $imgarr = explode(",", $img->path);
                                                        ?>
                                                        <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                                            <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                        </a>    
                                                        <!-- cart -->
                                                        <?php
                                                        $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($cart == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                        $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                                        if ($wished == 0) {
                                                            ?>
                                                            <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                                                <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                            <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                                            <div class="ratting-box">
                                                                <div class="rating">
                                                                    <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                                                $rs = ($new->price * $profit->profit_rate) / 100;
                                                                $net = $rs + $new->price;
                                                                $net = round($net);

                                                                if ($newp->offer_id != 0) {
                                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="bestsale-box padding-45">
                <div class="container">
                    <div class="bestsale-heading product-heading">
                        <h2 class="no-margin">
                            <span>Combo Packages</span>
                        </h2>
                    </div>
                    <div class="bestsale-prodcuts product-container padding-30">
                        <?php
                        $newp = $obj->my_query("SELECT pro.* FROM `tbl_product` as pro, `tbl_category` as peta, `tbl_category` as sub, `tbl_category` as main WHERE peta.category_id = pro.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND main.name = 'Combos' AND pro.status = '1' ORDER BY RAND() LIMIT 0,10");

                        while ($new = $newp->fetch_object()) {
                            ?>
                            <div class="product-item" style="width: 250px">
                                <?php
                                if ($new->offer_id != 0) {
                                    $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
                                    ?>
                                    <div style="margin-bottom: -70px;position: absolute;z-index: 99;">
                                        <img src="image/small_checkboard.png"  style="width: 70px !important;" />
                                        <p style="font-size: 13px; font-weight: bold; margin-top: -54px;margin-left: 23px;position: absolute;color: #fff;"><?php echo $takka->rate; ?>%</p>
                                        <p style="font-size: 13px; font-weight: bold;margin-top: -38px;margin-left: 23px;position: absolute;color: #fff;">OFF</p>
                                    </div>
                                    <?php
                                }
                                ?>
                                <div class="product-item-img">
                                    <?php
                                    $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $new->product_id))->fetch_object();

                                    $imgarr = explode(",", $img->path);
                                    ?>
                                    <a href="productdetail.php?id=<?php echo $new->product_id; ?>" title="<?php $new->name; ?>"> 
                                        <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                    </a>    
                                    <!-- cart -->
                                    <?php
                                    $cart = $obj->count_record("tbl_cart", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                    if ($cart == 0) {
                                        ?>
                                        <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                            <button title="Add To Cart" id="stat<?php echo $new->product_id; ?>" onclick="add_cart(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                    $wished = $obj->count_record("tbl_wishlist", array("product_id" => $new->product_id, "registration_id" => $_SESSION['user']));
                                    if ($wished == 0) {
                                        ?>
                                        <div class="hover-box" id="wish<?php echo $new->product_id; ?>">
                                            <button title="Wishlist" id="status<?php echo $new->product_id; ?>" onclick="add_wish(<?php echo $new->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                        <div class="product-name"><a href="productdetail.php?id=<?php echo $new->product_id; ?>"><?php echo $new->product_name; ?></a></div>
                                        <div class="ratting-box">
                                            <div class="rating">
                                                <?php
                                                                $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $new->product_id")->fetch_object()->rt;
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
                                            $rs = ($new->price * $profit->profit_rate) / 100;
                                            $net = $rs + $new->price;
                                            $net = round($net);

                                            if ($newp->offer_id != 0) {
                                                $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $new->offer_id))->fetch_object();
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
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </section>
            <div class="promobanner2 padding-30">
                <div class="pormo2 promo-box promo2-item1">
                    <img src="image/gift1.jpg" alt="" style="height: 382px;">
                    <div class="ovrly"></div>
                    <a href="#" class="promo2-button no-bg-button"><b style="color: orangered">SHOP NOW</b></a>
                </div>
                <div class="pormo2 promo-box  promo2-item2">
                    <img src="image/cake.jpg" alt="" style="height: 382px">
                    <div class="ovrly"></div>
                    <a href="#" class="promo2-button no-bg-button"><b style="color: orangered">SHOP NOW</b></a>
                </div>
            </div>

            <?php
            require_once 'sallerlogo.php';
            ?>

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