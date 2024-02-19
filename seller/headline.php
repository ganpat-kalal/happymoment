<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <div style="padding-left: 15px; ">
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw fa-bars"></i></a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li>
                    <div style="width: 300px;margin-top: 17px;">
                        <?php
                        $data = $obj->my_select("tbl_seller", NULL, array("seller_id" => $_SESSION['seller']))->fetch_object();
                        if ($data->status == 0) {
                            ?>
                            <marquee style="color: #fff;">Your are not verified by admin now. You can upload products after admin verification.</marquee>
                            <?php
                        }
                        ?>
                    </div>
                </li>
                <!-- User Account: style can be found in dropdown-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <div class="riot">
                            <div>
                                <?php
                                $info = $obj->my_select('tbl_seller', NULL, array("seller_id" => $_SESSION['seller']))->fetch_object();
                                ?>
                                <span>
                                    <?php echo $info->company_name; ?> <i class="caret"></i>
                                </span>
                            </div>
                        </div>
                    </a>
                    <ul class="dropdown-menu">

                        <li class="p-t-3">
                            <a href="setting.php">
                                <i class="fa fa-fw fa-gear"></i> Setting
                            </a>
                        </li>
                        <li role="presentation"></li>
                        <li>
                            <a href="logout.php">
                                <i class="fa fa-fw fa-sign-out"></i> Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>