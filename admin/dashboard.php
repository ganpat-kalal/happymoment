<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body class="skin-coreplus">
        <?php
        require_once 'headline.php';
        ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php
            require_once 'sidebar.php';
            ?>
            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Dashboard
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li class="active">
                            Dashboard
                        </li>
                    </ol>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda" title="Member">
                            <div class="bogda-heding">
                                <h1>Member</h1>
                            </div>
                            <div class="bogda-counter" >
                                <h1 id="tot_member">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Seller">
                            <div class="bogda-heding">
                                <h1>Seller</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_seller">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Active Seller">
                            <div class="bogda-heding">
                                <h1>Active Seller</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_active">0</h1>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda"title="Total Product">
                            <div class="bogda-heding">
                                <h1>total product</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_pro">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Active Product">
                            <div class="bogda-heding">
                                <h1>active product</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_acpro">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="pending product">
                            <div class="bogda-heding">
                                <h1>pending product</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_pnpro">0</h1>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda"title="Country">
                            <div class="bogda-heding">
                                <h1>Country</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_cn">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="State">
                            <div class="bogda-heding">
                                <h1>State</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_st">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="City">
                            <div class="bogda-heding">
                                <h1>City</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_ct">0</h1>
                            </div>
                        </div>                        
                    </div>
                </section>

                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda"title="Main category">
                            <div class="bogda-heding">
                                <h1>Main category</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_main">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="Sub category">
                            <div class="bogda-heding">
                                <h1>Sub category</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_sub">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="attribute set">
                            <div class="bogda-heding">
                                <h1>Peta Category</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_peta">0</h1>
                            </div>
                        </div>                        
                    </div>
                </section>

                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda"title="attribute set">
                            <div class="bogda-heding">
                                <h1>attribute set</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_attset">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="attribute">
                            <div class="bogda-heding">
                                <h1>attribute</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_att">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="special attribute">
                            <div class="bogda-heding">
                                <h1>special attribute</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_spatt">0</h1>
                            </div>
                        </div>                        
                    </div>
                </section>
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                        <div class="col-md-3 bogda"title="contact us">
                            <div class="bogda-heding">
                                <h1>contact us</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_cu">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda "title="feedback">
                            <div class="bogda-heding">
                                <h1>feedback</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_f">0</h1>
                            </div>
                        </div>
                        <div class="col-md-3 bogda"title="email subscriber">
                            <div class="bogda-heding">
                                <h1>email subscriber</h1>
                            </div>
                            <div class="bogda-counter">
                                <h1 id="tot_es">0</h1>
                            </div>
                        </div>
                    </div>    
                </section>
<!--                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                    <div class="col-md-3 bogda"title="Active Offers">
                        <div class="bogda-heding">
                            <h1>Active Offers</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_ao">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 bogda"title="Finished Offers">
                        <div class="bogda-heding">
                            <h1>Finished Offers</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_fo">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 bogda"title="Upcoming Offers">
                        <div class="bogda-heding">
                            <h1>Upcoming Offers</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_uo">0</h1>
                        </div>
                    </div>
                    </div>
                </section>-->
                <section class="content sec-mar" style="margin-top: 40px;">
                    <div class="row">
                    <div class="col-md-3 bogda"title="Active Reviews">
                        <div class="bogda-heding">
                            <h1>Total Reviews</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_rv">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 bogda"title="Active Reviews">
                        <div class="bogda-heding">
                            <h1>Active Reviews</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_ar">0</h1>
                        </div>
                    </div>
                    <div class="col-md-3 bogda"title="Pending Reviews">
                        <div class="bogda-heding">
                            <h1>Pending Reviews</h1>
                        </div>
                        <div class="bogda-counter">
                            <h1 id="tot_pr">0</h1>
                        </div>
                    </div>
                    </div>
                </section>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';


        $tmember = $obj->my_query("SELECT count(*) as mx FROM tbl_registration")->fetch_object();
        $tcn = $obj->my_query("SELECT count(*) as cn FROM tbl_location WHERE lable = 'country'")->fetch_object();
        $tst = $obj->my_query("SELECT count(*) as st FROM tbl_location WHERE lable = 'state'")->fetch_object();
        $tct = $obj->my_query("SELECT count(*) as ct FROM tbl_location WHERE lable = 'city'")->fetch_object();
        $tmain = $obj->my_query("SELECT count(*) as main FROM tbl_category WHERE label = 'maincategory'")->fetch_object();
        $tsub = $obj->my_query("SELECT count(*) as sub FROM tbl_category WHERE label = 'subcategory'")->fetch_object();
        $tpeta = $obj->my_query("SELECT count(*) as peta FROM tbl_category WHERE label = 'petacategory'")->fetch_object();
        $tctu = $obj->my_query("SELECT count(*) as ctu FROM tbl_contact_us")->fetch_object();
        $tfbk = $obj->my_query("SELECT count(*) as fbk FROM tbl_feedback")->fetch_object();
        $tes = $obj->my_query("SELECT count(*) as es FROM tbl_email_subscribers")->fetch_object();
        $tattset = $obj->my_query("SELECT count(*) as attset FROM tbl_attribute_set")->fetch_object();
        $tspatt = $obj->my_query("SELECT count(*) as spatt FROM tbl_sp_attribute")->fetch_object();
        $tatt = $obj->my_query("SELECT count(*) as att FROM tbl_attribute")->fetch_object();
        $tseller = $obj->my_query("SELECT count(*) as seller FROM tbl_seller")->fetch_object();
        $taseller = $obj->my_query("SELECT count(*) as aseller FROM tbl_seller WHERE status = 1")->fetch_object();
        $tpro = $obj->my_query("SELECT count(*) as tpro FROM tbl_product")->fetch_object();
        $tac = $obj->my_query("SELECT count(*) as tac FROM tbl_product WHERE status = 1")->fetch_object();
        $tpn = $obj->my_query("SELECT count(*) as tpn FROM tbl_product WHERE status = 0")->fetch_object();
//        $today = date('Y-m-d');
//        $tao = $obj->my_query("SELECT count(*) as tao FROM tbl_offer WHERE $today <= start_date AND $today < end_date AND status = 1")->fetch_object();
//        $tfo = $obj->my_query("SELECT count(*) as tfo FROM tbl_offer WHERE start_date < $today AND end_date < $today")->fetch_object();
//        $tuo = $obj->my_query("SELECT count(*) as tuo FROM tbl_offer WHERE start_date > $today AND end_date > $today")->fetch_object();
        $trv = $obj->my_query("SELECT count(*) as trv FROM tbl_review")->fetch_object();
        $tar = $obj->my_query("SELECT count(*) as tar FROM tbl_review WHERE status = 1 ")->fetch_object();
        $tpr = $obj->my_query("SELECT count(*) as tpr FROM tbl_review WHERE status = 0 ")->fetch_object();
        ?>
        <script type="text/javascript">
            counter('tot_member',<?php echo $tmember->mx; ?>);
            counter('tot_cn',<?php echo $tcn->cn; ?>);
            counter('tot_st',<?php echo $tst->st; ?>);
            counter('tot_ct',<?php echo $tct->ct; ?>);
            counter('tot_main',<?php echo $tmain->main; ?>);
            counter('tot_sub',<?php echo $tsub->sub; ?>);
            counter('tot_peta',<?php echo $tpeta->peta; ?>);
            counter('tot_cu',<?php echo $tctu->ctu; ?>);
            counter('tot_f',<?php echo $tfbk->fbk; ?>);
            counter('tot_es',<?php echo $tes->es; ?>);
            counter('tot_attset',<?php echo $tattset->attset; ?>);
            counter('tot_spatt',<?php echo $tspatt->spatt; ?>);
            counter('tot_att',<?php echo $tatt->att; ?>);
            counter('tot_seller',<?php echo $tseller->seller; ?>);
            counter('tot_active',<?php echo $taseller->aseller; ?>);
            counter('tot_pro',<?php echo $tpro->tpro; ?>);
            counter('tot_acpro',<?php echo $tac->tac; ?>);
            counter('tot_pnpro',<?php echo $tpn->tpn; ?>);
            counter('tot_rv',<?php echo $trv->trv; ?>);
            counter('tot_ar',<?php echo $tar->tar; ?>);
            counter('tot_pr',<?php echo $tpr->tpr; ?>);
        </script>
    </body>
</html>