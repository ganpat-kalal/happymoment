<?php
require_once './connection.php';

$obj = new model();

if(isset($_POST['add']))
{
    $data['feedback_name']=$_POST['feedback_name'];
    $data['msg']=$_POST['msg'];
     
    $ans = $obj->my_insert("tbl_feedback", $data);
  
    if ($ans ==1) {
        $msg = '<div class="alert alert-success" role="alert">Record Insereted</div>';
    }
    else
    {
       $msg = '<div class="alert alert-danger" role="alert">Something wrong there</div>';
    }
}
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Feedback | HappyMoment</title>
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
                                    <li style="color: #FF4500;"><span>Feedback</span></li>
                                </ul>
                            </div>
                        </div>
                    </section>

                    <div class="contact-details marging-30">

                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-9">
                                <div class="contact-form">
                                    <div class="comment-respond">
                                        <div class="comment-respond-inner">
                                            <div class="hadding"><span>Put Your Suggestions</span></div>
                                            <form class="comment-form respond-form" action="" method="post" id="myform">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                                        <input type="text" value="" class="form-control border-radius" data-bvalidator="required,alpha" placeholder="Your Name" name="feedback_name" id="author">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                                        <div class="comment-form-comment">
                                                            <textarea rows="8" cols="40" name="msg" id="comment" data-bvalidator="required" placeholder="Comment" class="form-control border-radius"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-submit">
                                                    <div class="button-set padding-30">
                                                        <button  type="submit" name="add" class="btn btn-button global-bg white">Submit</button>
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
<?php
require_once 'footersclink.php';
?>
</body>
</html>