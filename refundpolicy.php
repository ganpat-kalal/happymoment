<?php
  
require_once './connection.php';

$obj = new model();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Refund Policy | HappyMoment</title>
        <meta name="keywords" content="business, ecommerce, ecommerce psd, fashion, online shopping, shopping">
        <meta name="description" content="Prallax-Multipurpose eCommerce html Template is a the best design for shopping 2016. any kinds of Store eCommerce theme Based on Bootstrap, 12 column Responsive grid Template. “Prallax” is a smooth and colorful E-commerce html Template, perfect suitable for , clothing or fashion e-commerce online shop / store websites. It includes everything you need for the website development such as eCommerce online store .PSD files are well organized also you can customize very easy . we have include 24 html file for you">
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body>

        <div class="wrapper">
            <div class="page">
                <header> <?php
                    require_once 'headline.php';
                    ?>
                    <?php
                    require_once 'header.php';
                    ?>
                    <?php
                    require_once 'menubar.php';
                    ?>
                    <section class="breadcrumb-area padding-30">
                        <div class="container">
                            <div class="breadcrumb breadcrumb-box">
                                <ul>
                                    <li><a href="index.php"><span><i class="fa fa-home" style="color:black;"></i></span></a></li> /
                                    <li style="color: #FF4500;"><span>Refund Policy</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section  class="main-page container">
                        <div class="main-container col2-left-layout">


                            

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Refund Policy</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify">When you buy products from HappyMoment, your purchase is covered by 7 day money back guarantee only in case of manufacturing defect. This refund policy is applicable only on non-perishable items. In case you come across a manufacturing defect and to request a refund, simply contact us with your purchase details within 7 days of your purchase. Please include your order number (sent to you via email after ordering) and tell us about your problem for refund - we take customer feedback very seriously and use it to constantly improve our products and quality of service. Refunds are being processed within 30 days period.</p><br>
                                </div>
                            </div>
                                  <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Cancellation Policy</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify">HappyMoment believes in helping its customers as far as possible, and has therefore a liberal cancellation policy. Under this policy:</p>
                                    <p style="text-align: justify">Cancellations will be considered only if the request is made within 24 hours of placing an order. However, the cancellation request will not be entertained if the orders have been communicated to the vendors/merchants and they have initiated the process of shipping them.</li>
                                    <p style="text-align: justify">There is no cancellation of orders placed under the Same Day Delivery category.</p>
                                    <p style="text-align: justify">No cancellations are entertained for those products that the (HappyMoment) marketing team has obtained on special occasions like Pongal, Diwali, Valentine's Day etc. These are limited occasion offers and therefore cancellations are not possible.</p>
                                    <p style="text-align: justify">HappyMoment does not accept cancellation requests for perishable items like flowers, eatables etc. In case you feel that the product received is not as shown on the site or as per your expectations, you must bring it to the notice of our customer service within 24 hours of receiving the product. The Customer Service Team after looking into your complaint will take an appropriate decision.</p>
                                    <p style="text-align: justify">In case of complaints regarding products that come with a warranty from manufacturers, please refer the issue to them.</p>
                                    <p style="text-align: justify">Cancellation charge will be 10% on product.</p><br/>

                                </div>
                            </div>


                        </div>
                        </div>
                        <br/>
                    </section>
                    <footer class="footer-area">
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