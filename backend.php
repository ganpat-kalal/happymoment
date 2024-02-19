<?php
require_once './connection.php';
$obj = new model();
$action = $_POST['action'];
$id = $_POST['id'];
//print_r($_POST);


if($action == "main_search")
{
    $val = $_POST[id];
    $prod = $obj->my_query("SELECT * FROM tbl_product WHERE product_name like '%$val%' AND status = 1 LIMIT 0,10");
    ?>
    <ul>
        <?php
            while($pro = $prod->fetch_object())
            {
        ?>
        <li><i class="fa fa-search" style="color: black">&nbsp;&nbsp;&nbsp;</i><a href="productdetail.php?id=<?php echo $pro->product_id; ?>" ><?php echo $pro->product_name; ?></a></li>
        <?php
            }
            $prod = $obj->my_query("SELECT COUNT(product_id) as pr from tbl_product where product_name like '%$val%' AND status = 1")->fetch_object()->pr;
            if($prod > 8)
            {
        ?>    
        <li><i class="fa fa-search" style="color: black">&nbsp;&nbsp;&nbsp;</i><a href="searchresult.php?action=search&value=<?php echo $val; ?>" style="color: black">View all of related search</a></li>
        <?php
            }
            if($prod == 0)
            {
        ?>
                <li><i class="fa fa-search" style="color: black">&nbsp;&nbsp;&nbsp;</i><a href="" style="color: black">No Result Found</a></li>
        <?php
            }
        ?>
    </ul>
<?php
} 

if ($action == "pro") {
    //print_r($_POST);

    $q = "SELECT * FROM `tbl_product` as pro,tbl_category peta,tbl_category as sub, tbl_category as main WHERE pro.category_id = peta.category_id AND sub.category_id = peta.parent_id AND main.category_id = sub.parent_id AND pro.status = 1 ";

    if (isset($_POST['main'])) {
        $q .= " AND main.category_id = $_POST[main] ";
    }
    if (isset($_POST['sub'])) {
        $q .= " AND sub.category_id = $_POST[sub] ";
    }
    if (isset($_POST['peta'])) {
        $q .= " AND peta.category_id IN (" . implode(",", $_POST['peta']) . ") ";
    }
    if (isset($_POST['values1'])) {
        $q .= " AND pro.product_id IN (SELECT product_id FROM `tbl_attribute_value` WHERE value IN ('" . implode("','", $_POST['values1']) . "'))";
    }
    if (isset($_POST['values2'])) {
        $q .= " AND pro.product_id IN (SELECT product_id FROM `tbl_attribute_value` WHERE value IN ('" . implode("','", $_POST['values2']) . "'))";
    }
    if (isset($_POST['price'])) {
        $q .= " AND $_POST[price]";
    }
    if (isset($_POST['limit'])) {
        $q.= " LIMIT $_POST[limit],3";
    } else {
        $q.= " LIMIT 0,9";
    }
    //$q.= " ORDER BY RAND()";
    //echo $q;
    ?>
    <div id="products-grid">
        <ul class="products-grid row medium-products">
            <!-- item -->
            <?php
            $product = $obj->my_query($q);
            while ($pro = $product->fetch_object()) {
                ?>
                <li class="col-xs-2 col-sm-2 col-md-4 col-lg-4">
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
                                <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
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
    </div>
    <div id="products-list" style="display: none;">
        <ol class="list-product">
            <!-- item -->
            <?php
            $product = $obj->my_query($q);
            while ($pro = $product->fetch_object()) {
                ?>
                <li class="item  row">
                    <!-- image -->
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
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
                        <div class="list-product-img">
                            <?php
                            $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pro->product_id))->fetch_object();

                            $imgarr = explode(",", $img->path);
                            ?>
                            <a href="productdetail.php?id=<?php echo $pro->product_id; ?>" title="<?php $pro->name; ?>"> 
                                <img src="seller/<?php echo $imgarr[0]; ?>" style="height: 270px"/>
                            </a>
                        </div>
                    </div>
                    <!-- / images -->
                    <!-- content -->
                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                        <div class="list-product-content">
                            <div class="list-product-content-inner">
                                <div class="product-lint-name"><a href="productdetail.php?id=<?php echo $pro->product_id; ?>"><?php echo $pro->product_name; ?></a></div>
                                <div class="ratting-box">
                                    <div class="ratting-box">
                                        <?php
                                        $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $pro->product_id")->fetch_object()->rt;
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
                                                $crt = $obj->my_query("SELECT COUNT(*) as rt FROM `tbl_rating` WHERE product_id = $pro->product_id ")->fetch_object()->rt;
                                                //echo $crt;
                                                ?>
                                                <li><?php echo $crt; ?> Rating </li>
                                            </ul>
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
                                        <span class="new-price" style="color: orangered">₹ <?php echo $nett; ?> /-</span>
                                        <span class="old-price" style="color: orangered">₹ <?php echo $net; ?> /-</span>
                                        <?php
                                    } else {
                                        ?>
                                        <span class="new-price" style="color: orangered">₹ <?php echo $net; ?> /-</span>
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
                                <div class="product-discription" style="margin-top: -15px;height: 60px">
                                    <p><?php echo substr($pro->description, 0, 200) ?>....</p>
                                </div>
                                <div class="add-to-cart">
                                    <?php
                                    $wished = $obj->count_record("tbl_wishlist", array("product_id" => $pro->product_id, "registration_id" => $_SESSION['user']));
                                    if ($wished == 0) {
                                        ?>
                                        <div id="wish<?php echo $pro->product_id; ?>" style="float: left">
                                            <button class="btn btn-button white Pink-color-bg" title="Add in Wishlist" id="status<?php echo $pro->product_id; ?>" onclick="add_wish(<?php echo $pro->product_id; ?>)" style="background: black; width: 160px;"><i class="fa fa-heart"></i>Add to Wishlist</button>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div style="float: left">
                                            <button class="btn btn-button white Pink-color-bg" style="width: 170px;color: white" title="Added in Wishlist"><i class="fa fa-heart" style="color: white"></i>Added to Wishlist</button>
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
                                            <button class="btn btn-button white Pink-color-bg" id="stat<?php echo $pro->product_id; ?>" onclick="add_cart(<?php echo $pro->product_id; ?>)" style="background: black" title="Add to Cart"><i class="fa fa-shopping-cart"></i>Add to Cart</button>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div style="float: left">
                                            <button class="btn btn-button white Pink-color-bg" title="Added in Cart"><i class="fa fa-shopping-cart"></i>Added to Cart</button>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / content -->
                </li>
                <?php
            }
            ?>
        </ol>
    </div>
    <?php
    if ($product->num_rows != 0) 
    {
        if (isset($_POST['limit'])) 
        {
            if ($product->num_rows < 3) 
            {
                
            } 
            else 
            {
            ?>
                <center id="read_more"><button type="button" class="btn btn-button global-bg white" onclick="view_more();">View more  <i class="fa fa-align-justify"></i></button></center>
            <?php
            }
        } 
        else 
        {
            if ($product->num_rows < 9) 
            {
                
            } 
            else 
            {
            ?>
                <center id="read_more"><button type="button" class="btn btn-button global-bg white" onclick="view_more();">View more  <i class="fa fa-align-justify"></i></button></center>
            <?php
            }
        }
    }
}

if ($action == "promo") {
    //echo $_POST['id'];
    $_SESSION['promo'] = $_POST['id'];
    ?>
    <div>
        <a href="#" ><b>Have any Promocode ?</b></a>
    </div>
    <?php
    $amount = $_SESSION['final'];
    $promocode = $obj->my_query("SELECT * from tbl_promocode WHERE status = 1 AND min_bill_price < $amount");
    while ($promo = $promocode->fetch_object()) {
        if ($promo->promocode_id == $_SESSION['promo']) {
            ?>
            <div class="radio">
                <label style="font-size: 18px; color: orangered"><input checked="" type="radio" value="code" name="code"><?php echo $promo->code; ?></label>
                <p style="font-size: 12px">(₹ <?php echo $promo->amount; ?> will deduct from Total Amount by using this <?php echo $promo->code; ?> code.)</p>
            </div>
            <?php
        } else {
            ?>
            <div class="radio">
                <label style="font-size: 18px; color: orangered"><input onclick="promo(<?php echo $promo->promocode_id; ?>)" type="radio" value="code" name="code"><?php echo $promo->code; ?></label>
                <p style="font-size: 12px">(₹ <?php echo $promo->amount; ?> will deduct from Total Amount by using this <?php echo $promo->code; ?> code.)</p>
            </div>
            <?php
        }
    }
    $am = $obj->my_select("tbl_promocode", NULL, array("promocode_id" => $_SESSION['promo']))->fetch_object();
    $amo = $am->amount;
    $cart = $obj->my_select("tbl_cart", NULL, array("registration_id" => $_SESSION['user']));
    while ($ca = $cart->fetch_object()) {
        $qty = $ca->qty;
        $price = $ca->final_price;
        $totamount = $qty * $price;
        $totalamount += $totamount;
    }
    $_SESSION['final'] = $totalamount - $amo;
    $pro = $obj->my_select("tbl_promocode", NULL, array("promocode_id" => $_SESSION['promo']))->fetch_object();
    ?>
    <br/>
    <p style="color: green"><?php echo $pro->code; ?> applied successfully.</p>
    <p style="color: green; font-size: 12px">(₹ <?php echo $pro->amount; ?> is deducted from your Total Amount.)</p>
    <div style="text-align: right; margin-top: 60px">
        <button type="submit" class="btn btn-button global-bg white" >Proceed to Pay </button>
    </div>
    <?php
}

if ($action == "c_address") {
    $_SESSION['address'] = $_POST['id'];
    ?>
    <div><label> <b>SELECT ADDRESS</b></label></div>
    <?php
    $address = $obj->my_select("tbl_shipment", NULL, array("registration_id" => $_SESSION['user']));

    while ($add = $address->fetch_object()) {
        if ($add->shipment_id == $_SESSION['address']) {
            ?>
            <div class="col-sm-2 col-md-3 col-lg-3" style="background-color: #ddd; border: 1px solid orangered; margin: 20px;margin-right: 70px; min-height: 140px;">
                <button type="button" onclick="c_address(<?php echo $add->shipment_id; ?>)" style="background: transparent;padding: 11px;padding-top: 28px;border: none;"><?php echo $add->address ?><br/><br/><b style="color: rgba(0,128,0,0.5); font-size: 25px" class="fa fa-check-circle">Selected</b></button>
            </div>
            <?php
        } else {
            ?>
            <div class="col-sm-2 col-md-3 col-lg-3" style="background-color: #ddd; border: 1px solid orangered; margin: 20px;margin-right: 70px; min-height: 140px;">
                <button type="button" onclick="c_address(<?php echo $add->shipment_id; ?>)" style="background: transparent;padding: 11px;padding-top: 28px;border: none;"><?php echo $add->address; ?></button>
            </div>
            <?php
        }
    }
    ?>
    <?php
}

if ($action == "add_wish") {
    if (isset($_SESSION['user'])) {
        $w['product_id'] = $_POST['id'];
        $w['registration_id'] = $_SESSION['user'];

        $count = $obj->count_record("tbl_wishlist", $w);

        if ($count == 0) {
            echo $ans = $obj->my_insert("tbl_wishlist", $w);
        } else {
            echo "already added in wishlist!";
        }
    } else {
        echo "login";
    }
}

if ($action == "add_cart") {
    if (isset($_SESSION['user'])) {
        $w['product_id'] = $_POST['id'];
        $w['registration_id'] = $_SESSION['user'];

        $count = $obj->count_record("tbl_cart", $w);

        if ($count == 0) {
            $gp = $obj->my_select("tbl_product", NULL, array("product_id" => $_POST['id']))->fetch_object();

            $gprice = $gp->price;

            $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
            //print_r($profit);
            $prate = $profit->profit_rate;
            $rs = ($gprice * $prate) / 100;

            $net = $gprice + $rs;
            $net = round($net);

            if ($gp->offer_id != 0) {
                $offer = $obj->my_select("tbl_offer", NULL, array("offer_id" => $gp->offer_id))->fetch_object();
                $orate = $offer->rate;
                $ors = ($net * $orate) / 100;
                $onet = $net - $ors;
                $onet = round($onet);
            } else {
                $ors = 0;
                $onet = $net;
            }

            $w['growse_price'] = $net;
            $w['discount'] = $ors;
            $w['final_price'] = $onet;
            $w['qty'] = 1;
            //print_r($w);
            echo $ans = $obj->my_insert("tbl_cart", $w);
        } else {
            echo "already added in cart!";
        }
    } else {
        echo "login";
    }
}

if ($action == "remove_cart") {
    if ($_POST['id'] == 'all') {
        echo $obj->my_delete("tbl_cart", array("registration_id" => $_SESSION['user']));
    } else {
        $c_id['cart_id'] = $_POST['id'];
        echo $obj->my_delete("tbl_cart", $c_id);
    }
}

if ($action == "qty_change") {
    print_r($_POST);
    $qty = $_POST['qty'];
    $c_id = $_POST['id'];

    echo $upcart = $obj->my_update("tbl_cart", array("qty" => $qty), array("cart_id" => $c_id));
}

if ($action == "login") {

    $data['autho_id'] = $_POST['autho_id'];
    $data['autho_provider'] = $_POST['autho_provider'];

    $count = $obj->count_record("tbl_registration", $data);

    if ($count == 0) {

        $email_count = $obj->count_record("tbl_registration", array("email" => $_POST['email']));

        if ($email_count == 0) {
            $data['user_name'] = $_POST['user_name'];
            $data['email'] = $_POST['email'];
            $data['profile'] = $_POST['profile'];

            $obj->my_insert("tbl_registration", $data);

            $user = $obj->my_select("tbl_registration", NULL, array("email" => $_POST['email'], "autho_id" => $_POST['autho_id']))->fetch_object();

            $_SESSION['user'] = $user->registration_id;
            $_SESSION['logintime'] = date('y-m-d h:i:s');

            echo "1";
        } else {
            echo "0";
        }
    } else {
        $user = $obj->my_select("tbl_registration", NULL, array("email" => $_POST['email'], "autho_id" => $_POST['autho_id']))->fetch_object();

        $_SESSION['user'] = $user->registration_id;
        $_SESSION['logintime'] = date('y-m-d h:i:s');

        echo "1";
    }
}
if ($action == "add_subscriber") {
    //echo $id;

    $c = $obj->count_record("tbl_email_subscribers", array("email" => $id));

    if ($c == 0) 
    {
        $data['email'] = $id;

        $ans = $obj->my_insert("tbl_email_subscribers", $data);
        if($ans == 1)
        {
            echo "insert";
        }
    }
    else
        {
            echo "already";
        }
}

if ($action == "review_msg") {

    $y['product_id'] = $_POST['id'];
    $y['registration_id'] = $_SESSION['user'];
    $y['review'] = $_POST['value'];
    $y['status'] = 0;

    $ins = $obj->my_insert("tbl_review", $y);

    echo $ins;
}

if ($action == "img_preview") {
    $id = $_POST['id'];
    require_once './footersclink.php';
    ?>
    <div class="product-img-box resbaner">
        <?php
        $img = $obj->my_select("tbl_product_image", NULL, array("product_image_id" => $id))->fetch_object();

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
    <?php
}

if ($action == "cart_data") {
    ?>
    <section class="shopping-cart" id="cart_data">
        <div class="page-title margin-buttom-product"><span>cart Item</span><span style="float: right"><button onclick="remove_cart('all')" class="btn btn-button global-bg white">Remove All</button></span></div>
        <div class="shopping-content padding-30">
            <form method="post" action="#">
                <?php
                $count = $obj->count_record("tbl_cart", array("registration_id" => $_SESSION['user']));
                if ($count == 0) {
                    ?>
                    <div style="padding: 40px">
                        <center><i class="fa fa-shopping-bag" style="color: #ddd; font-size: 40px" ></i><br/><h1 style="color: #ddd">Sorry, Your cart is empty !</h1></center>
                    </div>
                    <?php
                } else {
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
                                $r_id = $_SESSION['user'];

                                $cart = $obj->my_select("tbl_cart", NULL, array("registration_id" => $r_id));
                                while ($ca = $cart->fetch_object()) {
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
                                            <input type="number" onchange="qty_change('<?php echo $ca->cart_id; ?>', this.value)" value="<?php echo $ca->qty; ?>" min="1" max="3" style="width: 80px; padding: 8px">                                      
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
            </form>
            <div class="buttons">
                <div class="float-right">
                    <a class="btn btn-button global-bg white" href="product.php">CONTINUE SHOPPING </a>
                    <a class="btn btn-button global-bg white" href="checkout.php">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </section>
    <?php
}

if ($action == "add_rate") {
    $rate = $obj->count_record("tbl_rating", array("registration_id" => $_SESSION['user'], "product_id" => $_POST['product']));
    //print_r($rate);

    if ($rate == 0) {
        $data['registration_id'] = $_SESSION['user'];
        $data['product_id'] = $_POST['product'];
        $data['rate'] = $_POST['rate'];

        echo $obj->my_insert("tbl_rating", $data);
    } else {
        $ww['registration_id'] = $_SESSION['user'];
        $ww['product_id'] = $_POST['product'];

        echo $obj->my_update("tbl_rating", array("rate" => $_POST['rate']), $ww);
    }
}

if ($action == "header_cart") {
    ?>
    <div class="header-cart-mini">
        <div class="topcart-mini-container">
            <div class="block-cart">
                <button class="dropdown-toggle" type="button">
                    <span class="fa fa-shopping-bag Pink-color-bg"></span>
                    <span class="cart-top-title"> My Cart</span>
                </button>
                <?php
                if (isset($_SESSION['user'])) {
                    ?>
                    <ul class="cart-product-list sfmenuffect">
                        <?php
                        $c = 1;
                        $obj = new model();
                        $r_id = $_SESSION['user'];
                        $cart = $obj->my_query("SELECT * from tbl_cart WHERE registration_id =$r_id  ORDER BY product_id DESC");
                        $total = 0;

                        while ($ca = $cart->fetch_object()) {
                            if ($c <= 3) {
                                $c++;
                                $pr = $obj->my_select("tbl_product", NULL, array("product_id" => $ca->product_id))->fetch_object();
                                ?>
                                <li class="item cart-item">
                                    <?php
                                    $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $pr->product_id))->fetch_object();

                                    $imgarr = explode(",", $img->path);
                                    ?>
                                    <a href="#">
                                        <img src="seller/<?php echo $imgarr[0]; ?>" width="80px"/>
                                    </a>
                                    <div class="product-details">
                                        <div class="product-details-inner">
                                            <p class="product-name"><a href="#"><?php echo $pr->product_name; ?></a></p>
                                            <a href="#" title=""><span class="fa fa-remove"></span></a>
                                            <div class="ratting-box">
                                                <div class="rating">
                                                    <?php
                                                    $rating = $obj->my_query("SELECT AVG(rate) as rt from tbl_rating WHERE product_id = $pr->product_id")->fetch_object()->rt;
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
                                                $rs = ($pr->price * $profit->profit_rate) / 100;
                                                $net = $rs + $pr->price;
                                                $net = round($net);

                                                if ($pr->offer_id != 0) {
                                                    $rate = $obj->my_select("tbl_offer", NULL, array("offer_id" => $pr->offer_id))->fetch_object();
                                                    $rs = ($net * $rate->rate) / 100;
                                                    $nett = $net - $rs;
                                                    $nett = round($nett);
                                                    ?>
                                                    <span class="new-price" style="color: #FF4500">₹ <?php echo $nett; ?> /-</span>
                                                    <span class="old-price" style="color: #FF4500">₹ <?php echo $net; ?> /-</span>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <span class="new-price" style="color: #FF4500">₹ <?php echo $net; ?> /-</span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <?php
                                $total = $total + $net;
                            }
                        }
                        ?>
                        <li class="item cart-item">
                            <div class="top-subtotal">
                                <!-- <div class="sub-total">
                                    <label>Sub-Total:</label><span>$100.00</span>
                                </div>-->
                                <div class="cart-item-total">
                                    <label>Total:</label><span>₹ <?php echo $total; ?></span>
                                </div>
                                <div class="buttons">
                                    <div class="float-right">
                                        <a class="btn btn-button bunker-color-bg  white view" href="cart.php">View cart</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul class="cart-product-list sfmenuffect">
                        <li class="item cart-item">
                            <div style="padding: 40px">
                                <center><i class="fa fa-lock" style="color: #ddd; font-size: 30px" ></i><br/><h4 style="color: #ddd">Sorry, You are not logged in to see your cart !<br/>Please login..</h4></center>
                            </div>
                        </li>
                        <li class="item cart-item">
                            <div class="top-subtotal">
                                <div class="buttons">
                                    <div class="float-right">
                                        <a class="btn btn-button bunker-color-bg  white view" href="login.php">Login</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}
?>