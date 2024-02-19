<?php
require_once './connection.php';

$obj = new model();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Products | HappyMoment</title>
        <meta name="keywords" content="business, ecommerce, ecommerce psd, fashion, online shopping, shopping">
        <meta name="description" content="Prallax-Multipurpose eCommerce html Template is a the best design for shopping 2016. any kinds of Store eCommerce theme Based on Bootstrap, 12 column Responsive grid Template. “Prallax” is a smooth and colorful E-commerce html Template, perfect suitable for , clothing or fashion e-commerce online shop / store websites. It includes everything you need for the website development such as eCommerce online store .PSD files are well organized also you can customize very easy . we have include 24 html file for you">
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <?php
    if(isset($_GET['id']))
    {
        $data = "main=".$_GET['id'];
        if(isset($_GET['sub']))
        {
            $data .= "&sub=".$_GET['sub'];
        }
        if(isset($_GET['peta']))
        {
            $data .= "&peta[0]=".$_GET['peta'];
        }
    }
    ?>
    <body onload="load_pro('<?php echo $data; ?>');">
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
                                <li><a href="index.php"><span ><span>Home</span></span></a></li>
                                <li style="color: #FF4500"><span>Products</span></li>
                            </ul>
                        </div>
                    </div>
                </section>
                <form method="post" id="filter-form">
                <section class="main-page container">
                    <div class="main-container col2-left-layout">
                        <div class="main">
                            <div class="row">
                                <?php
                                    require_once 'filterbar.php';
                                ?>
                                <aside class=" col-sm-8 col-md-9 col-lg-9" style="margin-top: -40px">
                                    <div class="col-main">
                                        <div class="category-products padding-45">
                                            <?php
                                            require_once './sortbar.php';
                                            ?>
                                            <div class="product-container padding-30" id="filter-data">
                                                
                                            </div>
                                            
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>
                    </div>
                </section>
                    </form>
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
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $(function () {
                    $("#slider-range").slider({
                        range: true,
                        min: 0,
                        max: 500,
                        values: [50, 450],
                        slide: function (event, ui) {
                            $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                        }
                    });
                    $("#amount").val("$" + $("#slider-range").slider("values", 0) +
                            " - $" + $("#slider-range").slider("values", 1));
                });
                /*  select  menu */
                $(function () {
                    $(".selector1").selectmenu();
                });
            });
        </script>
    </body>
</html>