<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <div style="padding-left: 15px; ">
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw fa-bars"></i></a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <div class="riot">
                            <div style="text-transform: capitalize">
                                <?php
                                $info = $obj->my_select('tbl_registration', NULL, array("registration_id" => $_SESSION['user']))->fetch_object();
                                
                                if($info->user_name == "")
                                {
                                ?>
                                <span>
                                <?php echo "Not Specified"; ?> <i class="caret"></i>
                                </span>
                                <?php
                                }
                                else
                                {
                                ?>
                                
                                <span>
                                <?php echo $info->user_name; ?> <i class="caret"></i>
                                </span>
                                <?php
                                }
                                ?>
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