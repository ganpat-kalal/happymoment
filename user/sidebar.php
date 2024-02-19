<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <div id="menu" role="navigation">
            <div class="nav_profile">
                <div class="media profile-left">
                    <div style="text-align: center;">
                        <?php
                                $info = $obj->my_select('tbl_registration', NULL, array("registration_id" => $_SESSION['user']))->fetch_object();
                                //print_r($info);
                                if ($info->profile == "") 
                                {
                                ?>
                                    <center><img src="profile/a.jpg" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                <?php
                                } 
                                else 
                                {
                                    if ($info->autho_provider == "website") 
                                    {
                                    ?>
                                        <center><img src="user/<?php echo $info->profile; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                    <?php
                                    } 
                                    else 
                                    {
                                    ?>
                                        <center><img src="<?php echo $info->profile; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" /></center>
                                    <?php
                                    }
                                }
                                ?>
                    </div>
                    <br/>
                    <div style="text-align: center; color: white;">
                                <?php
                                $info = $obj->my_select('tbl_registration', NULL, array("registration_id" => $_SESSION['user']))->fetch_object();
                                
                                if($info->user_name == "")
                                {
                                ?>
                                <span>
                                    <b><?php echo "Not Specified"; ?></b>
                                </span>
                                <?php
                                }
                                else
                                {
                                ?>
                                
                                <span>
                                    <b style="text-transform: capitalize"><?php echo $info->user_name; ?></b>
                                </span>
                                <?php
                                
                                }
                                ?>
                            </div>
                    <div class="content-profile">
                        <h4 class="media-heading" style="text-align: center;"><?php echo $info->company_name; ?></h4>
                        <ul class="icon-list">
                            <li>
                                <span style="color: white; display: inline ">
                                    <label style="font-size: 11px;"><i class="fa fa-clock-o"></i>&nbsp;<?php echo date('d-m-Y h:i:s',strtotime($info->last_login)); ?></label>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="navigation">
                <li class="active" id="active">
                    <a href="dashboard.php">
                        <i class="menu-icon fa fa-fw fa-dashboard"></i>
                        <span class="mm-text ">Dashboard </span>
                    </a>
                </li>
                <li>
                    <a href="myprofile.php">
                        <i class="menu-icon fa fa-home"></i>
                        <span class="mm-text ">My Profile </span>
                    </a>
                </li>
                <li>
                    <a href="mywishlist.php">
                        <i class="menu-icon fa fa-heart"></i>
                        <span class="mm-text ">My WishList </span>
                    </a>
                </li>
<!--                <li>
                    <a href="mycart.php">
                        <i class="menu-icon fa fa-shopping-cart"></i>
                        <span class="mm-text ">My Cart </span>
                    </a>
                </li>-->
                <li>
                    <a href="myaddress.php">
                        <i class="menu-icon fa fa-map-marker"></i>
                        <span class="mm-text ">My Address </span>
                    </a>
                </li>
                <li>
                    <a href="myinvoice.php">
                        <i class="menu-icon fa fa-print"></i>
                        <span class="mm-text ">Invoices</span>
                    </a>
                </li>
                <li>
                    <a href="myinorders.php">
                        <i class="menu-icon fa fa-shopping-cart"></i>
                        <span class="mm-text ">My Orders</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
</aside>
