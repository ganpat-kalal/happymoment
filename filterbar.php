<?php
$obj = new model();
?>
<aside class="col-sm-4 col-md-3 col-lg-3 left-column">
    <!-- Categoty menu -->

        <section class="category-menu">
            <div class="bunker-color-bg">
                <div class="category-hadding">
                    <h2><span class="fa fa-list"></span>
                        Categories
                    </h2>
                </div>
                <div class="category-meni-content">
                    <ul class="accordion">
                        <li><a href="index.php">Home</a></li>
                        <?php
                        //echo $_POST['id'];
                        $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $_GET['id']));
                        while ($subb = $sub->fetch_object()) {
                            ?>
                            <li class="parent">
                                <a href="#"><?php echo $subb->name; ?></a>
                                <ul>
                                    <?php
                                    $peta = $obj->my_select("tbl_category", NULL, array("parent_id" => $subb->category_id));
                                    while ($petaa = $peta->fetch_object()) {
                                        ?>
                                    <li><a href="#"><label style="cursor: pointer"><input type="checkbox" name="peta[]" value="<?php echo $petaa->category_id; ?>" />&nbsp;&nbsp;<?php echo $petaa->name; ?></label></a></li>
                                        <?php
                                    }
                                    ?>
                                </ul>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Category menu -->
        <!-- specification -->
        <section class="catalog-area padding-30">
            <div class="catalog-inner">
                <div class="toprate-hadding product-heading">
                    <h2 class="no-margin">
                        <span class="text-bold">specification</span>
                    </h2>
                </div>

                <div class="catalog-box">
                    <div class="catalog-price-box">
                        <div class="catalog-title" style="font-size: 18px">Price</div>
                        <div class="price-box">
                            <?php
                            $profit = $obj->my_query("SELECT profit_rate FROM `tbl_profit_rate`")->fetch_object()->profit_rate;
                            ?>
                            <div style="margin: 5px">
                                <input type="text" class="form-control" value="₹ 0 - ₹ 500" readonly style="width: 150px"/><input value="((pro.price+(pro.price*<?php echo $profit ?>)/100) <= 500)" name="price" type="checkbox" style="height: 20px; width: 20px;float: left; background: black; color: white;margin-top: -30px;margin-left: 164px;" />
                            </div>
                            <div style="margin: 5px">
                                <input type="text" class="form-control" value="₹ 500 - ₹ 1000" readonly style="width: 150px"/><input value="((pro.price+(pro.price*<?php echo $profit ?>)/100) > 500 AND (pro.price+(pro.price*<?php echo $profit ?>)/100) <= 1000)" name="price" type="checkbox" style="height: 20px; width: 20px;float: left; background: black; color: white;margin-top: -30px;margin-left: 164px;" />
                            </div>
                            <div style="margin: 5px">
                                <input type="text" class="form-control" value="₹ 1000 - ₹ 2000" readonly style="width: 150px"/><input value="((pro.price+(pro.price*<?php echo $profit ?>)/100) > 1000 AND (pro.price+(pro.price*<?php echo $profit ?>)/100) <= 2000)" name="price" type="checkbox" style="height: 20px; width: 20px;float: left; background: black; color: white;margin-top: -30px;margin-left: 164px;" />
                            </div>
                            <div style="margin: 5px">
                                <input type="text" class="form-control" value="₹ 2000 - ₹ 3000" readonly style="width: 150px"/><input value="((pro.price+(pro.price*<?php echo $profit ?>)/100) > 2000 AND (pro.price+(pro.price*<?php echo $profit ?>)/100) <= 3000)" name="price" type="checkbox" style="height: 20px; width: 20px;float: left; background: black; color: white;margin-top: -30px;margin-left: 164px;" />
                            </div>
                            <div style="margin: 5px">
                                <input type="text" class="form-control" value="₹ 3000 & more" readonly style="width: 150px"/><input value="((pro.price+(pro.price*<?php echo $profit ?>)/100) >= 3000)" name="price" type="checkbox" style="height: 20px; width: 20px;float: left; background: black; color: white;margin-top: -30px;margin-left: 164px;" />
                            </div>
                        </div>
                    </div>
                    <?php
                    $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $_GET['id']))->fetch_object();
                    //print_r($sub);
                    $atts = $obj->my_select("tbl_attribute_set", NULL, array("category_id" => $sub->category_id))->fetch_object();
                    //print_r($atts);
                    $value = $obj->my_select("tbl_attribute", NULL, array("attribute_set_id" => $atts->attribute_set_id));
                    //print_r($value);
                    $cn = 0;
                    while ($val = $value->fetch_object()) {
                        $cn++;
                        $value1 = explode(",", $val->value);
                        //print_r($val);
                        ?>
                        <div class="catalog-size-box">
                            <?php
                            if ($_GET['id'] == 1) {
                                ?>
                                <div class="catalog-title" style="font-size: 18px"><?php echo $val->att_name; ?></div>
                                <div class="size-box">
                                    <ul>
                                        <?php
                                        foreach ($value1 as $values) {
                                            ?>
                                        <li><a href="#"><span style="width: 152px; margin: 3px"><center>&nbsp;&nbsp;<?php echo $values; ?></center></span><input type="checkbox" name="values<?php echo $cn; ?>[]" value="<?php echo $values; ?>" style="margin-left: 11px;height: 20px;width:20px"/></a></li>
                                                            <?php
                                                        }
                                                        ?>    
                                    </ul>
                                </div>
                                <?php
                            }
                            ?>    
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </section>
    <!-- / catalog -->
</aside>