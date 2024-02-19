<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Panel</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
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
                        Manage Sellers
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">User</a>
                        </li>
                        <li class="active">
                            Seller
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-body">
                        <table class="table table-responsive nova-pagging" id="seller">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Profile 
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Company
                                    </th>
                                     <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Email
                                    </th>
                                     <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Contact no
                                    </th>
                                     <th style="width: 10%;text-align: center;" nova-search="yes">
                                         City
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Status
                                    </th>
                                     <th style="width: 20%;text-align: center;" nova-search="no">
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
                                         <img title="<?php echo $row->company_name; ?>" src="../seller/<?php echo $row->path;?>" style="width: 40px;height: 40px;border-radius: 40px; padding: 3px;" />
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
                                        $ct = $obj->my_select("tbl_location",NULL,array("location_id"=>$row->location_id))->fetch_object();
                                        echo $ct->name; ?>
                                    </td>
                                     <td style="width: 10%">
                                         <?php
                                            if($row->status == 0)
                                            {
                                         ?>
                                         <i class="fa fa-toggle-off" title="Active Now" onclick="activation('seller','active',<?php echo $row->seller_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                            else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Block Now" onclick="activation('seller','deactive',<?php echo $row->seller_id; ?>);" style="font-size:15px; cursor: pointer"></i>
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
                        </table>
                    </div>
                </div>

            </aside>
            </div>
            <div id="qn"></div>
            <?php
            require_once 'footersclink.php';
            ?>

    </body>
</html>