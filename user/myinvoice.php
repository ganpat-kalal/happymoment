<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Panel</title>
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
                        Invoices
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li class="active">
                            Invoices
                        </li>
                    </ol>
                </section>
                <section style="border: 1px solid #ddd;">
                        <h3 style="padding-left: 15px">Search Invoice</h3>
                        <br/>
                        <div>
                            <select name="billno" tabindex="1" onchange="bill('billno', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 25px; width: 140px">
                            <option value="">Bill No</option>
                            <?php
                                $bill = $obj->my_select("tbl_bill",NULL,array("registration_id"=>$_SESSION['user']));
                                while($b = $bill->fetch_object())
                                {
                            ?>
                                <option value="<?php echo $b->bill_id; ?>"><?php echo $b->bill_id; ?></option>
                            <?php
                                }
                            ?>
                            </select>
                            <select name="paymenttype" tabindex="2" onchange="bill('ptype', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 25px; width: 140px">
                                <option value="">Payment Type</option>
                                <option value="cod">Cash On Delivery</option>
                                <option value="card">Credit / Debit Card</option>
                            </select>
                            <input type="date" name="billdate" tabindex="3" onchange="bill('date', this.value);" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 25px; width: 160px" />
                            <input type="number" name="minprice" id="minprice" tabindex="4" placeholder="Min. Price" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 25px; width: 140px" />
                            <input type="number" name="maxprice" id="maxprice" tabindex="5" placeholder="Max. Price" class="form-control" data-bvalidator="required" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 25px; width: 140px" />
                            <button type="submit" onclick="bbl(document.getElementById('minprice').value,document.getElementById('maxprice').value)" class="btn btn-button global-bg white" style="margin-top: -13px;font-size: 13px;float: left; margin-left: 40px; width: 160px">Search</button>
                        </div>
                </section>
                <div class="panel-body" id="bill">
                    <div class="row"  style="margin: 45px" id="st">
                        <h4>Last Bill</h4>
                        <hr/>
                        <div class="col-md-12">
                            <?php
                            $lastbill = $obj->my_query("SELECT * FROM tbl_bill WHERE bill_id = (SELECT MAX(bill_id) FROM tbl_bill WHERE registration_id = $_SESSION[user])")->fetch_object();
                            //echo $lastbill->bill_id;

                            $firsttra = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $lastbill->bill_id))->fetch_object();

                            $pro_data = $obj->my_select("tbl_product", NULL, array("product_id" => $firsttra->product_id))->fetch_object();

                            $seller = $obj->my_select("tbl_seller", NULL, array("seller_id" => $pro_data->seller_id))->fetch_object();

                            $user = $obj->my_select("tbl_registration", NULL, array("registration_id" => $lastbill->registration_id))->fetch_object();
                            $address = $obj->my_select("tbl_shipment", NULL, array("shipment_id" => $lastbill->shipment_id))->fetch_object()->address;

                            if ($lastbill->bill_id != "") {
                                ?>
                                <!-- BILL START -->
                                <div style="border: 1px solid #ddd;padding: 5px 10px;font-size: 12px;" id="billdiv">
                                    <div style="border-bottom: 2px solid #999;">
                                        <div class="row" style="width: 96%;margin-left: 2%;">
                                            <div style="width: 60%;float: left;" >
                                                <p>Invoice is generated on <?php echo date("d-m-Y", strtotime($lastbill->date)); ?></p>
                                                <p style="margin-top: -9px;font-weight: bold;">Retail / TaxInvoice / Cash Memorandum</p>
                                                <?php
                                                if ($lastbill->payment_type == "cod") {
                                                    ?>
                                                    <p style="margin-top: -12px;font-weight: bold;">Payment Mode : Cash On Delivery</p>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <p style="margin-top: -12px;font-weight: bold;">Payment Mode : Credit / Debit card</p>
                                                    <?php
                                                }
                                                ?>
                                                <p style="font-size: 11px;font-weight: bold;">Sold By :</p>
                                                <p style="margin-top: -9px;font-size: 11px;font-weight: bold;"><?php echo $seller->company_name; ?></p>
                                                <p style="margin-top: -12px;font-size: 11px;"><?php echo $seller->address; ?></p>
                                                <p style="margin-top: 0px;font-size: 11px;font-weight: bold;">VAT/TIN No.: <?php echo $seller->tin_no; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; PAN No.: <font style="text-transform: uppercase;"><?php echo $seller->pan; ?></font></p>
                                            </div>
                                            <div style="width:40%;float: left;">
                                                <img src="img/barcode.png" style="padding-top: 10px;width: 100%;height: 100px;"/>
                                                <p style="margin-top: 25px;margin-left: 250px;font-size: 12px;font-weight: bold;">Invoice No. : <?php echo $lastbill->bill_id; ?></p>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                    </div>
                                    <div style="border-bottom: 2px solid #999;padding: 10px">
                                        <div class="row" style="width: 98%;margin-left: 1%;">
                                            <div style="width: 50%;float: left;">
                                                <p style="font-size: 12px;font-weight: bold;">Billing Address</p>
                                                <p style="font-size: 12px;margin-top: -10px;margin-left: 5px;"><?php echo $user->name; ?></p>
                                                <p style="margin-top: -10px;font-size: 12px;margin-left: 5px;line-height: 15px;"><?php echo $address; ?></p>
                                                <?php
                                                if ($user->contact_no != "") {
                                                    ?>
                                                    <p style="margin-top: -5px;font-size: 12px;font-weight: bold;margin-left: 5px;">Mobile : +91 <?php echo $user->contact_no; ?></p>
                                                    <?php
                                                }
                                                ?>
                                                <p style="margin-top: -12px;font-size: 12px;font-weight: bold;margin-left: 5px;">E-mail : <?php echo $user->email; ?></p>
                                            </div>
                                            <div style="width: 50%;float: left;">
                                                <p style="font-size: 12px;font-weight: bold;">Shipping Address</p>
                                                <p style="font-size: 12px;margin-top: -10px;margin-left: 5px;"><?php echo $user->name; ?></p>
                                                <p style="margin-top: -10px;font-size: 12px;margin-left: 5px;line-height: 15px;"><?php echo $address; ?></p>
                                                <?php
                                                if ($user->contact_no != "") {
                                                    ?>
                                                    <p style="margin-top: -5px;font-size: 12px;font-weight: bold;margin-left: 5px;">Mobile : +91 <?php echo $user->contact_no; ?></p>
                                                    <?php
                                                }
                                                ?>
                                                <p style="margin-top: -12px;font-size: 12px;font-weight: bold;margin-left: 5px;">E-mail : <?php echo $user->email; ?></p>
                                            </div>
                                            <div style="clear: both;"></div>
                                        </div>
                                    </div>
                                    <div style="padding: 10px">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <table style="width: 100%;">
                                                    <tr style="border-bottom: 1px solid #ddd;">
                                                        <th style="padding: 5px;">No.</th>
                                                        <th style="width: 270px;">Description</th>
                                                        <th style="text-align: center">Gross Amt ( &#8377; )</th>
                                                        <th style="text-align: center">Discount ( &#8377; )</th>
                                                        <th style="text-align: center">Net Amt ( &#8377; )</th>
                                                        <th style="text-align: center">Qty.</th>
                                                        <th style="text-align: center">Final Amt. ( &#8377; )</th>
                                                    </tr>
                                                    <?php
                                                    $c = 1;
                                                    $s = 0;
                                                    $tra = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $lastbill->bill_id));
                                                    while ($traa = $tra->fetch_object()) {
                                                        $nt = ($traa->final_price * $traa->qty);
                                                        $s += $nt;

                                                        $product = $obj->my_select("tbl_product", NULL, array("product_id" => $traa->product_id))->fetch_object()->product_name;
                                                        ?>
                                                        <tr style="border-bottom: 1px dotted #ddd;" >
                                                            <td style="padding: 10px"><?php echo $c++; ?></td>
                                                            <td style="width: 270px;"><?php echo $product; ?></td>
                                                            <td style="text-align: center"><?php echo $traa->growse_price; ?></td>
                                                            <td style="text-align: center"><?php echo $traa->discount; ?></td>
                                                            <td style="text-align: center"><?php echo $traa->final_price; ?></td>
                                                            <td style="text-align: center"><?php echo $traa->qty; ?></td>
                                                            <td style="text-align: center"><?php echo $nt; ?></td>
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                    <tr style="border-top: 1px solid #ddd;" >
                                                        <td style="padding: 10px">&nbsp;</td>
                                                        <td style="width: 270px;"></td>
                                                        <td style="text-align: center"></td>
                                                        <td style="text-align: center"></td>
                                                        <td style="text-align: center"></td>
                                                        <td style="text-align: center;font-size: 13px;font-weight: bold;">Total Amount</td>
                                                        <td style="text-align: center">Rs. <?php echo $s; ?> /-</td>
                                                    </tr>
                                                    <?php
                                                    $coupon = $obj->my_select("tbl_promocode", NULL, array("promocode_id" => $lastbill->promocode_id))->fetch_object();
                                                    ?>
                                                    <tr style="border-bottom: 1px solid #ddd;" >
                                                        <td style="padding-bottom: 15px;margin-top: -10px;">&nbsp;</td>
                                                        <td style="width: 270px;"></td>
                                                        <td></td>
                                                        <td></td>
                                                        <?php
                                                        if ($lastbill->promocode_id != 0) {
                                                            ?>
                                                            <td style="text-align: right;font-weight: bold;"><?php echo $coupon->code; ?> is Applied.</td>
                                                            <td style="text-align: center;font-size: 13px;font-weight: bold;"> &nbsp;&nbsp;&nbsp;( - ) Coupon</td>
                                                            <td style="text-align: center">Rs. <?php echo $coupon->amount; ?> /-</td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td style="text-align: right;font-weight: bold;"></td>
                                                            <td style="text-align: center;font-size: 13px;font-weight: bold;"> &nbsp;&nbsp;&nbsp;( - ) Coupon</td>
                                                            <td style="text-align: center">Rs. 0 /-</td>

                                                            <?php
                                                        }
                                                        ?>
                                                    </tr>
                                                    <tr style="border-bottom: 1px solid #ddd;" >
                                                        <td style="padding: 10px">&nbsp;</td>
                                                        <td style="width: 270px;"></td>
                                                        <td style="text-align: center"></td>
                                                        <td style="text-align: center"></td>
                                                        <td style="text-align: center"></td>
                                                        <?php
                                                        if ($lastbill->promocode_id != 0) {
                                                            $final = $s - $coupon->amount;
                                                        } else {
                                                            $final = $s;
                                                        }
                                                        ?>
                                                        <td style="text-align: center;font-size: 13px;font-weight: bold;"> Total Paid Amount</td>
                                                        <td style="text-align: center;font-size: 13px;font-weight: bold;">Rs. <?php echo $final; ?> /-</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <span style="font-size: 11px;">* This is computer geneated invoice, if you have queries then contact us.</span>
                                                        </td>
                                                        <td style="text-align: right;">
                                                            <span class="btn btn-primary" style="margin: 10px;" onclick="printbill();">Print</span>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- BILL END -->
                                <?php
                            } else {
                                ?>
                                <center>
                                    <h1 style="color:#ddd;">No Bill Generated.</h1>
                                </center>
                                <?php
                            }
                            ?>
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
            $("#myform1").bValidator();
            
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
