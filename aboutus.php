<?php
  
require_once './connection.php';

$obj = new model();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>About Us | HappyMoment</title>
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
                                    <li style="color: #FF4500;"><span>About Us</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                    <section  class="main-page container">
                        <div class="main-container col2-left-layout">
                            <div class="main">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="page-title"><span>About Us</span></div>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-7 col-sm-12 col-xs-12">
                                        <p style="text-align: justify">Happy Moment having pioneered the concept of flowers and gifts in the country, today has become a driver of marketplace innovation and a contributor in local economies. The journey of HM, much like the flowers which are at the very heart of its business, has been an organic one. Started with a single store in 1994 in Surat, by the enterprising Mr. Ankit Nasit, the brand has established a new edge to the flower gifting culture in the country.</p>
                                        <p>With his determined efforts and desire to create an extraordinary brand, HM has grown with the core emphasis across portfolios on customer delight and constant aspiration to deliver exclusivity. Today, we lead the floral and gifting industry with 200 outlets in 85 cities, pan India. While the business opportunities are enormous, the commitment to our consumers and our associates is even greater. We take pride in our extensive network and novelty, in equal measure. HM is consciously foraying into small towns and every nook and corner of the country to mark its presence.</p>
                                    </div>
                                    <div class="col-md-5 col-sm-12 col-xs-12">
                                        <img src="assets/image/about-4.jpg" title="Create Happy Moment" class="img-responsive"></img>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <p style="text-align: justify">Today, Happy Moment encompasses of HM Retail & Franchising, HM E-commerce- India & UAE, HM Weddings & Events, Floral Touch-India & UAE, HM Select, The Flagship Store by Happy Moment, WDH (Wedding Design Hub), HM Gardens and GBM (giftsbymeeta.com). The brand provides solutions for everybody’s floral needs, be it buying flowers for occasions, floral décor for weddings, parties or just delivering fresh flowers not only in India but across the globe.</p>
                                        <p style="text-align: justify">Our specialization resides in online cake delivery in Bangalore, online cake delivery in Hyderabad and online flowers delivery in Bangalore. As cakes and flowers are synonym for any kind of celebration, our team put special efforts to make sure the timely, fresh and safe delivery of these products in entire Bangalore and Hyderabad. On top of that, we made it sure that customer always gets great quality cakes and flowers at a reasonable prices. Besides that, services like Capture the moment, midnight delivery, liberty to choose delivery date and time, gift wraps, and highly supportive customer support staff makes us stand apart.</p>
                                    </div>
                                </div>
                                <br/>
                                <div class="row">
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <h4>Vision</h4>
                                        <p style="text-align: justify">
                                            An idea is like a seed but when it gets planted, it becomes a vision…such is a story of Happy Moment. Mr Ankit Nasit, the mastermind behind the brand, had a vision. Starting its journey as a tiny little bud in 1994, Happy Moment was born. Today, it is the world’s largest floral chain, striving to become a name synonymous with flowers.</p>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <img src="assets/image/about-3.jpg" title="Create Happy Moment" class="fi img-responsive" ></img>
                                    </div>
                                    <div class="col-md-4 col-sm-12 col-xs-12">
                                        <h4>Mission</h4>
                                        <p style="text-align: justify">
                                            In a span of 21 years HM has achieved sky-scraping heights in the floral industry. It started its operations without any guidance and support. The brand works with a mission to become a case study in all the leading business schools. HM capitalizes on its strengths by embracing values like excellence, creative approach and customer satisfaction.</p>
                                    </div>
                                </div>
                                <br/>
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