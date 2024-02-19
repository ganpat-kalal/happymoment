<aside class="left-side sidebar-offcanvas">
    <section class="sidebar">
        <div id="menu" role="navigation">
            <div class="nav_profile">
                <div class="media profile-left">
                    <div style="text-align: center;">
                        <?php
                            $dt = $obj->my_select("tbl_admin_login",NULL,array("admin_login_id"=>$_SESSION['admin']))->fetch_object();
                        ?>
                        <img src="<?php echo $dt->path; ?>" style="width: 100px;height: 100px;border-radius: 150px;border:2px solid #fff;padding: 3px;" />
                    </div>
                    <div class="content-profile">
                        <h4 class="media-heading" style="text-align: center;">Administration Panel</h4>
                        <ul class="icon-list">
                            <li>
                                <span style="color: white; display: inline ">
                                    <label style="font-size: 11px;"><i class="fa fa-clock-o"></i>&nbsp;<?php echo date('d-m-Y h:i:s',strtotime($dt->last_login)) ; ?></label>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <ul class="navigation">
                <li class="active" id="active">
                    <a href="dashboard.php">
                        <i class="menu-icon fa fa-fw fa-home"></i>
                        <span class="mm-text ">Dashboard </span>
                    </a>
                </li>
                <li id="active">
                    <a href="managepro.php">
                        <i class="menu-icon fa fa-gift"></i>
                        <span class="mm-text ">Products</span>
                    </a>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-user"></i>
                        <span>User</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="managemember.php">
                                Member
                            </a>
                        </li>
                        <li>
                            <a href="manageseller.php">
                                Seller
                            </a>
                        </li>
                        </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-gift"></i>
                        <span>Category & Att.</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="managemain.php">
                                Main Category
                            </a>
                        </li>
                        <li>
                            <a href="managesub.php">
                                Sub Category
                            </a>
                        </li>
                        <li>
                            <a href="managepeta.php">
                                Peta Category
                            </a>
                        </li>
                        <li>
                            <a href="manageattribute_set.php">
                                Attribute Set
                            </a>
                        </li>
                        <li>
                            <a href="manageattribute.php">
                                Attribute
                            </a>
                        </li>
                        <li>
                            <a href="managespecialattribute.php">
                                Special Attribute
                            </a>
                        </li>
                        <li>
                            <a href="managepromo.php">
                                Promo Code
                            </a>
                        </li>
                        <li>
                            <a href="manageoffer.php">
                                Offer
                            </a>
                        </li>
                        <li>
                            <a href="managereview.php">
                                Reviews
                            </a>
                        </li>
                        <li>
                            <a href="manageprofit_rate.php">
                                Profit Rate
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-map-marker"></i>
                        <span>Location</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="managecountry.php">
                                Country
                            </a>
                        </li>
                        <li>
                            <a href="managestate.php">
                                State
                            </a>
                        </li>
                        <li>
                            <a href="managecity.php">
                                City
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-files-o"></i>
                        <span>Pages</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="managecontact.php">
                                Contact Us
                            </a>
                        </li>
                        <li>
                            <a href="managefeedback.php">
                                Feedback
                            </a>
                        </li>
                        <li>
                            <a href="managesubscriber.php">
                                E-mail Subscriber
                            </a>
                        </li>
                        <li>
                            <a href="managebanner.php">
                                Banner
                            </a>
                        </li>
                    </ul>
                </li>
                <li id="active">
                    <a href="manageinvoice.php">
                        <i class="menu-icon fa fa-file"></i>
                        <span class="mm-text ">Invoices</span>
                    </a>
                </li>
                <li id="active">
                    <a href="managereports.php">
                        <i class="menu-icon fa fa-file-o"></i>
                        <span class="mm-text ">Reports</span>
                    </a>
                </li>
                <!--<li>
                    <a href="index2.html">
                        <i class="menu-icon fa fa-fw fa-tachometer"></i>
                        <span class="mm-text ">Dashboard V2</span>
                    </a>
                </li> 
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-check-square"></i>
                        <span>Forms</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="form_elements.html">
                                <i class="fa fa-fw fa-fire"></i> Form Elements
                            </a>
                        </li>
                        <li>
                            <a href="form_editors.html">
                                <i class="fa fa-fw fa-file-text-o"></i> Form Editors
                            </a>
                        </li>
                        <li>
                            <a href="form_validations.html">
                                <i class="fa fa-fw fa-warning"></i> Form Validations
                            </a>
                        </li>
                        <li>
                            <a href="form_layouts.html">
                                <i class="fa fa-fw fa-fire"></i> Form Layouts
                            </a>
                        </li>
                        <li>
                            <a href="form_wizards.html">
                                <i class="fa fa-fw fa-cog"></i> Form Wizards
                            </a>
                        </li>
                        <li>
                            <a href="complex_forms.html">
                                <i class="fa fa-fw fa-newspaper-o"></i> Complex Forms
                            </a>
                        </li>
                        <li>
                            <a href="complex_forms2.html">
                                <i class="fa fa-fw fa-newspaper-o"></i> Complex Forms 2
                            </a>
                        </li>
                        <li>
                            <a href="radio_checkboxes.html">
                                <i class="fa fa-fw fa-check-square-o"></i> Radio and Checkbox
                            </a>
                        </li>
                        <li>
                            <a href="dropdowns.html">
                                <i class="fa fa-fw fa-chevron-circle-down"></i> Drop Downs
                            </a>
                        </li>
                        <li>
                            <a href="datepicker.html">
                                <i class="fa fa-fw fa-calendar-o"></i> Date pickers
                            </a>
                        </li>
                        <li>
                            <a href="advanceddate_pickers.html">
                                <i class="fa fa-fw fa-calendar"></i> Advanced Date pickers
                            </a>
                        </li>
                        <li>
                            <a href="x-editable.html">
                                <i class="fa fa-fw fa-eyedropper"></i> X-editable
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span>
                            UI Features
                        </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="general_components.html">
                                <i class="fa fa-fw fa-plug"></i> General Components
                            </a>
                        </li>
                        <li>
                            <a href="pickers.html">
                                <i class="fa fa-fw fa-paint-brush"></i> Pickers
                            </a>
                        </li>
                        <li>
                            <a href="buttons.html">
                                <i class="fa fa-fw fa-delicious"></i> Buttons
                            </a>
                        </li>
                        <li>
                            <a href="tabs_accordions.html">
                                <i class="fa fa-fw fa-copy"></i> Tabs &amp; Accordions
                            </a>
                        </li>
                        <li>
                            <a href="fonts.html">
                                <i class="fa fa-fw fa-font"></i> Font Icons
                            </a>
                        </li>
                        <li>
                            <a href="grid_layout.html"><i class="fa fa-fw fa-columns"></i> Grid Layout
                            </a>
                        </li>
                        <li>
                            <a href="advanced_modals.html">
                                <i class="fa fa-fw fa-suitcase"></i> Advanced Modals
                            </a>
                        </li>
                        <li>
                            <a href="gridstack.html">
                                <i class="fa fa-fw fa-slack"></i> Grid Stack
                            </a>
                        </li>
                        <li>
                            <a href="tags_input.html">
                                <i class="fa fa-fw fa-tag"></i> Tags Input
                            </a>
                        </li>
                        <li>
                            <a href="nestable_list.html">
                                <i class="fa fa-fw fa-navicon"></i> Nestable List
                            </a>
                        </li>
                        <li>
                            <a href="sweet_alert.html">
                                <i class="fa fa-fw fa-bell"></i> Sweet Alert
                            </a>
                        </li>
                        <li>
                            <a href="toastr_notifications.html">
                                <i class="fa fa-fw fa-desktop"></i> Toastr Notifications
                            </a>
                        </li>
                        <li>
                            <a href="notifications.html">
                                <i class="fa fa-fw fa-flag"></i> Notifications
                            </a>
                        </li>
                        <li>
                            <a href="session_timeout.html">
                                <i class="fa fa-fw fa-rocket"></i> Session Timeout
                            </a>
                        </li>
                        <li>
                            <a href="draggable_portlets.html">
                                <i class="fa fa-fw fa-random"></i> Draggable Portlets
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-briefcase"></i>
                        <span>
                            UI Components
                        </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="timeline.html">
                                <i class="fa fa-fw fa-clock-o"></i> Timeline
                            </a>
                        </li>
                        <li>
                            <a href="transitions.html">
                                <i class="fa fa-fw fa-star-half-empty"></i> Transitions
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#"> <i class="menu-icon fa fa-table"></i>
                        <span>DataTables</span>
                        <span class="fa arrow">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="simple_tables.html">
                                <i class="fa fa-fw fa-tasks"></i> Simple tables
                            </a>
                        </li>
                        <li>
                            <a href="datatables.html">
                                <i class="fa fa-fw fa-database"></i> Data Tables
                            </a>
                        </li>
                        <li>
                            <a href="advanced_datatables.html">
                                <i class="fa fa-fw fa-table"></i> Advanced Tables
                            </a>
                        </li>
                        <li>
                            <a href="responsive_datatables.html">
                                <i class="fa fa-fw fa-table"></i> Responsive DataTables
                            </a>
                        </li>
                        <li>
                            <a href="bootstrap_tables.html">
                                <i class="fa fa-fw fa-table"></i> Bootstrap Tables
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#"> <i class="menu-icon fa fa-bar-chart-o"></i>
                        <span>Charts</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="flot_charts.html">
                                <i class="fa fa-fw fa-area-chart"></i> Flot Charts
                            </a>
                        </li>
                        <li>
                            <a href="nvd3_charts.html">
                                <i class="fa fa-fw fa-line-chart"></i> NVD3 Charts
                            </a>
                        </li>
                        <li>
                            <a href="circle_sliders.html">
                                <i class="fa fa-fw fa-sun-o"></i> Circle Sliders
                            </a>
                        </li>
                        <li>
                            <a href="chartjs_charts.html">
                                <i class="fa fa-fw fa-pie-chart"></i> Chartjs Charts
                            </a>
                        </li>
                        <li>
                            <a href="dimple_charts.html">
                                <i class="fa fa-fw fa-area-chart"></i> Dimple Charts
                            </a>
                        </li>
                        <li>
                            <a href="amcharts.html">
                                <i class="fa fa-fw fa-line-chart"></i> Amcharts
                            </a>
                        </li>
                        <li>
                            <a href="chartist.html">
                                <i class="fa fa-fw fa-bar-chart"></i> Chartist Charts
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-fw fa-calendar"></i>
                        <span>Calendar</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="calendar.html">
                                <i class=" menu-icon fa fa-fw fa-calendar"></i>
                                <span>Calendar</span>
                                <small class="badge">7</small>
                            </a>
                        </li>
                        <li>
                            <a href="calendar2.html">
                                <i class=" menu-icon fa fa-fw fa-calendar-o"></i>
                                <span>Advanced Calendar</span>
                                <small class="badge">6</small>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-fw fa-photo"></i>
                        <span>Gallery</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="masonry_gallery.html">
                                <i class="fa fa-fw fa-file-image-o"></i> Masonry Gallery
                            </a>
                        </li>
                        <li>
                            <a href="multiplefile_upload.html">
                                <i class="fa fa-fw fa-cloud-upload"></i> Multiple File Upload
                            </a>
                        </li>
                        <li>
                            <a href="dropify.html">
                                <i class="fa fa-fw fa-dropbox"></i> Dropify
                            </a>
                        </li>
                        <li>
                            <a href="image_hover.html">
                                <i class="fa fa-file-image-o"></i> Image Hover
                            </a>
                        </li>
                        <li>
                            <a href="image_filter.html">
                                <i class="fa fa-filter"></i> Image Filter
                            </a>
                        </li>
                        <li>
                            <a href="image_magnifier.html">
                                <i class="fa  fa-search-plus"></i> Image Magnifier
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-fw fa-users"></i>
                        <span>Users</span> <span
                            class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="users.html">
                                <i class="fa fa-list" aria-hidden="true"></i> Users List
                            </a>
                        </li>
                        <li>
                            <a href="addnew_user.html">
                                <i class="fa fa-fw fa-user"></i> Add New User
                            </a>
                        </li>
                        <li>
                            <a href="user_profile.html">
                                <i class="fa fa-fw fa-user-md"></i> View Profile
                            </a>
                        </li>
                        <li>
                            <a href="deleted_users.html">
                                <i class="fa fa-fw fa-times"></i> Deleted Users
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-map-marker"></i>
                        <span>Maps</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="google_maps.html">
                                <i class="fa fa-fw fa-globe"></i> Google Maps
                            </a>
                        </li>
                        <li>
                            <a href="vector_maps.html">
                                <i class="fa fa-fw fa-map-marker"></i> Vector Maps
                            </a>
                        </li>
                        <li>
                            <a href="advanced_maps.html">
                                <i class="fa fa-fw fa-location-arrow"></i> Advanced Maps
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-th"></i>
                        <span>Layouts</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="menubarfold.html">
                                <i class="fa fa-fw fa-list-alt"></i> Menubar Fold
                            </a>
                        </li>
                        <li>
                            <a href="layout_horizontal_menu.html">
                                <i class="fa fa-fw fa-bars"></i> Horizontal Menu
                            </a>
                        </li>
                        <li>
                            <a href="boxed.html">
                                <i class="fa fa-fw fa-th-large"></i> Boxed Layout
                            </a>
                        </li>
                        <li>
                            <a href="layout_fixed_header.html">
                                <i class="fa fa-fw fa-th-list"></i> Fixed Header
                            </a>
                        </li>
                        <li>
                            <a href="layout_boxed_fixed_header.html">
                                <i class="fa fa-fw fa-th"></i> Boxed &amp; Fixed Header
                            </a>
                        </li>
                        <li>
                            <a href="layout_fixed.html">
                                <i class="fa fa-fw fa-indent"></i> Fixed Header &amp; Menu
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-dropdown">
                    <a href="#">
                        <i class="menu-icon fa fa-sitemap"></i>
                        <span>
                            Menu levels
                        </span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-fw fa-sitemap"></i> Level 1
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu sub-submenu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                        <span class="fa arrow"></span>
                                    </a>
                                    <ul class="sub-menu sub-submenu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-fw fa-sitemap"></i> Level 3
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-fw fa-sitemap"></i> Level 3
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-fw fa-sitemap"></i> Level 3
                                                <span class="fa arrow"></span>
                                            </a>
                                            <ul class="sub-menu sub-submenu">
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-fw fa-sitemap"></i> Level 4
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-fw fa-sitemap"></i> Level 4
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <i class="fa fa-fw fa-sitemap"></i> Level 4
                                                        <span class="fa arrow"></span>
                                                    </a>
                                                    <ul class="sub-menu sub-submenu">
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-fw fa-sitemap"></i> Level 5
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-fw fa-sitemap"></i> Level 5
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="#">
                                                                <i class="fa fa-fw fa-sitemap"></i> Level 5
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-fw fa-sitemap"></i> Level 4
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                        <span class="fa arrow"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-fw fa-sitemap"></i> Level 1
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-fw fa-sitemap"></i> Level 1
                                <span class="fa arrow"></span>
                            </a>
                            <ul class="sub-menu sub-submenu">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                        <span class="fa arrow"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                        <span class="fa arrow"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-fw fa-sitemap"></i> Level 2
                                        <span class="fa arrow"></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>-->
            </ul>
        </div>
    </section>
</aside>
