<?php
require_once '../connection.php';
$obj = new model();

$action = $_POST['action'];
$id = $_POST['id'];

if ($action == "searchreport") {
    ?>
    <div class="col-md-12">
        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <?php
                if ($_POST['type'] == "billno") {
                    ?>
                    <h2 class="panel-title" style="font-size: 16px;letter-spacing: 1px;">Report for Bill No. <?php echo $_POST['id']; ?></h2>
                    <?php
                }
                if ($_POST['type'] == "date") {
                    $tr = $data = $obj->my_query("SELECT t.* FROM tbl_product as p,tbl_transaction as t,tbl_bill as b WHERE t.bill_id = b.bill_id AND t.product_id = p.product_id AND p.seller_id = $_SESSION[seller] AND b.date = '$_POST[id]'")->fetch_object()->ttr;
                    ?>
                    <h2 class="panel-title" style="font-size: 16px;letter-spacing: 1px;">Search Result of <?php echo date("d-m-Y", strtotime($_POST['id'])); ?><?php echo $tr; ?> </h2>
                    <?php
                }
                if ($_POST['type'] == "product") {
                    $data = $obj->my_select("tbl_product", NULL)
                    ?>
                    <h2 class="panel-title" style="font-size: 16px;letter-spacing: 1px;">Search Result of <?php echo $tr; ?> </h2>
                    <?php
                }
                ?>
            </header>
            <div class="panel-body" id="st">
                <!-- Report Start -->
                <div style="border: 1px solid #777777;padding: 20px;" id="tradiv">
                    <div>
                        <div style="width: 50%;float: left;">
                            <font style="font-size: 22px;font-weight: bold;padding-left: 25px">HappyMoment</font>
                            <br/>
                            <font style="font-size: 11px;">Celebrate your HappyMoments with us .</font>
                        </div>
                        <div style="width: 50%;float: left;text-align: right;">
                            <h1 style="font-size: 12px;letter-spacing: 1px;">Report Generated on <?php echo date('d-m-Y', strtotime(date('Y-m-d'))); ?></h1>
                        </div>
                        <div style="clear: both;"></div>
                        <br/>

                        <div style="font-weight: bold;text-align: center;">
                            <?php
                            if ($_POST['type'] == "billno") {
                                echo "Transaction Report For Bill No. " . $_POST['id'];
                            }
                            if ($_POST['type'] == "date") {
                                echo "Transaction Report For Date of " . $_POST['id'];
                            }
                            if ($_POST['type'] == "product") {
                                echo "Transaction Report For Product " . $_POST['id'];
                            }
                            ?>
                        </div>

                        <hr style="color:black" size="1px">
                    </div>
                    <div>
                        <table style="font-size: 13px;width: 100%;border: 1px solid #777777;">
                            <tr>
                                <th style="padding: 7px;border: 1px solid #777777;">No.</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Bill No.</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Product Name</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Member</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Seller</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Price</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Discount</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Net Price</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Qty</th>
                                <th style="padding: 7px;border: 1px solid #777777;">Total</th>
                            </tr>
                            <?php
                            if ($_POST['type'] == "billno") {
                                $data = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $_POST['id']));
                            }
                            if ($_POST['type'] == "ptype") {
                                $bill = $obj->my_select("tbl_bill",NULL,array("payment_type"=>$_POST['id']))->fetch_object();
                                $data = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $bill->bill_id));
                            }
                            if ($_POST['type'] == "country") {
                                $data = $obj->my_query("SELECT t.* FROM tbl_transaction as t, tbl_bill as b , tbl_shipment as s , tbl_location as city, tbl_location as state, tbl_location as cn WHERE b.bill_id = t.bill_id AND b.shipment_id = s.shipment_id AND city.location_id = s.city AND city.parent_id = state.location_id AND state.parent_id = cn.location_id AND cn.location_id = $_POST[id]");
                            }
                            if ($_POST['type'] == "state") {
                                $data = $obj->my_query("SELECT t.* FROM tbl_transaction as t, tbl_bill as b , tbl_shipment as s , tbl_location as city, tbl_location as state WHERE b.bill_id = t.bill_id AND b.shipment_id = s.shipment_id AND city.location_id = s.city AND city.parent_id = state.location_id AND state.location_id = $_POST[id]");
                            }
                            if ($_POST['type'] == "city") {
                                $data = $obj->my_query("SELECT t.* FROM tbl_transaction as t, tbl_bill as b , tbl_shipment as s , tbl_location as city WHERE b.bill_id = t.bill_id AND b.shipment_id = s.shipment_id AND city.location_id = s.city AND city.location_id = $_POST[id]");
                            }
                            if ($_POST['type'] == "product") {
                                $data = $obj->my_query("SELECT * FROM tbl_transaction WHERE product_id = $_POST[id]");
                            }
                            if ($_POST['type'] == "code") {
                                $bil = $obj->my_select("tbl_bill", NULL, array("promocode_id" => $_POST['id']))->fetch_object();
                                $data = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $bil->bill_id));
                            }
                            if ($_POST['type'] == "date") {
                                $data = $obj->my_query("SELECT t.* FROM tbl_transaction as t,tbl_bill as b WHERE t.bill_id = b.bill_id AND b.date = '$_POST[id]'");
                            }
                            if ($_POST['type'] == "member") {
                                $bi = $obj->my_select("tbl_bill", NULL, array("registration_id" => $_POST['id']))->fetch_object();
                                $data = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $bi->bill_id));
                            }
                            if ($_POST['type'] == "seller") {
                                $pr = $obj->my_select("tbl_seller", NULL, array("seller_id" => $_POST['id']))->fetch_object();
                                $tran = $obj->my_select("tbl_transaction", NULL, array("product_id" => $pr->product_id))->fetch_object();
                                $data = $obj->my_select("tbl_bill", NULL, array("bill_id" => $tran->bill_id));
                            }
                            if ($_POST['type'] == "price") 
                            {
                                if ($_POST['minprice'] != "" && $_POST['maxprice'] != "") {
                                    $data = $obj->my_query("SELECT * FROM `tbl_transaction` WHERE final_price >= $_POST[minprice] AND final_price <= $_POST[maxprice]");
                                }
                                if ($_POST['minprice'] == "" && $_POST['maxprice'] != "") {
                                    $data = $obj->my_query("SELECT * FROM `tbl_transaction` WHERE final_price >= 0 AND final_price <= $_POST[maxprice]");
                                }
                                if ($_POST['minprice'] != "" && $_POST['maxprice'] == "") {
                                    $data = $obj->my_query("SELECT * FROM `tbl_transaction` WHERE final_price >= $_POST[minprice]");
                                }
                            }
                            
                            $c = 0;
                            $price = 0;
                            $discout = 0;
                            $net = 0;
                            $qty = 0;
                            $total = 0;
                            while ($report = $data->fetch_object()) {
                                $c++;
                                $pro_data = $obj->my_select("tbl_product", NULL, array("product_id" => $report->product_id))->fetch_object();
                                $seller = $obj->my_select("tbl_seller", NULL, array("seller_id" => $pro_data->seller_id))->fetch_object();
                                
                                $user = $obj->my_query("SELECT r.* FROM tbl_registration as r,tbl_bill as b,tbl_transaction as t WHERE r.registration_id = b.registration_id AND b.bill_id = t.bill_id AND t.transaction_id = $report->transaction_id")->fetch_object()->user_name;
                                if($user->user_name == "")
                                {
                                    echo $user->email;
                                }
                                else
                                {
                                    echo $user->user_name;
                                }

                                $price += $report->growse_price;
                                $discout += $report->discount;
                                $net += $report->final_price;
                                $qty += $report->qty;
                                $t = ($report->qty * $report->final_price);
                                $total += $t;
                                ?>
                                <tr style="border: 1px solid #777777;">
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $c; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $report->bill_id; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;width: 230px;"><?php echo $pro_data->product_name; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $user; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $seller->company_name; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $report->growse_price; ?> /-</td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $report->discount; ?> /-</td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $report->final_price; ?> /-</td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo $report->qty; ?></td>
                                    <td style="padding: 7px;border: 1px solid #777777;"><?php echo ($report->qty * $report->final_price); ?> /-</td>
                                </tr>
                                <?php
                            }
                            ?>
                            <tr style="border: 1px solid #777777;">
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;text-align: right;" colspan="5">All Transaction Totals</td>
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;"><?php echo $price; ?> /-</td>
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;"><?php echo $discout; ?> /-</td>
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;"><?php echo $net; ?> /-</td>
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;"><?php echo $qty; ?></td>
                                <td style="padding: 7px;border: 1px solid #777777;font-weight: bold;"><?php echo $total; ?> /-</td>
                            </tr>
                        </table>
                    </div>
                    <div style="text-align: right;padding: 15px;">
                        <span class="btn btn-primary" style="margin: 10px;" onclick="printreport();">Print</span>
                    </div>
                    <script type="text/javascript">
                        function printreport()
                        {
                            //alert("hii");
                            var p = document.getElementById('tradiv');
                            var pp = window.open('', '_blank');

                            pp.document.open();
                            pp.document.write('<html><body onload="window.print()">' + p.innerHTML + '</html>');
                            pp.document.close();
                        }
                    </script>
                </div>
                <!-- Report End -->
            </div>
        </section>
    </div>
    <?php
}


if ($action == "searchbill") {
    //print_r($_POST);
    ?>
    <div class="panel-body" id="bill">
        <div class="row"  style="margin: 45px" id="st">
            <h4>Bill</h4>
            <hr/>
            <div class="col-md-12">
                <?php
                if ($_POST['type'] == "billno") {
                    $data = $obj->my_select("tbl_bill", NULL, array("bill_id" => $_POST['id']));
                }
                if ($_POST['type'] == "date") {
                    $data = $obj->my_select("tbl_bill", NULL, array("date" => $_POST['id']));
                }
                if ($_POST['type'] == "ptype") {
                    $data = $obj->my_select("tbl_bill", NULL, array("payment_type" => $_POST['id']));
                }
                if ($_POST['type'] == "country") {
                    $data = $obj->my_query("SELECT b.* FROM tbl_bill as b , tbl_shipment as s , tbl_location as city, tbl_location as state, tbl_location as cn WHERE b.shipment_id = s.shipment_id AND city.location_id = s.city AND city.parent_id = state.location_id AND state.parent_id = cn.location_id AND cn.location_id = $_POST[id]");
                }
                if ($_POST['type'] == "state") {
                    $data = $obj->my_query("SELECT b.* FROM tbl_bill as b , tbl_shipment as s , tbl_location as city, tbl_location as state WHERE b.shipment_id = s.shipment_id AND city.location_id = s.city AND city.parent_id = state.location_id AND state.location_id = $_POST[id]");
                }
                if ($_POST['type'] == "city") {
                    $shipment = $obj->my_select("tbl_shipment", NULL, array("city" => $_POST['id']))->fetch_object();
                    $data = $obj->my_select("tbl_bill", NULL, array("shipment_id" => $shipment->shipment_id));
                }
                if ($_POST['type'] == "product") {
                    $trans = $obj->my_select("tbl_transaction", NULL, array("product_id" => $_POST['id']))->fetch_object();
                    $data = $obj->my_select("tbl_bill", NULL, array("bill_id" => $trans->bill_id));
                }
                if ($_POST['type'] == "member") {
                    $data = $obj->my_select("tbl_bill", NULL, array("registration_id" => $_POST['id']));
                }
                if ($_POST['type'] == "code") {
                    $data = $obj->my_select("tbl_bill", NULL, array("promocode_id" => $_POST['id']));
                }
                if ($_POST['type'] == "seller") {
                    $sl = $obj->my_select("tbl_seller", NULL, array("seller_id" => $_POST['id']))->fetch_object();
                    $pr = $obj->my_select("tbl_product", NULL, array("seller_id" => $sl->seller_id))->fetch_object();
                    $tran = $obj->my_select("tbl_transaction", NULL, array("product_id" => $pr->product_id))->fetch_object();
                    $data = $obj->my_select("tbl_bill", NULL, array("bill_id" => $tran->bill_id));
                }
                if ($_POST['type'] == "price") {
                    if ($_POST['minprice'] != "" && $_POST['maxprice'] != "") {
                        $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= $_POST[minprice] AND amount <= $_POST[maxprice]");
                    }
                    if ($_POST['minprice'] == "" && $_POST['maxprice'] != "") {
                        $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= 0 AND amount <= $_POST[maxprice]");
                    }
                    if ($_POST['minprice'] != "" && $_POST['maxprice'] == "") {
                        $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= $_POST[minprice]");
                    }
                }

                while ($lastbill = $data->fetch_object()) {

                    $firsttra = $obj->my_select("tbl_transaction", NULL, array("bill_id" => $lastbill->bill_id))->fetch_object();

                    $pro_data = $obj->my_select("tbl_product", NULL, array("product_id" => $firsttra->product_id))->fetch_object();

                    $seller = $obj->my_select("tbl_seller", NULL, array("seller_id" => $pro_data->seller_id))->fetch_object();

                    $user = $obj->my_select("tbl_registration", NULL, array("registration_id" => $lastbill->registration_id))->fetch_object();
                    $address = $obj->my_select("tbl_shipment", NULL, array("shipment_id" => $lastbill->shipment_id))->fetch_object()->address;
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
                                    <p style="margin-top: -11px;font-size: 11px;"><?php echo $seller->address; ?></p>
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
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

if ($action == "state") {
    $d['parent_id'] = $id;

    $dt = $obj->my_select("tbl_location", NULL, $d);
    ?>
    <option value="">Select State</option>
    <?php
    while ($row = $dt->fetch_object()) {
        ?>
        <option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
        <?php
    }
}

if ($action == "city") {
    $d['parent_id'] = $id;

    $dt = $obj->my_select("tbl_location", NULL, $d);
    ?>
    <option value="">Select City</option>
    <?php
    while ($row = $dt->fetch_object()) {
        ?>
        <option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
        <?php
    }
}

if ($action == "sub") {
    $d['parent_id'] = $id;

    $dt = $obj->my_select("tbl_category", NULL, $d);
    ?>
    <option value="">Select Sub Category</option>
    <?php
    while ($row = $dt->fetch_object()) {
        ?>
        <option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
        <?php
    }
}

if ($action == "peta") {
    $d['parent_id'] = $id;

    $dt = $obj->my_select("tbl_category", NULL, $d);
    ?>
    <option value="">Select Peta Category</option>
    <?php
    while ($row = $dt->fetch_object()) {
        ?>
        <option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
        <?php
    }
}


if ($action == "set") {
    $d['category_id'] = $id;

    $dt = $obj->my_select("tbl_attribute_set", NULL, $d);
    ?>
    <option value="">Select Attribute Set</option>
    <?php
    while ($row = $dt->fetch_object()) {
        ?>
        <option value="<?php echo $row->attribute_set_id; ?>"><?php echo $row->set_name; ?></option>
        <?php
    }
}
if ($action == "att_val") 
{
    if ($id == "Selectbox") 
    {
    ?>
        <input type="text" name="att_value" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Value (val1,val2,...)" data-bvalidator="required"/>
    <?php
    }
}

if ($action == "seller") {
    $status = $_POST['status'];
    if ($status == "active") {
        $aa = $obj->my_update("tbl_seller", array("status" => 1), array("seller_id" => $id));
    }
    if ($status == "deactive") {
        $aa = $obj->my_update("tbl_seller", array("status" => 0), array("seller_id" => $id));
    }
    ?>
    <thead>
        <tr style="text-align: center;">
            <th style="width: 10%;text-align: center;">
                No.
            </th>
            <th style="width: 10%;text-align: center;">
                Profile 
            </th>
            <th style="width: 10%;text-align: center;">
                Company
            </th>
            <th style="width: 10%;text-align: center;">
                Email
            </th>
            <th style="width: 10%;text-align: center;">
                Contact no
            </th>
            <th style="width: 10%;text-align: center;">
                City
            </th>
            <th style="width: 10%;text-align: center;">
                Status
            </th>
            <th style="width: 20%;text-align: center;">
                View Detail
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_seller");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>
            <tr style="text-align: center;">
                <td style="width: 10%">
                    <?php echo $c; ?>
                </td>
                <td style="width: 10%">
                    <img title="<?php echo $row->company_name; ?>" src="../seller/<?php echo $row->path; ?>" style="width: 40px;height: 40px;border-radius: 40px; padding: 3px;" />
                </td>
                <td style="width: 10%">
                    <?php echo $row->company_name; ?>
                </td>
                <td style="width: 20%">
                    <?php echo $row->email; ?>
                </td>

                <td style="width: 10%" >
                    <?php echo $row->contact_no; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    $ct = $obj->my_select("tbl_location", NULL, array("location_id" => $row->location_id))->fetch_object();
                    echo $ct->name;
                    ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('seller', 'active',<?php echo $row->seller_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('seller', 'deactive',<?php echo $row->seller_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>

                </td>
                <td style="width: 10%">

                    <input type="button" class="form-control" value="View"> 
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <?php
}

if ($action == "banner") {
    $status = $_POST['status'];
    if ($status == "active") {
        $ab = $obj->my_update("tbl_banner", array("status" => 1), array("banner_id" => $id));
    }
    if ($status == "deactive") {
        $ab = $obj->my_update("tbl_banner", array("status" => 0), array("banner_id" => $id));
    }
    ?>
    <thead>
        <tr style="text-align: center;">
            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                No
            </th>
            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                Banner
            </th>
            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                Status
            </th>
            <th style="width: 10%;text-align: center; padding-bottom: 13px">
                Remove
            </th>

        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_banner");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>
            <tr style="text-align: center;">
                <td style="width: 10%; padding: 0px;" >
                    <?php echo $c; ?>
                </td>
                <td>
                    <img src="../<?php echo $row->path; ?>" title="Banner" style="width: 150px">
                </td>
                <td style="width: 10%; padding: 0px;" >
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('banner', 'active',<?php echo $row->banner_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('banner', 'deactive',<?php echo $row->banner_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>
                </td>
                <td style="width: 10%" >
                    <a href="managebanner.php?del=<?php echo $row->banner_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                </td>
            </tr>

            <?php
        }
        ?>

    </tbody>
    <?php
}

if ($action == "user") {
    $status = $_POST['status'];
    if ($status == "active") {
        $ab = $obj->my_update("tbl_registration", array("status" => 1), array("registration_id" => $id));
    }
    if ($status == "deactive") {
        $ab = $obj->my_update("tbl_registration", array("status" => 0), array("registration_id" => $id));
    }
    ?>
    <thead>
        <tr style="text-align: center;">
            <th style="width: 10%;text-align: center;">
                No.
            </th>
            <th style="width: 10%;text-align: center;">
                Autho. Provider
            </th>
            <th style="width: 10%;text-align: center;">
                Profile
            </th>
            <th style="width: 20%;text-align: center;">
                Name
            </th>
            <th style="width: 10%;text-align: center;">
                Email
            </th>
            <th style="width: 10%;text-align: center;">
                Contact no
            </th>
            <th style="width: 10%;text-align: center;">
                Status
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_registration");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>
            <tr style="text-align: center;">
                <td style="width: 10%">
                    <?php echo $c; ?>
                </td>
                <td>
                    <?php echo $row->autho_provider; ?>
                </td>
                <td style="width: 10%">
                    <img src="<?php
                    if ($row->profile == "") {
                        echo "profile/a.jpg";
                    } else {
                        echo $row->profile;
                    }
                    ?>" style="width: 40px;height: 40px;border-radius: 40px; padding: 3px;" />
                </td>
                <td style="width: 20%">
                    <?php
                    if ($row->user_name == "") {
                        echo "Not Specified";
                    } {
                        echo $row->user_name;
                    }
                    ?>
                </td>

                <td style="width: 10%" >
                    <?php echo $row->email; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($row->contact_number == "") {
                        echo "Not Specified";
                    } {
                        echo $row->contact_number;
                    }
                    ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('user', 'active',<?php echo $row->registration_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('user', 'deactive',<?php echo $row->registration_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>


    <?php
}

if ($action == "product") {
    $status = $_POST['status'];
    if ($status == "active") {
        $aa = $obj->my_update("tbl_product", array("status" => 1), array("product_id" => $id));
    }
    if ($status == "deactive") {
        $aa = $obj->my_update("tbl_product", array("status" => 0), array("product_id" => $id));
    }
    ?>
    <thead>
        <tr style="text-align: center;">
            <th style="width: 10%;text-align: center;" nova-search="yes">
                No.
            </th>
            <th style="width: 10%;text-align: center;" nova-search="yes">
                Seller Name
            </th>
            <th style="width: 10%;text-align: center;" nova-search="yes">
                Product Code
            </th>
            <th style="width: 10%;text-align: center;" nova-search="yes">
                Product Name
            </th>
            <th style="width: 10%;text-align: center;" nova-search="no">
                Photo 
            </th>
            <th style="width: 10%;text-align: center;" nova-search="yes">
                Price
            </th>
            <th style="width: 10%;text-align: center;" nova-search="no">
                Status
            </th>
            <th style="width: 10%;text-align: center;" nova-search="no">
                Remove
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_product");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>
            <tr style="text-align: center;">
                <td style="width: 10%">
                    <?php echo $c; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    $sname = $obj->my_select("tbl_seller", NULL, array("seller_id" => $row->seller_id))->fetch_object();
                    echo $name = $sname->company_name;
                    ?>
                </td>
                <td style="width: 10%">
                    <?php echo $row->product_code; ?>
                </td>
                <td style="width: 20%">
                    <?php echo $row->product_name; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    $img = $obj->my_select("tbl_product_image", NULL, array("product_id" => $row->product_id))->fetch_object();
                    $imgg = $img->path;

                    $imggg = explode(",", $imgg);
                    ?>
                    <img src="../seller/<?php echo $imggg[0]; ?>" style="width: 80px;height: 80px;padding: 3px;" /></td>
                <td style="width: 10%" >
                    <?php echo $row->price; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('product', 'active',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('product', 'deactive',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>
                </td>
                <td style="width: 10%">
                    <a href="managepro.php?del=<?php echo $row->product_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a> 
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <?php
}

if ($action == "review") {
    $status = $_POST['status'];
    if ($status == "active") {
        $aa = $obj->my_update("tbl_review", array("status" => 1), array("review_id" => $id));
    }
    if ($status == "deactive") {
        $aa = $obj->my_update("tbl_review", array("status" => 0), array("review_id" => $id));
    }
    ?>
    <thead>
        <tr style="text-align: center;">
            <th style="width: 10%;text-align: center;">
                No.
            </th>
            <th style="width: 10%;text-align: center;">
                Profile
            </th>
            <th style="width: 20%;text-align: center;">
                Name
            </th>
            <th style="width: 10%;text-align: center;">
                Email
            </th>
            <th style="width: 10%;text-align: center;">
                Review
            </th>
            <th style="width: 10%;text-align: center;">
                Status
            </th>
            <th style="width: 10%;text-align: center;">
                Remove
            </th>

        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_review");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>

            <tr style="text-align: center;">
                <td style="width: 10%">
                    <?php echo $c; ?>
                </td>
                <td>
                    <?php
                    $img = $obj->my_select("tbl_registration", NULL, array("registration_id" => $row->registration_id))->fetch_object();
                    if ($img->profile == "") 
                                        {
                                        ?>
                                        <img src="../user/profile/a.jpg" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                        <?php
                                        } 
                                        else 
                                        {
                                            if ($us->autho_provider == "website") 
                                            {
                                        ?>
                                            <img src="../user/<?php echo $img->profile; ?>" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                            <?php
                                            } 
                                            else 
                                            {
                                            ?>
                                            <img src="<?php echo $img->profile; ?>" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                        <?php
                                            }
                                        }
                    ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($img->user_name == "") {
                        echo "Not Specified";
                    } {
                        echo $img->user_name;
                    }
                    ?>
                </td>
                <td style="width: 20%">
                    <?php echo $img->email; ?>
                </td>
                <td style="width: 20%">
                    <?php echo $row->review; ?>
                </td>
                <td style="width: 10%">
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('review', 'active',<?php echo $row->review_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('review', 'deactive',<?php echo $row->review_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>
                </td>
                <td style="width: 10%">
                    <a href="managereview.php?del=<?php echo $row->review_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a> 
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
    <?php
}
if ($action == "promo") {
    $status = $_POST['status'];
    if ($status == "active") {
        $aa = $obj->my_update("tbl_promocode", array("status" => 1), array("promocode_id" => $id));
    }
    if ($status == "deactive") {
        $aa = $obj->my_update("tbl_promocode", array("status" => 0), array("promocode_id" => $id));
    }
    ?>
    <thead>
        <tr style = "text-align: center;">
            <th style = "width: 10%;text-align: center; padding-bottom: 13px;" nova-search = "yes">
                No
            </th>
            <th style = "width: 10%;text-align: center; padding-bottom: 13px;" nova-search = "yes">
                Promo Code
            </th>
            <th style = "width: 10%;text-align: center; padding-bottom: 13px;" nova-search = "yes">
                Amount
            </th>
            <th style = "width: 10%;text-align: center; padding-bottom: 13px;" nova-search = "yes">
                Minimum Bill Price
            </th>
            <th style = "width: 10%;text-align: center; padding-bottom: 13px" nova-search = "no">
                Status
            </th>
        </tr>
    </thead>
    <tbody>
        <?php
        $c = 0;
        $data = $obj->my_select("tbl_promocode");
        while ($row = $data->fetch_object()) {
            $c++;
            ?>
            <tr style="text-align: center;">
                <td style="width: 10%; padding: 0px;" >
                    <?php echo $c; ?>
                </td>

                <td>
                    <?php echo $row->code; ?>
                </td>
                <td>
                    <?php echo $row->amount; ?>
                </td>
                <td>
                    <?php echo $row->min_bill_price; ?>
                </td>
                <td style="width: 10%" >
                    <?php
                    if ($row->status == 0) {
                        ?>
                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('promo', 'active',<?php echo $row->promocode_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    } else {
                        ?>
                        <i class="fa fa-toggle-on" title="Block Now" onclick="activation('promo', 'deactive',<?php echo $row->promocode_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?PHP
        }
        ?>
    </tbody>
    <?php
}
?>



