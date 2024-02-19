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
                                    <li style="color: #FF4500;"><span>Delivery Information</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section  class="main-page container">
                        <div class="main-container col2-left-layout">
                           <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Returns Policy</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify">There is no return policy , order once placed and received by the customer,guardian,security guard,reception cannot be returned back at what so ever may be the condition.</p><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Normal Delivery</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify">All Order are delivered between 11 am till 9 pm in normal delivery time.</p>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Morning Delivery</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify"> If customer requires the items to be delivered in morning then customer has to select the morning delivery in checkout , the order will be delivered anytime between 8 Am till 2 Pm.We request customer to take prior confirmation in written format before selecting the morning delivery.This service may not be available for address out of city limits or small B,C tier cities.</p>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div class="page-title"><span>Night Delivery</span></div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <p style="text-align: justify">If customer requires the items to be delivered in Night then customer has to select the Night delivery in checkout , the order will be delivered anytime between 9 Pm till 12 Am.We request customer to take prior confirmation in written format before selecting the Night delivery. This service may not be available for address out of city limits or small B,C tier cities.

                                    <p style="text-align: justify">Same day Night Order should be placed before 2 PM, orders not delivered due to any reasons will be delivered next day.</p>

<p style="text-align: justify">Exact Delivery timings are not guaranteed and will be delivered in respected time slot as selected by customer.</p>
                                    </div>
                            </div>

                        </div>
                        </section>
                        </div>
                        <br/>
                    
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