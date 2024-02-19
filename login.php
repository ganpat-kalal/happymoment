<?php
require_once './connection.php';
error_reporting(0);
$obj = new model();

if (isset($_POST['btn'])) {

    $count = $obj->count_record("tbl_registration", array("email" => $_POST['email']));

    if ($count == 0) 
    {
        if(isset($_POST['t&c']))
        {
            $ans['autho_provider'] = "website";
            $ans['email'] = $_POST['email'];
            $ans['password'] = $obj->encrypt($_POST['password']);

            $aaa = $obj->my_insert("tbl_registration", $ans);

            $s = $obj->my_select("tbl_registration", NULL, array('email' => $_POST['email']))->fetch_object();

            $_SESSION['user'] = $s->registration_id;
            $_SESSION['lastlogin'] = date('Y-m-d h:i:s');

            header('location:user/dashboard.php');
        }
    } else {   //eroor
        $er = $_POST['email'] . " Already Exist.";
    }
}
if (isset($_POST['login'])) {
    $count = $obj->count_record("tbl_registration", array("email" => $_POST['email']));
    if ($count == 1) 
    {
        $user = $obj->my_select("tbl_registration", NULL, array("email" => $_POST['email']))->fetch_object();
        $rpass = $obj->decrypt($user->password);

        if ($_POST['password'] == $rpass) 
        {
            if(isset($_POST['saveps']))
            {
                setcookie("useremail", $_POST['email']);
                setcookie("userpassword", $rpass);
            }
            
            
            $_SESSION['user'] = $user->registration_id;
            $_SESSION['lastlogin'] = date('Y-m-d h:i:s');

            header('location:user/dashboard.php');
        } 
        else 
        {
            $rr = "Invalid Login !";
        }
    } else {
        $rr = "Invalid Login !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="google-signin-client_id" content="113086341902-n7idhdl61lhb3iu84mcqagqfob6uvgsv.apps.googleusercontent.com">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login & Register | HappyMoment</title>
        <meta name="keywords" content="business, ecommerce, ecommerce psd, fashion, online shopping, shopping">
        <meta name="description" content="Prallax-Multipurpose eCommerce html Template is a the best design for shopping 2016. any kinds of Store eCommerce theme Based on Bootstrap, 12 column Responsive grid Template. “Prallax” is a smooth and colorful E-commerce html Template, perfect suitable for , clothing or fashion e-commerce online shop / store websites. It includes everything you need for the website development such as eCommerce online store .PSD files are well organized also you can customize very easy . we have include 24 html file for you">
        <?php
        require_once 'headlink.php';
        ?>
        <script src="https://apis.google.com/js/platform.js" async defer></script>

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
                                <li><a href="index.php"><span><i class="fa fa-home" style="color:black;"></i></span></a></li> /
                                <li style="color: #FF4500;"><span>Login & Register</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <section class="main-page container">
                    <div class="main-container col1-layout">
                        <div class="main">
                            <div class="col-main">
                                <!--  login-->
                                <section class="account-login-area">

                                    <div class="login-area">

                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                                    <div class="new-user-box">
                                                        <div class="new-user-inner">
                                                            <div class="new-user-content">
                                                                <span class="account-title">CREATE AN ACCOUNT</span>
                                                                <br/><br/>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text" name="email" data-bvalidator="required,email" placeholder="example@gmail.com" class="form-control">
                                                                    <br/>
                                                                    <label class="control-label">Password</label>
                                                                    <input type="password" name="password" id="formlogin" data-bvalidator="required" placeholder="********" class="form-control">
                                                                    <br/>
                                                                    <label class="control-label">Retype Password</label>
                                                                    <input type="password" name="repassword" data-bvalidator="equalto[formlogin]" placeholder="********" class="form-control">
                                                                    <br/>
                                                                    <input type="checkbox" name="t&c" checked=""  >
                                                                    <label><a href="T&C.php">I agree to the Terms and Conditions.</a></label>
                                                                    <br/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="button-set">
                                                            <div class="pull-right">
                                                                <button name="btn" class="btn btn-button global-bg  white">Create</button>
                                                            </div>
                                                            <?php
                                                            if (isset($ans)) {
                                                                if ($ans == 1) {
                                                                    
                                                                } else {
                                                                    ?>
                                                                    <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;Something is Wrong. Try Again.</span>
                                                                    <?php
                                                                }
                                                            }
                                                            if (isset($er)) {
                                                                ?>    
                                                                <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $er; ?></span>
                                                                <?php
                                                            }
                                                            ?>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="col-sm-6 col-md-6 col-lg-6">
                                                <form class="comment-form respond-form" action="" method="post" id="myform1">
                                                    <div class="new-user-box">
                                                        <div class="new-user-inner">
                                                            <div class="new-user-content">
                                                                <span class="account-title">ALREADY REGISTERED?</span>
                                                                <br/>        
                                                                <br/>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="input-email">Email Address<span><em>*</em></span></label>
                                                                    <input type="text" name="email" value="<?php if(isset($_COOKIE['useremail'])){ echo $_COOKIE['useremail']; } ?>" data-bvalidator="required"  placeholder="E-Mail" id="input-email" class="form-control">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label" for="input-password">Password <span><em>*</em></span></label>
                                                                    <input type="password" data-bvalidator="required" name="password" value="<?php if(isset($_COOKIE['userpassword'])){ echo $_COOKIE['userpassword']; } ?>" placeholder="Password" id="input-password" class="form-control">
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <div class="form-group" style="margin: 0px;">
                                                                            <input type="checkbox" name="saveps" value="saveps" />
                                                                            <a href="#">Remember me</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 text-right">
                                                                        <a href="forgetpass.php" id="forgot" tabindex="4" name="fg_ps"> Forgot Password ? </a>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <hr/>
                                                                <br/>
                                                                <div class="row">
                                                                    <div id="google" class="col-md-6">
                                                                        <div id="google_btn"></div>
                                                                    </div>
                                                                    <div id="facebook" class="col-md-6">
                                                                        <img src="image/fb.jpg" width="207px" onclick="fblogin();">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="button-set">
                                                            <div class="pull-right">
                                                                <button name="login" class="btn btn-button global-bg  white">Login</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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
        <script>
            function onSuccess(googleUser)
            {
                $("#google").html("<center><img src='image/p.gif' width='20%' /></center>");
                var data = {
                    action: 'login',
                    autho_id: googleUser.getBasicProfile().getId(),
                    autho_provider: 'Google',
                    user_name: googleUser.getBasicProfile().getName(),
                    email: googleUser.getBasicProfile().getEmail(),
                    profile: googleUser.getBasicProfile().getImageUrl()
                };

                $.post('backend.php', data, function (result)
                {
                    //alert(result);
                    if (result === "1")
                    {
                        window.location.href = "user/dashboard.php";
                    } else
                    {
                        //alert(result);
                        $("#google").html("Email is Already Exits.");
                    }
                });

            }
            function onFailure(error)
            {
                console.log(error);
            }
            function renderButton()
            {
                gapi.signin2.render('google_btn', {
                    'scope': 'profile email',
                    'width': 200,
                    'height': 40,
                    'longtitle': true,
                    'theme': 'dark',
                    'onsuccess': onSuccess,
                    'onfailure': onFailure
                });
            }
        </script>

        <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>

        <!--   fb login    -->
        <script type="text/javascript">
            function fblogin()
            {
                //alert();
                FB.login(function (response)
                {
                    if (response.status === 'connected')
                    {
                        testAPI();
                    } else if (response.status === 'not_authorized')
                    {
                    } else
                    {
                    }
                }, {scope: 'public_profile,email'});
            }

            window.fbAsyncInit = function () {
                FB.init({
                    appId: '436044580065543',
                    cookie: true, // enable cookies to allow the server to access 
                    // the session
                    xfbml: true, // parse social plugins on this page
                    version: 'v2.8' // use graph api version 2.8
                });
            };

            // Load the SDK asynchronously
            (function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

            function testAPI() {
                FB.api('/me', {locale: 'en_US', fields: 'id,name,email'}, function (response) {
                    $("#facebook").html("<center><img src='image/p.gif' width='20%' /></center>");
                    var data = {
                        action: 'login',
                        autho_id: response.id,
                        autho_provider: 'Facebook',
                        user_name: response.name,
                        email: response.email,
                        profile: "http://graph.facebook.com/" + response.id + "/picture?type=normal"
                    };

                    $.post('backend.php', data, function (result)
                    {
                        //alert(result);
                        if (result === "1")
                        {
                            window.location.href = "user/dashboard.php";
                        } else
                        {
                            $("#facebook").html("Email is Already Exits.");
                        }
                    });
                    //document.getElementById("ans").innerHTML = response.id +" "+ response.name+" "+response.email;
                    //document.getElementById("img").innerHTML = "<img src='http://graph.facebook.com/" + response.id + "/picture?type=normal' />";
                });
            }
        </script>

    </body>
</html>