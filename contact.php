<?php
require_once './connection.php';

$obj = new model();

if (isset($_POST['add'])) {
    $data['contact_name'] = $_POST['contact_name'];
    $data['email'] = $_POST['email'];
    $data['msg'] = $_POST['msg'];

    $ans = $obj->my_insert("tbl_contact_us", $data);

    $title = "Someone Contact you from HappyMoment";
    $msg = "Following Person contact you,<br/><br/>Name : $_POST[contact_name]<br/>Email : $_POST[email]<br/>Message : $_POST[msg]<br/>";
    
    echo $send = $obj->mailer("novamaildemo55@gmail.com", "novamaildemo", "happymoment0000@gmail.com", $title, $msg);
    
    if ($ans == 1) {
        $msg = '<div class="alert alert-success" role="alert">Record Insereted</div>';
    } else {
        $msg = '<div class="alert alert-danger" role="alert">Something wrong there</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact Us | HappyMoment</title>
        <meta name="keywords" content="business, ecommerce, ecommerce psd, fashion, online shopping, shopping">
        <meta name="description" content="Prallax-Multipurpose eCommerce html Template is a the best design for shopping 2016. any kinds of Store eCommerce theme Based on Bootstrap, 12 column Responsive grid Template. “Prallax” is a smooth and colorful E-commerce html Template, perfect suitable for , clothing or fashion e-commerce online shop / store websites. It includes everything you need for the website development such as eCommerce online store .PSD files are well organized also you can customize very easy . we have include 24 html file for you">
        <?php
        require_once './headlink.php';
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
                <section class="main-page container">
                    <section class="breadcrumb-area padding-30">
                        <div class="container">
                            <div class="breadcrumb breadcrumb-box">
                                <ul>
                                    <li><a href="index.php"><span><i class="fa fa-home" style="color:black;"></i></span></a></li> /
                                    <li style="color: #FF4500;"><span>Contact Us</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <div class="contact-map padding-45">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.5018404138423!2d72.86310301467734!3d21.21193958589944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f0f0bdd738d%3A0x89ca505d93510beb!2sNova+One+Click+Solution!5e0!3m2!1sen!2sin!4v1486127651084" width="100%" height="450px" frameborder="0" style="border:0" allowfullscreen></iframe>
                        <div style='overflow:hidden;'>

                            <style type="text/css">
                                #gmap_canvas img {
                                    max-width: none!important;
                                    background: none!important
                                }
                            </style>
                        </div>
                        <script type='text/javascript'>
                            function init_map() {
                                var myOptions = {
                                    zoom: 10,
                                    center: new google.maps.LatLng(51.5073509, -0.12775829999998223),
                                    mapTypeId: google.maps.MapTypeId.ROADMAP
                                };
                                map = new google.maps.Map(document.getElementById('gmap_canvas'),
                                        myOptions);
                                marker = new google.maps.Marker({
                                    map: map,
                                    position: new google.maps.LatLng(51.5073509, -0.12775829999998223)
                                });
                                infowindow = new google.maps.InfoWindow({
                                    content: '<strong>Title</strong><br>London, United Kingdom<br>'
                                });
                                google.maps.event.addListener(marker, 'click', function ()) {
                                    infowindow.open(map, marker);
                                });
                                infowindow.open(map, marker);
                            }
                            google.maps.event.addDomListener(window, 'load', init_map);
                        </script>

                    </div>

                    <div class="contact-details marging-30">

                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="contact-form">
                                    <div class="comment-respond">
                                        <div class="comment-respond-inner">
                                            <div class="hadding"><span>Leave a Comment</span></div>
                                            <form class="comment-form respond-form" id="myform" action="" method="post">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                                        <input type="text" value="" class="form-control border-radius" placeholder="Your Name" name="contact_name" data-bvalidator="required,alpha" id="author" >
                                                    </div>
                                                    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 comment-form-email">
                                                        <input type="text" value="" class="form-control border-radius" placeholder="Email" name="email" id="email" data-bvalidator="required,email">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                                        <div class="comment-form-comment">
                                                            <textarea rows="8" cols="40" placeholder="Comment" name="msg" class="form-control border-radius" data-bvalidator="required"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-submit">
                                                    <div class="button-set padding-30">
                                                        <button  type="submit" class="btn btn-button global-bg white" name="add">Submit</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br/>
                                            <?php {
                                                ?>
                                            <div><?php echo $msg; ?></div>
                                             <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <div class="contact-box text-center">
                                    <div class="page-hadding product-hadding">
                                        <h2 class="no-margin">
                                            <span class="text-bold">Contact INFO</span>
                                        </h2>
                                    </div>
                                    <div class="contact-info">
                                        <div class="hotline contact-info-box">
                                            <i class="fa fa-tty contact-icon"></i>
                                            <span><strong>Hotline</strong></span>
                                            <ul>
                                                <li><i class="fa fa-phone"></i><span>Phone: +91 89806 05594</span></li>
                                                <li><i class="fa fa-phone"></i><span>Phone: +91 89802 80076</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="hotline contact-info-box">
                                            <i class="fa fa-envelope-o contact-icon"></i>
                                            <span><strong>email</strong></span>
                                            <ul>
                                                <li><i class="fa fa-envelope-o"></i><span>happymoment@gmail.com</span></li>

                                            </ul>
                                        </div>
                                    </div>
                                    <div class="contact-info">
                                        <div class="hotline contact-info-box">
                                            <i class="fa fa-map-marker contact-icon"></i>
                                            <span><strong>address</strong></span>
                                            <ul>
                                                <li><i class="fa fa-map-marker"></i><span>3rd Floor, Vrundavan Complex, Near Jantanagar Soc.,<br/>Rachana Circle,<br/>Varachha, Surat - 395006.</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
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
            <?php
            require_once 'footersclink.php';
            ?>


    </body>
</html>