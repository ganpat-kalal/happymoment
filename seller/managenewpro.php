<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$data = $obj->my_select("tbl_seller", NULL, array("seller_id" => $_SESSION['seller']))->fetch_object();

if ($data->status == 0) {
    header('location:dashboard.php');
}


if (isset($_POST['add_product'])) {
    
    $cc['product_code'] = $_POST['product_code'];
    
    $count = $obj->count_record("tbl_product", $cc);
    if($count == 0)
    {
    $da['product_name'] = $_POST['product_name'];
    $da['description'] = $_POST['description'];
    $da['price'] = $_POST['price'];
    $da['product_code'] = $_POST['product_code'];
    $da['status'] = 0;
    $da['seller_id'] = $_SESSION['seller'];
    $da['category_id'] = $_POST['peta'];
    $db['tag'] = $_POST['tag'];
    //print_r($data);
    //die();
    $ins = $obj->my_insert("tbl_product", $da);
    $s = $_SESSION['seller'];

    $lpro = $obj->my_query("SELECT * FROM tbl_product WHERE seller_id = $s ORDER BY product_id DESC LIMIT 0,1")->fetch_object();
    
    $db['product_id'] = $lpro->product_id;
    $db['tag'] = $_POST['tag'];
    $inss = $obj->my_insert("tbl_tag", $db);
    $step = 2;
    }
    else
    {
        $errr =  $_POST['product_code']." is already exists.";
    }
}

if (isset($_POST['add_att'])) {
    $s = $_SESSION['seller'];

    $lpro = $obj->my_query("SELECT * FROM tbl_product WHERE seller_id = $s ORDER BY product_id DESC LIMIT 0,1")->fetch_object();

    //print_r($_POST);
    foreach ($_POST as $attid => $value) 
    {
        if ($value != "") 
        {
            $att_data['attribute_id'] = $attid;
            $att_data['value'] = $value;
            $att_data['product_id'] = $lpro->product_id;

            $ans = $obj->my_insert("tbl_attribute_value", $att_data);
            
            if ($ans == 0) 
            {
                $cc = 1;
            }
        }
    }
    if ($cc == 1) {
        $err = "Please Insert Valid Specification";
    } else {
        $_SESSION['step'] = 3;
    }
}

if (isset($_POST['add_image'])) 
{
    $sp_id = "";
    $sp_v = "";
    foreach ($_POST as $key => $value) {
        if ($value != "") {
            $sp_id = $sp_id . "," . $key;
            //print_r($key ."=". $value);
            foreach ($value as $v) {
                $sp_v = $sp_v . "," . $v;
            }
        }
    }

    $sp_id = ltrim($sp_id, ",");
    $sp_id = rtrim($sp_id, ",qty");

    $sp_v = ltrim($sp_v, ",");
    //echo $sp_v;

    $s = $_SESSION['seller'];
    $llpro = $obj->my_query("SELECT * FROM tbl_product WHERE seller_id = $s ORDER BY product_id DESC LIMIT 0,1")->fetch_object();


    $qq['product_id'] = $llpro->product_id;
    $qq['value'] = $sp_v;


    $ccc = $obj->count_record("tbl_product_image", $qq);

    if ($ccc == 0) {
        $path = "";

        for ($i = 0; $i < count($_FILES['product']['name']); $i++) {
            if ($_FILES['product']['error'][$i] == 0) {
                $size_limit = 4 * 1024 * 1024;
                if ($_FILES['product']['size'][$i] < $size_limit) {
                    $exet = substr($_FILES['product']['type'][$i], 6);
                    if ($exet == "jpeg") {
                        $filename = "product/product_" . $llpro->product_id . "_" . rand(10000, 99999) . "." . $exet;

                        $full_path = dirname(__FILE__) . "/" . $filename;

                        $size = $_FILES['product']['size'][$i] / 1024 / 1024;

                        $obj->compress($_FILES['product']['tmp_name'][$i], $full_path, $size);

                        $path = $path . "," . $filename;
                    } else {
                        $err = 'Only .jpeg profile Allow.';
                        break;
                    }
                } else {
                    $err = 'Maximum 4 MB Size Allow';
                    break;
                }
            }
        }
        $pathh = ltrim($path, ",");

        $www['product_id'] = $llpro->product_id;
        $www['sp_attribute_id'] = $sp_id;
        $www['value'] = $sp_v;
        $www['path'] = $pathh;
        $www['qty'] = $_POST['qty'];

        $agg = $obj->my_insert("tbl_product_image", $www);
    } else {
        $spvv = explode(",", $sp_v);
        $rrr = $spvv[0] . " & " . $spvv[1] . " is already exist";
    }
}


if (isset($step)) {
    $_SESSION['step'] = $step;
} else {
    $step = 1;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Seller Panel</title>
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
                        Add New Product
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Product</a>
                        </li>
                        <li class="active">
                            Add New Product
                        </li>
                    </ol>
                </section>
                <hr/>
                <?php
                if ($step == 1 && $_SESSION['step'] == "") {
                    ?>
                    <div style="border: 1px solid #ddd; margin: 30px">
                        <form class="comment-form respond-form" action="" method="post" id="myform" style="background-color: #F5F5F5">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div style="margin: 10px; font-size: 20px">Product Details</div>
                                    <select class="form-control" tabindex="1" name="main" onchange="set_seller_combo('sub', this.value);" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px ">
                                        <option value="">Select Main Category</option>
                                        <?php
                                        $data = $obj->my_select("tbl_category", NULL, array('label' => "maincategory"));

                                        while ($row = $data->fetch_object()) {
                                            ?>
                                            <option value="<?php echo $row->category_id; ?>" ><?php echo $row->name; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                    <select class="form-control" name="sub" tabindex="2" id="sub"  onchange="set_seller_combo('peta', this.value);" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px ">
                                        <option value="">Select Sub Category</option>

                                    </select>
                                    <select class="form-control" name="peta" id="peta" tabindex="3" style="font-size: 13px; width:500px; margin: 15px ">
                                        <option value="">Select Peta Category</option>

                                    </select>
                                    <input type="text" class="form-control" name="product_name" tabindex="4" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                    <input type="text" class="form-control" name="product_code" tabindex="6" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Code" data-bvalidator="required,alphanum"/>
                                    <input type="text" class="form-control" name="tag" tabindex="6" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Searching Tags (tag1,tag2,tag3,...)" data-bvalidator="required"/>
                                    <input type="number" class="form-control" name="price" tabindex="5" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Price" data-bvalidator="required,digit"/>
                                    <p style="font-size: 11px; margin: 15px">NOTE : Here, Price is gross price, profit of admin will be added in your above price.</p>
                                    <div class="form-submit" style="margin-left: 20px; padding-bottom: 10px">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" name="add_product" tabindex="8" class="btn btn-button global-bg white">Set Specification</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" tabindex="9" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <?php
                                        if (isset($errr)) {
                                            ?>    
                                            <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $errr; ?></span>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div><b>Discription :</b></div>
                                    <textarea rows="6" id="editor1" tabindex="7" placeholder="Description" name="description" style="font-size: 13px; width:450px; margin-top: 52px;" class="form-control border-radius" data-bvalidator="required"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                if ($_SESSION['step'] == 2) {
                    $seller = $_SESSION['seller'];
                    $lastproduct = $obj->my_query("SELECT * FROM tbl_product WHERE seller_id = $seller ORDER BY product_id DESC LIMIT 0,1")->fetch_object();
                    //echo $lastproduct->category_id;
                    $peta = $obj->my_select("tbl_category", NULL, array("category_id" => $lastproduct->category_id))->fetch_object();
                    $sub = $peta->parent_id;
                    ?>
                    <div style="border: 1px solid #ddd; margin: 30px">
                        <form class="comment-form respond-form" action="" method="post" id="myform" style="background-color: #F5F5F5">
                            <div class="row" >
                                <?php
                                $set = $obj->my_select("tbl_attribute_set", NULL, array("category_id" => $sub));
                                while ($sett = $set->fetch_object()) {
                                    ?>
                                    <div class="col-md-6" style="border-right: 1px solid #ddd">
                                        <div style="margin: 10px; font-size: 20px"><?php echo $sett->set_name; ?></div>
                                        <hr/>
                                        <?php
                                        $attribute = $obj->my_select("tbl_attribute", NULL, array("attribute_set_id" => $sett->attribute_set_id));

                                        while ($attributee = $attribute->fetch_object()) {
                                            if ($attributee->att_type == "Textbox") {
                                                ?>
                                                <input type="text" class="form-control" name="<?php echo $attributee->attribute_id; ?>" style="font-size: 13px; width: 450px; margin-left: 25px"  placeholder="<?php echo $attributee->att_name; ?>"/>
                                                <br/>
                                                <?php
                                            }
                                            if ($attributee->att_type == "Selectbox") {
                                                ?>
                                                <select class="form-control" name="<?php echo $attributee->attribute_id; ?>" style="font-size: 13px; width:450px; margin-left: 25px ">
                                                    <option value=""><?php echo $attributee->att_name; ?></option>
                                                    <?php
                                                    $select_val = explode(",", $attributee->value);
                                                    foreach ($select_val as $val) {
                                                        ?>
                                                        <option><?php echo $val; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                                </select>
                                                <br/>
                                                <?php
                                            }
                                            if ($attributee->att_type == "Boolean") {
                                                ?>
                                                <div style="font-size: 13px; width:450px; margin-left: 25px "> 
                                                    <?php echo $attributee->att_name; ?> :
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?php echo $attributee->attribute_id; ?>" value="yes">&nbsp;Yes
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="<?php echo $attributee->attribute_id; ?>" value="no">&nbsp;No
                                                </div>
                                                <br/>
                                                <br/>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <br/>
                            <div class="row" >
                                <div class="col-md-6">

                                    <div class="form-submit" style="margin-left: 30px; padding-bottom: 10px;">
                                        <span class="button-set padding-30">
                                            <button type="button" onclick="mybtn('backform1');" onclick="back_product();" class="btn btn-button global-bg white">< Back</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="submit" name="add_att" class="btn btn-button global-bg white">Set Image</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <?php
                                        if (isset($err)) {
                                            ?>    
                                            <span style="color: red;font-size: 12px;">&nbsp;&nbsp;&nbsp;<?php echo $err; ?></span>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                if ($_SESSION['step'] == 3) {
                    $seller = $_SESSION['seller'];
                    $llpro = $obj->my_query("SELECT * FROM tbl_product WHERE seller_id = $seller ORDER BY product_id DESC LIMIT 0,1")->fetch_object();
                    //echo $lastproduct->category_id;
                    $peta = $obj->my_select("tbl_category", NULL, array("category_id" => $llpro->category_id))->fetch_object();
                    $sub = $peta->parent_id;
                    ?>
                    <div style="border: 1px solid #ddd; margin: 30px">
                        <form class="comment-form respond-form" action="" method="post" enctype="multipart/form-data" id="myform" style="background-color: #F5F5F5">
                            <div class="row" >
                                <div class="col-md-6">
                                    <div style="margin: 10px; font-size: 20px">Product Details</div>
                                    <input type="text" class="form-control" value="<?php echo $llpro->product_name; ?>"  disabled="" style="font-size: 13px; width: 500px; margin: 15px"/>
                                    <?php
                                    $sp_att = $obj->my_select("tbl_sp_attribute", NULL, array("category_id" => $sub));

                                    while ($sp_attt = $sp_att->fetch_object()) {
                                        ?>
                                        <select class="form-control" name="<?php echo $sp_attt->sp_attribute_id; ?>[]" style="font-size: 13px; width:500px; margin: 15px ">
                                            <option value=""><?php echo $sp_attt->sp_name; ?></option>
                                            <?php
                                            $sp_att_val = explode(",", $sp_attt->sp_value);
                                            foreach ($sp_att_val as $v) {
                                                ?>
                                                <option><?php echo $v; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                    }
                                    ?>
                                    <input type="text" name="qty" class="form-control" placeholder="Stock" style="font-size: 13px; width: 500px; margin: 15px"/>

                                    <div class="form-submit" style="margin-left: 20px; padding-bottom: 10px">
                                        <span class="button-set padding-30">
                                            <button  type="button" onclick="mybtn('backform2');" class="btn btn-button global-bg white">< Back</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="submit" name="add_image" class="btn btn-button global-bg white">Add</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="button" name="finish" onclick="mybtn('finish');" class="btn btn-button global-bg white">Finish</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                        <?php
                                        if (isset($rrr)) 
                                        {
                                            echo "<span style='color: red;font-size: 12px;'>&nbsp;&nbsp;&nbsp; " . $rrr . ".</span>";
                                        }
                                        if(isset($agg))
                                        {
                                            if($agg == 1)
                                            {
                                                echo "<span style='color: green;font-size: 12px;'>&nbsp;&nbsp;&nbsp; Product Upload Successfully.</span>";
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fl" style="width: 100%; cursor: pointer">
                                    <div id="picture" style="border: 2px dashed #555; width: 95%; min-height: 180px; margin-top: 52px">
                                        <br/>
                                        <h1 style="font-size: 20px; text-align: center; color: #555">Choose multiple product's images</h1>
                                        <br/>
                                        <br/>
                                        <center><font style="font-size: 18px;"><i class="fa fa-upload"></i> Click Here</font></center>
                                    </div></label>
                                    <input type="file" id="fl" onchange="multi_pic(this);" name="product[]" multiple="" class="form-control" style="display: none; font-size: 13px; width: 450px; margin: 11px;"  data-bvalidator="required"/>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
                ?>
            </aside>
        </div>
        <div id="qn"></div>
        <?php
        require_once 'footersclink.php';
        ?>
        <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
        <script type="text/javascript">
            CKEDITOR.replace('editor1');
            $("#myform").bValidator();
            function multi_pic(a)
            {
                if (a.files && a.files[0]) {
                    
                    $("#picture").html("");
                    for (i = 0; i < a.files.length; i++)
                    {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $("#picture").append("<img src ='" + e.target.result + "' class='product-grid' />");
                        }
                        reader.readAsDataURL(a.files[i]);
                    }
                }
            }

        </script>
    </body>
</html>