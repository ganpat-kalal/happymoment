<?php
require_once '../connection.php';
$obj = new model();

$action = $_POST['action'];
$id = $_POST['id'];


if ($action == "add_cartt") {
    if (isset($_SESSION['user'])) {
        $w['product_id'] = $_POST['id'];
        $w['registration_id'] = $_SESSION['user'];

        $count = $obj->count_record("tbl_cart", $w);

        if ($count == 0) {
            $gp = $obj->my_select("tbl_product", NULL, array("product_id" => $_POST['id']))->fetch_object();

            $gprice = $gp->price;

            $profit = $obj->my_select("tbl_profit_rate")->fetch_object();
            //print_r($profit);
            $prate = $profit->profit_rate;
            $rs = ($gprice * $prate) / 100;

            $net = $gprice + $rs;
            $net = round($net);

            if ($gp->offer_id != 0) {
                $offer = $obj->my_select("tbl_offer", NULL, array("offer_id" => $gp->offer_id))->fetch_object();
                $orate = $offer->rate;
                $ors = ($net * $orate) / 100;
                $onet = $net - $ors;
                $onet = round($onet);
            } else {
                $ors = 0;
                $onet = $net;
            }

            $w['growse_price'] = $net;
            $w['discount'] = $ors;
            $w['final_price'] = $onet;
            $w['qty'] = 1;
            //print_r($w);
            echo $ans = $obj->my_insert("tbl_cart", $w);
        } else {
            echo "already added in cart!";
        }
    } else {
        echo "login";
    }
}

if($action == "searchbill")
{
    //print_r($_POST);
    ?>
    <div class="panel-body" id="bill">
                    <div class="row"  style="margin: 45px" id="st">
                        <h4>Last Bill</h4>
                        <hr/>
                        <div class="col-md-12">
                            <?php
                            if($_POST['type'] == "billno")
                            {
                                $data = $obj->my_select("tbl_bill",NULL,array("bill_id"=>$_POST['id']));
                                $cc = $obj->my_query("SELECT COUNT(bill_id) as mx FROM tbl_bill WHERE bill_id = $_POST[id]")->fetch_object()->mx;
                            }
                            if($_POST['type'] == "date")
                            {
                                $data = $obj->my_select("tbl_bill",NULL,array("date"=>$_POST['id']));
                                $cc = $obj->my_query("SELECT COUNT(bill_id) as mx FROM tbl_bill WHERE bill_id = $_POST[id]")->fetch_object()->mx;
                            }
                            if($_POST['type'] == "ptype")
                            {
                                $data = $obj->my_select("tbl_bill",NULL,array("payment_type"=>$_POST['id']));
                                $cc = $obj->my_query("SELECT COUNT(bill_id) as mx FROM tbl_bill WHERE bill_id = $_POST[id]")->fetch_object()->mx;
                            }
                            if($_POST['type'] == "price")
                            {
                                if($_POST['minprice'] != "" && $_POST['maxprice'] != "")
                                {
                                    $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= $_POST[minprice] AND amount <= $_POST[maxprice]");
                                }
                                if($_POST['minprice'] == "" && $_POST['maxprice'] != "")
                                {
                                    $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= 0 AND amount <= $_POST[maxprice]");
                                }
                                if($_POST['minprice'] != "" && $_POST['maxprice'] == "")
                                {
                                    $data = $obj->my_query("SELECT * FROM `tbl_bill` WHERE amount >= $_POST[minprice]");
                                }
                            }
                            
                            while($lastbill = $data->fetch_object())
                            {
                            
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
                                } 
                                if($cc == 0)
                                    {
                                ?>
                                <center>
                                    <h1 style="color:#ddd;">No Bill Found.</h1>
                                </center>
                                <?php
                                    }
                            ?>
                        </div>
                    </div>
                </div>
<?php
    
}

if($action == "state")
{
    $d['parent_id'] = $id ;
    
    $dt = $obj->my_select("tbl_location",NULL,$d);
    ?>
<option value="">Select State</option>
        <?php
    while($row = $dt->fetch_object())
    {
?>
<option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
<?php
    }
}

if($action == "city")
{
    $d['parent_id'] = $id ;
    
    $dt = $obj->my_select("tbl_location",NULL,$d);
    ?>
<option value="">Select City</option>
        <?php
    while($row = $dt->fetch_object())
    {
?>
<option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
<?php
    }
}

if($action == "sub")
{
    $d['parent_id'] = $id ;
    
    $dt = $obj->my_select("tbl_category",NULL,$d);
    ?>
<option value="">Select Sub Category</option>
        <?php
    while($row = $dt->fetch_object())
    {
?>
<option value="<?php echo $row->category_id; ?>"><?php echo $row->name; ?></option>
<?php
    }
}
if($action == "set")
{
    $d['category_id'] = $id ;
    
    $dt = $obj->my_select("tbl_attribute_set",NULL,$d);
    ?>
<option value="">Select Attribute Set</option>
        <?php
    while($row = $dt->fetch_object())
    {
?>
<option value="<?php echo $row->attribute_set_id; ?>"><?php echo $row->set_name; ?></option>
<?php
    }
}
if($action == "att_val")
{
    if($id == "Selectbox")
    {
        ?>
<input type="text" name="att_value" tabindex="4" class="form-control" style="font-size: 13px; width: 95%"  placeholder="Enter Value (val1,val2,...)" data-bvalidator="required"/>
        <?php
        
    }
}
?>
