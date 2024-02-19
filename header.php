<div class="header-container white-bg">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-4  col-lg-4">
                <div class="logo">
                    <a href="index.php" title="logo"><img src="admin/img/logo3.jpg" width="220px" /></a>
                </div>
            </div>
            <div class="col-sm-4 col-md-4  col-lg-4" style="padding-top: 17px;">
                <div class="header-search">
                        <div class="form-search">
                            <input autocomplete="off" onkeyup="main_search();" id="transcript" class="form-control font-capitalize" type="text" placeholder="Enter your keyword...">
                            <button type="button" class="white bunker-color-bg" onclick="btn_search();">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                </div>
                <script type="text/javascript">
                    function btn_search()
                    {
                        var val = document.getElementById('transcript').value;
                        
                        window.location.href = "searchresult.php?action=search&value="+val;
                        
                    }
                </script>
                <div class="search">
                
            </div>
            </div>
            <div class=" col-sm-4 col-md-4 col-lg-4" style="padding-top: 17px;" id="header_cart">
                <div class="header-cart-mini">
                    <div class="topcart-mini-container">
                        <div class="block-cart">
                            <button class="dropdown-toggle" type="button">
                                <span class="fa fa-shopping-bag Pink-color-bg"></span>
                                <span class="cart-top-title"> My Cart</span>
                            </button>
                            <?php
                                if(isset($_SESSION['user']))
                                {
                            ?>
                            <ul class="cart-product-list sfmenuffect">
                                <?php
                                $c = 1;
                                $obj = new model();
                                $r_id = $_SESSION['user'];	
                                $cart = $obj->my_query("SELECT * from tbl_cart WHERE registration_id =$r_id  ORDER BY product_id DESC");
                                $total=0;

                                while ($ca = $cart->fetch_object()) 
                                {
                                    if ($c <= 3) 
                                    {
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
                                }
                                else
                                {
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
            </div>
        </div>
    </div>
</div>