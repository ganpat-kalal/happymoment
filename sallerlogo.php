<section class="brand-logo-area padding-45">
    <div class="container">
        <div class="blog-hadding product-heading">
            <h2 class="no-margin">
                <span>Brand Logo</span>
            </h2>
        </div>
        <div class="brand-logo-box padding-30" id="brand-logo">
            <?php
                $obj = new model();
                $slogo = $obj->my_select("tbl_seller");
                while($logo = $slogo->fetch_object())
                {
            ?>
            <div class="item single-brand">
                <a href="#"><img src="seller/<?php echo $logo->path; ?>"  style="width:100px; height: 100px" /></a>
            </div>
            <?php
                }
            ?>
<!--            <div class="item single-brand">
                <a href="#"><img src="assets/image/brand-logo/baran2.png" alt="brand logo" /></a>
            </div>
            <div class="item single-brand">
                <a href="#"><img src="assets/image/brand-logo/baran3.png" alt="brand logo" /></a>
            </div>
            <div class="item single-brand">
                <a href="#"><img src="assets/image/brand-logo/baran3.png" alt="brand logo" /></a>
            </div>
            <div class="item single-brand">
                <a href="#"><img src="assets/image/brand-logo/baran5.png" alt="brand logo" /></a>
            </div>
            <div class="item single-brand">
                <a href="#"><img src="assets/image/brand-logo/baran6.png" alt="brand logo" /></a>
            </div>-->
        </div>
    </div>
</section>