<?php
require_once './connection.php';

$obj = new model();
$pro = $obj->my_select("tbl_product", NULL, array("product_id" => $_GET['id']))->fetch_object();


if (!isset($_GET['id'])) {
    header('location:product.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $pro->product_name; ?> | HappyMoment</title>
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
            </div>
            <section class="breadcrumb-area padding-30">
                <div class="container">
                    <div class="breadcrumb breadcrumb-box">
                        <ul>
                            <li><a href="index.php"><span ><span>Home</span></span></a></li>
                            <li><a href="product.php"><span><span>Products</span></span></a></li>
                            <li style="color: #FF4500"><span><?php echo $pro->product_name; ?></span></li>
                        </ul>
                    </div>
                </div>
            </section>
            <!--  product details area-->
            <section class="main-page container">
                <div class="main-container col1-layout">
                    <div class="main">
                        <div class="col-main">
                            <div class="product-view">
                                <div class="product-essential ">
                                    <div class="row">
                                        <!-- view product -->
                                        <div class="col-sm-5 col-md-4 col-lg-4" id="img-preview">
                                            <div class="product-img-box resbaner">
                                                <?php
                                                $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pro->product_id))->fetch_object();

                                                $imgarr = explode(",", $img->path);
                                                ?>
                                                <!-- big images -->
                                                <p class="product-view-img colorbox">
                                                    <img id="zoom_image" data-zoom-image="seller/<?php echo $imgarr[0]; ?>" style="height: 350px !important;" src="seller/<?php echo $imgarr[0]; ?>" />
                                                </p>
                                                <!-- / big images -->
                                                <!-- more views -->
                                                <div class="more-views">
                                                    <ul id="more" class="colorbox">
                                                        <?php
                                                        foreach ($imgarr as $value) {
                                                            ?>
                                                            <li>
                                                                <a data-image="seller/<?php echo $value; ?>" data-zoom-image="seller/<?php echo $value; ?>" class="elevatezoom-gallery colorbox">
                                                                    <img src="seller/<?php echo $value; ?>" alt="more views" width="85" style="height: 100px;" />
                                                                </a>
                                                            </li>
                                                            <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </div>
                                                <!-- / more views -->
                                            </div>
                                        </div>
                                        <!-- / view product -->
                                        <!-- product content -->
                                        <div class="col-sm-7 col-md-5 col-lg-5">
                                            <div class="product-shop">
                                                <div class="products-name">
                                                    <?php
                                                    $seller = $obj->my_select("tbl_seller", NULL, array("seller_id" => $pro->seller_id))->fetch_object();
                                                    ?>
                                                    <h1 style="font-size: 28px"> <?php echo $pro->product_name; ?> </h1>
                                                    <h5>Sold by :- <?php echo $seller->company_name; ?> </h5>
                                                </div>
                                                <div class="ratting-box">
                                                    <?php
                                                    $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $_GET[id]")->fetch_object()->rt;
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
                                                    <div class="product-review">
                                                        <ul>
                                                            <?php
                                                            $crt = $obj->my_query("SELECT COUNT(*) as rt FROM `tbl_rating` WHERE product_id = $_GET[id]")->fetch_object()->rt;
                                                            //echo $crt;
                                                            ?>
                                                            <li><?php echo $crt;   ?> Rating </li>
                                                            <li> | <a href="productdetail.php?id=<?php echo $_GET['id'] ?>#tab"> Add Your Review </a> </li>
                                                        </ul>
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
                                                        <span class="new-price" style="font-size: 25px; color: #FF4500">₹ <?php echo $nett; ?> /-</span>
                                                        <span class="old-price">₹ <?php echo $net; ?> /-</span>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <span class="new-price" style="font-size: 25px; color: #FF4500">₹ <?php echo $net; ?> /-</span>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <label>availability :</label>
                                                        <?php
                                                        if ($pro->stock_status == 0) {
                                                            ?>
                                                            <span class="editable instock" style="color: green">IN STOCK</span>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <span class="editable instock"style="color: red">OUT of STOCK</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </li>
                                                </ul>
                                                <br/>
<!--                                            <div class="list-unstyled">
                                                    <label style="float: left; padding-top: 5px;">Available Color :</label>
                                                   <?php
//                                                    $clr = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pro->product_id));
//                                                    while ($clrr = $clr->fetch_object()) {
                                                    ?>
                                                <div onclick="img_preview(<?php //echo $clrr->product_image_id;    ?>)" style="height: 30px;width: 30px; cursor: pointer; background:<?php //echo $clrr->value;    ?>; border:1px solid #ddd ;margin: 2px;float: left; margin-right: 10px;"></div>
                                                <?php
//                                                  }
                                                ?>
                                                <div style="clear: both;"></div>
                                                </div>-->
                                                <div class="product-discription" style="margin-top:-10px">
                                                    <div class="product-discription-title">Short Description:</div>
                                                    <p><?php echo substr($pro->description, 0, 200) ?></p>
                                                </div>
                                                <div class="add-to-cart">
                                                    <?php
                                                    $wished = $obj->count_record("tbl_wishlist", array("product_id" => $pro->product_id, "registration_id" => $_SESSION['user']));
                                                    if ($wished == 0) {
                                                        ?>
                                                        <div id="wish<?php echo $pro->product_id; ?>" style="float: left">
                                                            <button class="btn btn-button white Pink-color-bg" title="Add in Wishlist" id="status<?php echo $pro->product_id; ?>" onclick="add_wish(<?php echo $pro->product_id; ?>)" style="background: black; width: 160px;"><i class="fa fa-heart"></i>add to wishlist</button>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div style="float: left">
                                                            <button class="btn btn-button white Pink-color-bg" style="width: 170px;color: white" title="Added in Wishlist"><i class="fa fa-heart" style="color: white"></i>added to wishlist</button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                    <!-- cart -->
                                                    <?php
                                                    $cart = $obj->count_record("tbl_cart", array("product_id" => $pro->product_id, "registration_id" => $_SESSION['user']));
                                                    if ($cart == 0) {
                                                        ?>
                                                        <div id="wish<?php echo $pro->product_id; ?>" style="float: left">
                                                            <button class="btn btn-button white Pink-color-bg" id="stat<?php echo $pro->product_id; ?>" onclick="add_cart(<?php echo $pro->product_id; ?>)" style="background: black" title="Add to Cart"><i class="fa fa-shopping-cart"></i>add to cart</button>
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div style="float: left">
                                                            <button class="btn btn-button white Pink-color-bg" title="Added in Cart"><i class="fa fa-shopping-cart"></i>added to cart</button>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- / product content -->
                                        <div class="col-md-3 col-lg-3 hiden-sm">
                                            <!-- Top Rate Product -->
                                            <section class="toprate-box">
                                                <!-- product heading -->
                                                <div class="toprate-hadding product-heading">
                                                    <h2 class="no-margin">
                                                        <span class="text-bold">VIEW OTHER</span>
                                                    </h2>
                                                </div>
                                                <!-- / product heading -->
                                                <div class="toprate-product product-container padding-30">
                                                    <!-- single item -->
                                                    <?php
                                                    $p = $pro->category_id;
                                                    $product = $obj->my_query("SELECT * FROM tbl_product WHERE category_id = $p AND status = 1 AND product_id != $pro->product_id");
                                                    while ($related = $product->fetch_object()) {
                                                        ?>
                                                        <div class="product-item">
                                                            <?php
                                                            if ($related->offer_id != 0) {
                                                                $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $related->offer_id))->fetch_object();
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
                                                                $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $related->product_id))->fetch_object();

                                                                $imgarr = explode(",", $img->path);
                                                                ?>
                                                                <a href="productdetail.php?id=<?php echo $pro->product_id; ?>" title="<?php $related->name; ?>"> 
                                                                    <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                                </a>
                                                                <!-- cart -->
                                                                <?php
                                                                $cart = $obj->count_record("tbl_cart", array("product_id" => $related->product_id, "registration_id" => $_SESSION['user']));
                                                                if ($cart == 0) {
                                                                    ?>
                                                                    <div class="hover-box" id="wish<?php echo $related->product_id; ?>">
                                                                        <button title="Add To Cart" id="stat<?php echo $related->product_id; ?>" onclick="add_cart(<?php echo $related->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                                $wished = $obj->count_record("tbl_wishlist", array("product_id" => $related->product_id, "registration_id" => $_SESSION['user']));
                                                                if ($wished == 0) {
                                                                    ?>
                                                                    <div class="hover-box" id="wish<?php echo $related->product_id; ?>">
                                                                        <button title="Wishlist" id="status<?php echo $related->product_id; ?>" onclick="add_wish(<?php echo $related->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                                    <div class="product-name"><a href="productdetail.php?id=<?php echo $related->product_id; ?>"><?php echo $related->product_name; ?></a></div>
                                                                    <div class="ratting-box">
                                                                        <div class="rating">
                                                                            <?php
                                                                            $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $related->product_id")->fetch_object()->rt;
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
                                                                        $rs = ($related->price * $profit->profit_rate) / 100;
                                                                        $net = $rs + $related->price;
                                                                        $net = round($net);

                                                                        if ($related->offer_id != 0) {
                                                                            $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $related->offer_id))->fetch_object();
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
                                                <!-- / single item -->
                                            </section>
                                            <!-- / Top Rate Product -->
                                        </div>
                                    </div>
                                </div>

                                <div class="product-collateral row-fluid padding-45">
                                    <!-- tab -->
                                    <div class="row">
                                        <div class="col-md-9">
                                            <?php
                                            $prod = $obj->my_select("tbl_product", NULL, array("product_id" => $_GET['id']))->fetch_object();
                                            ?>
                                            <div class="single-product-tab" id='tab'>
                                                <ul class="nav nav-tabs" id="myTab">
                                                    <li class="active"><a data-target="#home" data-toggle="tab"><span>description</span></a></li>
                                                    <li><a data-target="#profile" data-toggle="tab"><span>Specification</span></a></li>
                                                    <?php
                                                    if (isset($_SESSION['user'])) {
                                                        ?>
                                                        <li><a data-target="#messages" data-toggle="tab"><span>review</span></a></li>
                                                        <li><a data-target="#rate" data-toggle="tab"><span>Rate</span></a></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li><a data-target="#tag" data-toggle="tab"><span>tags</span></a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="home">
                                                        <div class="single-product-description">
                                                            <p><?php echo $prod->description; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="profile">
                                                        <div class="spec-body specifications" itemprop="description">
                                                            <div class="detailssubbox">
                                                                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <table width="100%" border="0" cellspacing="2" cellpadding="0" class="product-spec">
                                                                                    <tbody>
                                                                                        <?php
                                                                                        $sub = $obj->my_select("tbl_category", NULL, array("category_id" => $prod->category_id))->fetch_object()->parent_id;
                                                                                        $attset = $obj->my_select("tbl_attribute_set", NULL, array("category_id" => $sub));
                                                                                        while ($set = $attset->fetch_object()) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <th colspan="2"><?php echo $set->set_name; ?></th>
                                                                                            </tr>
                                                                                            <?php
                                                                                            $attr = $obj->my_select("tbl_attribute", NULL, array("attribute_set_id" => $set->attribute_set_id));
                                                                                            while ($attrr = $attr->fetch_object()) {
                                                                                                ?>
                                                                                                <tr>
                                                                                                    <td width="20%"><?php echo $attrr->att_name; ?></td>
                                                                                                    <td>
                                                                                                        <?php
                                                                                                        $attv = $obj->my_select("tbl_attribute_value", NULL, array("product_id" => $prod->product_id, "attribute_id" => $attrr->attribute_id));
                                                                                                        if ($attv->num_rows != 0) {
                                                                                                            echo $attv->fetch_object()->value;
                                                                                                        }
                                                                                                        ?>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                        ?>
                                                                                    </tbody>
                                                                                </table>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="messages">
                                                        <div class="single-product-description">
                                                            <div class="comments-form">
                                                                <h3 class="block-title" style="font-size: 18px">Add a Review</h3>
                                                                <div class="form-group">
                                                                    <textarea id="review-msg" placeholder="Your review message" class="form-control" title="comments-form-comments" name="comments-form-comments" rows="6" style="resize: none"></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <button type="button" onclick="add_review(<?php echo $_GET['id']; ?>);" class="btn btn-button global-bg   white" id="submit">Review</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id="rate">
                                                        <div class="single-product-description">
                                                            <div class="comments-form">
                                                                <div class="form-group">
                                                                    <?php
                                                                    $us = $obj->my_select("tbl_registration", NULL, array("registration_id" => $_SESSION['user']))->fetch_object();
                                                                    if ($us->profile == "") 
                                                                    {
                                                                    ?>
                                                                        <center><img src="user/profile/a.jpg" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                                                    <?php
                                                                    } 
                                                                    else 
                                                                    {
                                                                        if ($us->autho_provider == "website") 
                                                                        {
                                                                        ?>
                                                                            <center><img src="user/<?php echo $us->profile; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                                                        <?php
                                                                        } 
                                                                        else 
                                                                        {
                                                                        ?>
                                                                            <center><img src="<?php echo $us->profile; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                                                        <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                                </div>

                                                                <div style="margin-left: 324px" class="addrate">
                                                                    <?php
                                                                    $alrt = $obj->my_select("tbl_rating",NULL,array("product_id"=>$_GET['id'],"registration_id"=>$_SESSION['user']))->fetch_object()->rate;
                                                                    
                                                                    for ($i = 1; $i <= 5; $i++) 
                                                                    {
                                                                        if($alrt < $i)
                                                                        {
                                                                    ?>
                                                                        <i class="fa fa-star-o" style="cursor: pointer;float:left;font-size: 30px;color: grey;margin: 2px"></i>
                                                                    <?php
                                                                        }
                                                                        else
                                                                        {
                                                                            ?>
                                                                            <i class="fa fa-star" style="cursor: pointer;float:left;font-size: 30px;color: grey;margin: 2px"></i>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    
                                                                    ?>
                                                                </div>

                                                                <div style="clear: both;"></div>
                                                                <br/>
                                                                <div class="form-group">
                                                                    <center><button type="button" id="rate-btn" class="btn btn-button global-bg   white" id="submit">Rate</button></center>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="tab-pane" id='tag'>
                                                        <?php
                                                        $tag = $obj->my_select("tbl_tag", NULL, array("product_id" => $_GET['id']))->fetch_object();

                                                        $tags = explode(",", $tag->tag);

                                                        foreach ($tags as $values) {
                                                            ?>
                                                        <a href="searchresult.php?action=tag&value=<?php echo $values; ?>">
                                                            <div style="margin: 8px; min-width: 80px;float: left; height: 30px; background: #ddd;padding-right: 6px;">
                                                                <i class="fa fa-tag" style="margin: 8px;color: orangered;"></i>&nbsp;<?php echo $values; ?> 
                                                            </div>
                                                        </a>    
                                                            <?php
                                                        }
                                                        ?>
                                                        <div style="clear: both">

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $coc = $obj->count_record("tbl_review", array("product_id" => $_GET['id'], "status" => 1));
                                        if ($coc != 0) {
                                            ?>
                                            <div class="col-md-3 col-lg-3 hiden-sm">
                                                <!-- Top Rate Product -->
                                                <section class="toprate-box">
                                                    <!-- product heading -->
                                                    <div class="toprate-hadding product-heading">
                                                        <h2 class="no-margin">
                                                            <span class="text-bold">People Says</span>
                                                        </h2>
                                                    </div>
                                                    <!-- / product heading -->


                                                    <div class="toprate-product product-container padding-30">
                                                        <!-- single item -->
                                                        <?php
                                                        $revv = $obj->my_select("tbl_review", NULL, array("product_id" => $_GET['id']));
                                                        while ($rev = $revv->fetch_object()) {
                                                            ?>
                                                            <div class="product-item" style="width: 259px;">
                                                                <div style="border: 1px solid #ddd; min-height: 150px">
                                                                    <a href="#" title="Profile">
                                                                        <?php
                                                                            $us = $obj->my_select("tbl_registration", NULL, array("registration_id" => $rev->registration_id))->fetch_object();
                                                                            //print_r($us);
                                                                            if ($us->profile == "") 
                                                                            {
                                                                            ?>
                                                                                <center><img src="user/profile/a.jpg" style="width: 150px;height: 150px;border-radius: 200px;border:2px solid #fff;padding: 20px;" /></center>
                                                                            <?php
                                                                            } 
                                                                            else 
                                                                            {
                                                                                if ($us->autho_provider == "website") 
                                                                                {
                                                                            ?>
                                                                                <center><img src="user/<?php echo $us->profile; ?>" style="width: 150px;height: 150px;border-radius: 200px;border:2px solid #fff;padding: 20px;" /></center>
                                                                                <?php
                                                                                } 
                                                                                else 
                                                                                {
                                                                                ?>
                                                                                <center><img src="<?php echo $us->profile; ?>" style="width: 150px;height: 150px;border-radius: 200px;border:2px solid #fff;padding: 20px;" /></center>
                                                                            <?php
                                                                                }
                                                                            }
                                                                            ?>
                                                                     </a>
                                                                    <div style="font-size: 15px;text-transform: capitalize;font-weight: bold;">
                                                                        <center style=" color: #FF4500">
                                                                            <?php 
                                                                                if($us->user_name == "")
                                                                                {   
                                                                                    echo $us->email;
                                                                                }
                                                                                else
                                                                                {
                                                                                    echo $us->user_name;
                                                                                } 
                                                                            ?>
                                                                        </center>
                                                                    </div>
                                                                    <div>
                                                                        <span style="color: black; display: inline ">
                                                                            <center><label style="font-size: 11px;color: black"><i class="fa fa-calendar" style="color: black"></i>&nbsp;<?php echo date('d-m-Y', strtotime($rev->date)); ?></label></center>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div class="item-content">
                                                                        <div style="color:white; min-height: 150px">" <?php echo $rev->review; ?> "</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </section>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>    

                                    <!-- recent product -->
                                    <?php
                                    if (isset($_SESSION['user'])) {
                                        $nm = $obj->my_select("tbl_registration", NULL, array("registration_id" => $_SESSION['user']))->fetch_object();
                                        ?>
                                        <section class="upsale-box padding-45">
                                            <!-- product heading -->
                                            <div class="upsale-hadding product-heading">
                                                <h2 class="no-margin">
                                                    <span>Recent View Products</span>
                                                </h2>
                                            </div>
                                            <!-- / product heading -->
                                            <div class="related-prodcuts medium-products product-container padding-30">
                                                <!-- single item -->
                                                <?php
                                                $user = $_SESSION['user'];

                                                $recent = $obj->my_query("SELECT * FROM tbl_recent_view WHERE registration_id = $user ORDER BY recent_view_id DESC");

                                                while ($rcn = $recent->fetch_object()) {
                                                    $product = $obj->my_select("tbl_product", NULL, array("product_id" => $rcn->product_id))->fetch_object();
                                                    ?>

                                                    <div class="product-item" style="width: 250px">
                                                        <?php
                                                        if ($product->offer_id != 0) {
                                                            $takka = $obj->my_select("tbl_offer", NULL, array("offer_id" => $product->offer_id))->fetch_object();
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
                                                            $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $product->product_id))->fetch_object();

                                                            $imgarr = explode(",", $img->path);
                                                            ?>
                                                            <a href="productdetail.php?id=<?php echo $product->product_id; ?>" title="<?php $product->name; ?>"> 
                                                                <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                                                            </a>    
                                                            <!-- cart -->
                                                            <?php
                                                            $cart = $obj->count_record("tbl_cart", array("product_id" => $product->product_id, "registration_id" => $_SESSION['user']));
                                                            if ($cart == 0) {
                                                                ?>
                                                                <div class="hover-box" id="wish<?php echo $product->product_id; ?>">
                                                                    <button title="Add To Cart" id="stat<?php echo $product->product_id; ?>" onclick="add_cart(<?php echo $product->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-search lagoon-blue-bg " type="button"><i class="fa fa-shopping-basket"></i></button>
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
                                                            $wished = $obj->count_record("tbl_wishlist", array("product_id" => $product->product_id, "registration_id" => $_SESSION['user']));
                                                            if ($wished == 0) {
                                                                ?>
                                                                <div class="hover-box" id="wish<?php echo $product->product_id; ?>">
                                                                    <button title="Wishlist" id="status<?php echo $product->product_id; ?>" onclick="add_wish(<?php echo $product->product_id; ?>)" data-placement="top" data-toggle="tooltip" class="btn btn-button button-wishlist lagoon-blue-bg"  type="button"><i class="fa fa-heart"></i></button>
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
                                                                <div class="product-name"><a href="productdetail.php?id=<?php echo $product->product_id; ?>"><?php echo $product->product_name; ?></a></div>
                                                                <div class="ratting-box">
                                                                    <div class="rating">
                                                                        <?php
                                                                        $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $product->product_id")->fetch_object()->rt;
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
                                                                    $rs = ($product->price * $profit->profit_rate) / 100;
                                                                    $net = $rs + $product->price;
                                                                    $net = round($net);

                                                                    if ($product->offer_id != 0) {
                                                                        $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $product->offer_id))->fetch_object();
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
                                        </section>
                                        <!-- / upsale products -->
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>
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
    <script  type="text/javascript">
        $(document).ready(function () {
            $(document).on("mouseenter", ".addrate i", function () {
                $idx = $(this).index() + 1;
                for ($i = 1; $i <= 5; $i++)
                {
                    if ($i <= $idx)
                    {
                        $(".addrate i:nth-child(" + $i + ")").removeClass("fa-star-o").addClass("fa-star");
                    } else
                    {
                        $(".addrate i:nth-child(" + $i + ")").removeClass("fa-star").addClass("fa-star-o");
                    }
                }
                //alert($idx); 
            });
            <?php
                if($alrt == "")
                {
            ?>
            var rate = 0;
            <?php
                }
                else
                {
            ?>
            var rate = <?php echo $alrt; ?>;
            <?php
                }
                ?>
            $(document).on("click", ".addrate i", function () {
                //alert();
                $idx = $(this).index() + 1;
                rate = $idx;
            });
            $(document).on("click", "#rate-btn", function () {
                //alert(rate);
                add_rate(<?php echo $_GET['id'] ?>, rate);
            });

            $(document).on("mouseleave", ".addrate i", function () {
                $idx = rate;
                for ($i = 1; $i <= 5; $i++)
                {
                    if ($i <= $idx)
                    {
                        $(".addrate i:nth-child(" + $i + ")").removeClass("fa-star-o").addClass("fa-star");
                    } else
                    {
                        $(".addrate i:nth-child(" + $i + ")").removeClass("fa-star").addClass("fa-star-o");
                    }
                }
                //alert($idx); 
            });
        });
        function add_rate(products, rates)
        {
            //alert();
            $data = {action: "add_rate", product: products, rate: rates};
            $.post("backend.php", $data, function (result)
            {
                //alert(result);
                if(result === '1')
                {
                    //alert(result);
                    $(document).ready(function ()
                    {
                        $(".back-layer").css("display","block");
                    });
                }
            });
        }
    </script>
</body>
</html>
<?php
if (isset($_SESSION['user'])) {
    $ch['registration_id'] = $_SESSION['user'];
    $ch['product_id'] = $_GET['id'];


    $count = $obj->count_record("tbl_recent_view", $ch);

    if ($count == 0) {
        $obj->my_insert("tbl_recent_view", $ch);
    }
}
?>