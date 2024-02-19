<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <div id="menu" role="navigation">
            <div class="nav_profile">
                <div class="media profile-left">
                    <div style="text-align: center;">
                        <img src="<?php echo $info->path; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" />
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
                <?php
                
                $data = $obj->my_select("tbl_seller", NULL, array("seller_id" => $_SESSION['seller']))->fetch_object();
                if($data->status == 1)
                {
                ?>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-gift"></i>
                        <span>Product</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="managenewpro.php">
                                Add New Product
                            </a>
                        </li>
                        <li>
                            <a href="manageacpro.php">
                                Active Product
                            </a>
                        </li>
                        <li>
                            <a href="managepnpro.php">
                                Pending Product
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="manageinvoices.php">
                        <i class="menu-icon fa fa-file-text-o"></i>
                        <span class="mm-text ">Invoices </span>
                    </a>
                </li>
                <li>
                    <a href="managereports.php">
                        <i class="menu-icon fa fa-print"></i>
                        <span class="mm-text ">Reports </span>
                    </a>
                </li>
                <?php
                }
                ?>
                
            </ul>
        </div>
    </section>
</aside>
