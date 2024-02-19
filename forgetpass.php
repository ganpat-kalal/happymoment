<?php
require_once './connection.php';
error_reporting(0);
$obj = new model();

if(isset($_POST['btn']))
{
    $count = $obj->count_record("tbl_registration", array("email"=>$_POST['email']));
    
    if($count == 1)
    {
        $data = $obj->my_select("tbl_registration",NULL,array("email"=>$_POST['email']))->fetch_object()->password;
        $pass = $obj->decrypt($data);
        
        $obj->sendmail($_POST['email'],"Password Recovery", $pass);
        
        $rr = "Your password succcessfully sent!";
        
    }
    else
    {
       $err = "E-mail address is Invalid or not registered with us.";  
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
                                <li><a href="login.php"><span> Login </span></a></li> /
                                
                                <li style="color: #FF4500;"><span>Forgot Password</span></li>
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
                                                        <div class="new-user-inner" style="min-height: 180px;">
                                                            <div class="new-user-content">
                                                                <span class="account-title">    Forget Password ?</span>
                                                                <br/><br/>
                                                                <div class="form-group">
                                                                    <label class="control-label">Email</label>
                                                                    <input type="text" name="email" data-bvalidator="required,email" placeholder="example@gmail.com" class="form-control">
                                                                    <br/>
                                                                    <?php
                                        if(isset($rr))
                                        {
                                    ?>
                                    <div class="alert alert-success" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <?php echo $rr; ?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                    <?php
                                        if(isset($err))
                                        {
                                    ?>
                                    <div class="alert alert-danger alert-dismissible" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <strong>Oops !<br/></strong> <?php echo $err; ?>
                                    </div>
                                    <?php
                                        }
                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="button-set">
                                                            <div style="width: 50%; float: left">
                                                                <a href="login.php" style="margin-left: 150px;width: 100px;" class="btn btn-button global-bg  white">Back</a>
                                                            </div>
                                                            <div class="pull-right" style="width: 50%">
                                                                <button type="submit" name="btn" class="btn btn-button global-bg  white">Send Mail</button>
                                                            </div>
                                                            <div style="clear: both"></div>
                                                            

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
                        alert(result);
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