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
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
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
                        Manage Reports
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Reports</a>
                        </li>
                    </ol>
                </section>
                <section style="border: 1px solid #ddd;">
                    <h3 style="padding-left: 15px">Search Report</h3>
                    <br/>
                    <div>
                            <select name="billno" tabindex="1" onchange="report('billno', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 120px">
                                <option value="">Bill No</option>
                                <?php
                                $bill = $obj->my_select("tbl_bill");
                                while($b = $bill->fetch_object())
                                {
                            ?>
                                <option value="<?php echo $b->bill_id; ?>"><?php echo $b->bill_id; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <select name="paymenttype" tabindex="2" onchange="report('ptype', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 140px">
                                <option value="">Payment Type</option>
                                <option value="cod">Cash On Delivery</option>
                                <option value="card">Credit / Debit Card</option>
                            </select>
                            <?php
                            $wh['lable'] = "country";

                            $data = $obj->my_select("tbl_location", NULL, $wh);
                            ?>
                            <select name="country" tabindex="3" onchange="set_combo('state', this.value);report('country', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 130px">
                                <option value="">Country</option>
                                <?php
                                while ($row = $data->fetch_object()) {
                                    ?>
                                    <option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select name="state" tabindex="4" id="state" onchange="set_combo('city', this.value);report('state', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 140px">
                                <option value="">State</option>
                            </select>
                            <select name="city" tabindex="5" class="form-control" onchange="report('city', this.value);" id="city" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 130px">
                                <option value="">City</option>
                            </select>
                            <select name="products" tabindex="6" class="form-control" onchange="report('product', this.value);" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 130px">
                                <option value="">Products</option>
                                <?php
                                    $p = $obj->my_select("tbl_product");
                                    while($pro = $p->fetch_object())
                                    {
                                ?>
                                <option value="<?php echo $pro->product_id; ?>"><?php echo $pro->product_name; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select name="coupon" tabindex="7" onchange="report('code', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 130px">
                                <option value="">Coupon</option>
                                <?php
                                    $pr = $obj->my_select("tbl_promocode");
                                    while($promo = $pr->fetch_object())
                                    {
                                ?>
                                    <option value="<?php echo $promo->promocode_id; ?>"><?php echo $promo->code; ?></option>
                                <?php
                                    }
                                ?>    
                            </select>
                        </div>
                </section>
                <section style="border: 1px solid #ddd;">
                        <div style="margin-top: 45px">
                            <select name="member" tabindex="8" onchange="report('member', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 140px">
                                <option value="">Members</option>
                                <?php
                                    $member = $obj->my_select("tbl_registration");
                                    while($mem = $member->fetch_object())
                                    {if($mem->user_name == "")
                                        {
                                ?>
                                <option value="<?php echo $mem->registration_id; ?>"><?php echo $mem->email; ?></option>
                                <?php
                                        }
                                        else
                                        {
                                ?>
                                <option value="<?php echo $mem->registration_id; ?>"><?php echo $mem->user_name; ?></option>
                                <?php
                                        }
                                    }
                                ?>
                            </select>
                            <select name="seller" tabindex="9" onchange="report('seller', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 140px">
                                <option value="">Seller</option>
                                <?php
                                    $seller = $obj->my_select("tbl_seller");
                                    while($sel = $seller->fetch_object())
                                    {
                                ?>
                                <option value="<?php echo $sel->seller_id; ?>"><?php echo $sel->company_name; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <input type="date" name="billdate" onchange="report('date', this.value);" tabindex="10" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 160px" />
                            <input type="number" id="minprice" name="minprice" tabindex="11" placeholder="Min. Price" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 150px" />
                            <input type="number" id="maxprice" name="maxprice" tabindex="12" placeholder="Max. Price" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 20px; width: 150px" />
                            <button type="submut" tabindex="13" onclick="rp(document.getElementById('minprice').value,document.getElementById('maxprice').value)" class="btn btn-button global-bg white" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 40px; width: 180px">Search</button>
                        </div>
                </section>
                <div class="panel-body" id="bill">
                    <div class="row"  style="margin: 45px" id="st">
                        <div style="height: 200px; border: 1px solid #ddd;  background: #ddd">
                            <?php
                                $cbill = $obj->my_query("SELECT COUNT(bill_id) as mx FROM tbl_bill")->fetch_object()->mx;
                            ?>
                            <center><h1 style="font-weight: bold; margin-top: 70px; font-size: 60px; color: orangered">Total Bill : <?php echo $cbill; ?></h1></center>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script type="text/javascript">
            $("#myform").bValidator();
            
            function printbill()
            {
                //alert("hii");
                var p = document.getElementById('billdiv');
                var pp = window.open('','_blank');
                
                pp.document.open();
                pp.document.write('<html><body onload="window.print()">' + p.innerHTML + '</html>');
                pp.document.close();
            }
        </script>
    </body>
</html>