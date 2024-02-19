<?php
require_once './connection.php';
$obj = new model();
?>
<div class="header-menu bunker-color-bg">
    <div class="container">
        <div class="nav-container">
            <nav class="navigation" id="sf-menu">
                <ul class="sf-menu sf-js-enabled sf-arrow">
                    <li class="active sfish-menu">
                        <a href="index.php"><i class="fa fa-home" aria-hidden="true"></i></i></a>
                    </li>
                    <li class="megamenu"> 
                        <?php
                        $main = $obj->my_select("tbl_category", NULL, array("name" => "Cake"))->fetch_object();
                        ?>
                        <a href="product.php?id=<?php echo $main->category_id; ?>">CAKE</a>
                        <ul class="mmenuffect" style="width: 70%">
                            <li class="row">
                                <div>
                                    <?php
                                    $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                    while ($subb = $sub->fetch_object()) {
                                        ?>
                                        <div class="col-md-3 col-sm-6" style="font-size: 12px !important; width: 25%">
                                            <a class="sub-heading" href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>"><span><?php echo $subb->name; ?></span></a>
                                            <ul>
                                                <?php
                                                $c = 1;
                                                $peta = $obj->my_select("tbl_category", NUll, array("parent_id" => $subb->category_id));
                                                while ($petaa = $peta->fetch_object()) {
                                                    if ($c < 6) {
                                                        $c++;
                                                        ?>
                                                        <li>
                                                            <a href="product.php?id=<?php echo $main->category_id; ?>&peta=<?php echo $petaa->category_id ?>"><?php echo $petaa->name; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>" >All <?php echo $subb->name; ?> ..</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="megamenu"> 
                        <?php
                            $main = $obj->my_select("tbl_category", NULL, array("name" => "Gift"))->fetch_object();
                        ?>
                        <a href="product.php?id=<?php echo $main->category_id; ?>">GIFT</a>
                        <ul class="mmenuffect" style="width: 70%">
                            <li class="row">
                                <div>
                                    <?php
                                    $x = 0;
                                    $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                    while ($subb = $sub->fetch_object()) 
                                    {
                                        $x++;
                                        if($x <= 3)
                                        {
                                        ?>
                                        <div class="col-md-3 col-sm-6" style="font-size: 12px !important; width: 25%">
                                            <a class="sub-heading" href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>"><span><?php echo $subb->name; ?></span></a>
                                            <ul>
                                                <?php
                                                $c = 1;
                                                $peta = $obj->my_select("tbl_category", NUll, array("parent_id" => $subb->category_id));
                                                while ($petaa = $peta->fetch_object()) {
                                                    if ($c < 6) {
                                                        $c++;
                                                        ?>
                                                        <li>
                                                            <a href="product.php?id=<?php echo $main->category_id; ?>&peta=<?php echo $petaa->category_id ?>"><?php echo $petaa->name; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>">All <?php echo $subb->name; ?> ..</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                        }
                                    }
                                    ?>
                                    <div class="col-md-3 col-sm-6" style="font-size: 12px !important; width: 25%">
                                            <ul>
                                                <?php
                                                $c = 1;
                                                $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                                while ($subb = $sub->fetch_object()) {
                                                    if ($c < 9) 
                                                    {
                                                        $c++;
                                                        if($c <=4)
                                                        {
                                                            continue;
                                                        }
                                                        ?>
                                                        <li>
                                                            <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id; ?>"><b><?php echo $subb->name; ?></b></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <a href="product.php?id=<?php echo $main->category_id; ?>">All <?php echo $main->name; ?> ..</a>
                                                </li>
                                            </ul>
                                        </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="megamenu"> 
                        <?php
                            $main = $obj->my_select("tbl_category", NULL, array("name" => "Flowers"))->fetch_object();
                        ?>
                        <a href="product.php?id=<?php echo $main->category_id; ?>">FLOWERS</a>
                        <ul class="mmenuffect" style="width: 70%">
                            <li class="row">
                                <div>
                                    <?php
                                    $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                    while ($subb = $sub->fetch_object()) {
                                        ?>
                                        <div class="col-md-3 col-sm-6" style="font-size: 12px !important; width: 20%">
                                            <a class="sub-heading" href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>"><span><?php echo $subb->name; ?></span></a>
                                            <ul>
                                                <?php
                                                $c = 1;
                                                $peta = $obj->my_select("tbl_category", NUll, array("parent_id" => $subb->category_id));
                                                while ($petaa = $peta->fetch_object()) {
                                                    if ($c < 6) {
                                                        $c++;
                                                        ?>
                                                        <li>
                                                            <a href="product.php?id=<?php echo $main->category_id; ?>&peta=<?php echo $petaa->category_id ?>"><?php echo $petaa->name; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>">All <?php echo $subb->name; ?> ..</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="megamenu"> 
                        <?php
                        $main = $obj->my_select("tbl_category", NULL, array("name" => "Occasions"))->fetch_object();
                        ?>
                        <a href="product.php?id=<?php echo $main->category_id; ?>">OCCASION</a>
                        <ul class="mmenuffect" style="width: 70%">
                            <li class="row">
                                <div>
                                    <?php
                                    $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                    while ($subb = $sub->fetch_object()) {
                                        ?>
                                        <div class="col-md-3 col-sm-6" style="font-size: 12px !important; width: 25%">
                                            <a class="sub-heading" href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>"><span><?php echo $subb->name; ?></span></a>
                                            <ul>
                                                <?php
                                                $c = 1;
                                                $peta = $obj->my_select("tbl_category", NUll, array("parent_id" => $subb->category_id));
                                                while ($petaa = $peta->fetch_object()) {
                                                    if ($c < 6) {
                                                        $c++;
                                                        ?>
                                                        <li>
                                                            <a href="product.php?id=<?php echo $main->category_id; ?>&peta=<?php echo $petaa->category_id ?>"><?php echo $petaa->name; ?></a>
                                                        </li>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                <li>
                                                    <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>">All <?php echo $subb->name; ?> ..</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="megamenu"> 
                        <?php
                            $main = $obj->my_select("tbl_category", NULL, array("name" => "Combos"))->fetch_object();
                        ?>
                        <a href="product.php?id=<?php echo $main->category_id; ?>">COMBOS</a>
                        <ul class="mmenuffect" style="width: 25%">
                            <li class="row">
                                <div class="col-md-12">
                                    <ul>
                                        <?php
                                        $sub = $obj->my_select("tbl_category", NULL, array("parent_id" => $main->category_id));
                                        while ($subb = $sub->fetch_object()) {
                                            ?>
                                            <li>
                                                <a href="product.php?id=<?php echo $main->category_id; ?>&sub=<?php echo $subb->category_id ?>"><?php echo $subb->name; ?></a>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        <li>
                                            <a href="product.php?id=<?php echo $main->category_id; ?>">All <?php echo $subb->name; ?> ..</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>