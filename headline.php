<?php
    $obj = new model();
?>
<div class="back-layer">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer">
            <center><div style="color: green; font-weight: bold; font-size: 30px">Thank You <i class="fa fa-smile-o" style="color: green;"></i></div></center>
            <?php
                $user = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();
            ?>
            <center><div style="color: orangered; font-weight: bold; font-size: 20px;">for your rating, <a href=""><?php echo $user->user_name; ?></a></div></center>
            <center><div style="color: orangered; font-weight: bold; font-size: 20px;">Have A Nice Day.</div></center>
            <center><button type="button" onclick="close_layer('back-layer');" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px;">Close </button></center>
        </div>
    </div>
</div>
<div class="back-layer2">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer">
            <center><i class="fa fa-cart-arrow-down" style="color: green;font-size: 50px"></i></center>
            <center><div style="color: orangered; font-weight: bold; font-size: 30px">Product added to Cart !</div></center>
            <hr/>
            <center><div style="color: black; font-weight: bold; font-size: 18px;">What do you want to do next ?</div></center>
            <button type="button" onclick="close_layer('back-layer2');" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px;margin-left: 120px;">Close </button><a href="cart.php" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px">View Cart</a>
        </div>
    </div>
</div>
<div class="back-layer3">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer">
            <center><i class="fa fa-heart-o" style="color: green;font-size: 50px"></i></center>
            <center><div style="color: orangered; font-weight: bold; font-size: 30px">Product added to Wishlist !</div></center>
            <hr/>
            <center><div style="color: black; font-weight: bold; font-size: 18px;">What do you want to do next ?</div></center>
            <button type="button" onclick="close_layer('back-layer3');" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px;margin-left: 120px;">Close </button><a href="user/mywishlist.php" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px">View Wishlist</a>
        </div>
    </div>
</div>
<div class="back-layer4">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer">
            <center><div style="color: green; font-weight: bold; font-size: 30px">Thank You <i class="fa fa-smile-o" style="color: green;"></i></div></center>
            <?php
                $user = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$_SESSION['user']))->fetch_object();
            ?>
            <center><div style="color: orangered; font-weight: bold; font-size: 20px;">for your review, <a href=""><?php echo $user->user_name; ?></a></div></center>
            <center><div style="color: orangered; font-weight: bold; font-size: 20px;">Have A Nice Day.</div></center>
            <center><button type="button" onclick="close_layer('back-layer4');" class="btn btn-button global-bg white" style="border-radius: 10px; margin: 10px;">Close </button></center>
        </div>
    </div>
</div>
<div class="back-layer5">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer" style="background: rgba(0,0,0,0);cursor: pointer" onclick="close_layer('back-layer5');">
            <center><div> <p style="color: white; font-weight: bold; font-size: 45px;margin-left: 130px; font-family: Brush Script MT; position: absolute">Thank You </p><img src="image/envelope.png" width="300px"/> </div></center>
            <center><div style="color: white; font-weight: bold; font-size: 9px;position: absolute;margin-top: -55px;margin-left: 133px;">YOU'VE BEEN ADDED <br/>TO OUR MAILING LIST SUCCESSFULLY,<a href=""><?php echo $user->user_name; ?></a></div></center>
            <center><div style="color: white; font-weight: bold; font-size: 9px;position: absolute;margin-top: -22px;margin-left: 175px;">HAVE A NICE DAY.</div></center>
        </div>
    </div>
</div>
<div class="back-layer6">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer" style="background: rgba(0,0,0,0);cursor: pointer" onclick="close_layer('back-layer6');">
            <center><div> <p style="color: white; font-weight: bold; font-size: 45px;margin-left: 170px; font-family: Brush Script MT; position: absolute">Sorry </p><img src="image/envelope.png" width="300px"/> </div></center>
            <center><div style="color: white; font-weight: bold; font-size: 12px;position: absolute;margin-top: -55px;margin-left: 145px;">PLEASE CHECK<br/> YOUR E-MAIL ADDRESS.<a href=""><?php echo $user->user_name; ?></a></div></center>
        </div>
    </div>
</div>
<div class="back-layer7">
    <div class="row">
        <div class="col-md-offset-4 col-md-4 top-layer" style="background: rgba(0,0,0,0);cursor: pointer" onclick="close_layer('back-layer7');">
            <center><div> <p style="color: white; font-weight: bold; font-size: 45px;margin-left: 170px; font-family: Brush Script MT; position: absolute;margin-top:10px">Great ! </p><img src="image/envelope.png" width="300px"/> </div></center>
            <center><div style="color: white; font-weight: bold; font-size: 12px;position: absolute;margin-top: -55px;margin-left: 123px;">YOU ARE <br/> ALREADY IN OUR MAILING LIST.<a href=""><?php echo $user->user_name; ?></a></div></center>
        </div>
    </div>
</div>
<div class="top-bar" style="background-color: #333; border-bottom: 3px solid #FF4500; border-top: 3px solid #FF4500">
    <div class="container" style="color: white">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-2">
                <div id="google_translate_element" style="margin: 8px;"></div>
                <script type="text/javascript">
                    function googleTranslateElementInit() 
                    {
                        new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE}, 'google_translate_element');
                    }
                </script>
                <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-3">
                <ul>
                    <li class="header-support" style="font-size: 12px;color: #FF4500;">
                    <marquee>Welcome to HappyMoment.</marquee>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-xs-12 col-md-7">
                <ul class="top-list pull-right">
                    <?php
                    if(isset($_SESSION['user']))
                    {
                    ?>
                    <li title="Logout"><a href="user/logout.php"><i class="fa fa-lock"></i> Logout</a>
                    <li title="Dashboard"><a href="user/dashboard.php"><i class="fa fa-dashboard"></i> My Profile</a>
                    <li title="Wishlist"><a href="user/mywishlist.php"><i class="fa fa-heart"></i> My WishList</a>
                    <li title="My Account"><a href="user/dashboard.php"><i class="fa fa-lock"></i> My Account</a>
                    <?php
                    }
                    else
                    {    
                    ?>
                    <li title="Login"><a href="login.php "><i class="fa fa-lock"></i> Login</a></li>
                    <li title="Registration"><a href="login.php"><i class="fa fa-user plus"></i> Registration</a></li>
                    <li title="Wishlist"><a href="login.php"><i class="fa fa-heart"></i> My WishList</a></li>
                    <li title="My Account"><a href="login.php"><i class="fa fa-lock"></i> My Account</a></li>
                    <?php
                    }
                    ?>
                    <li><a href="seller/index.php" style="color: white; "><b>Sell on HappyMoment ?</b></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>