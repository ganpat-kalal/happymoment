<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();
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
                        Manage Active Products
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Product</a>
                        </li>
                        <li class="active">
                            Active Products
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-body">
                        <table class="table table-responsive nova-pagging" id="stock_status">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Product Code
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Name 
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Photo
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Detail
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Out of Stock ?
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 0;
                                $data = $obj->my_select("tbl_product",NULL,array("status"=>1,"seller_id"=>$_SESSION['seller']));
                                while ($row = $data->fetch_object()) {
                                    $c++;
                                    ?>
                                <tr style="text-align: center;">
                                    <td style="width: 10%">
                                        <?php echo $c; ?>
                                    </td>
                                    <td style="width: 10%">
                                        <?php echo $row->product_code; ?>
                                    </td>
                                    <td style="width: 20%">
                                        <?php echo $row->product_name; ?>
                                    </td>
                                    <td style="width: 10%">
                                    <?php
                                        $img = $obj->my_select("tbl_product_image",NULL,array("product_id"=>$row->product_id))->fetch_object();
                                        $imgg = $img->path;
                                        
                                        $imggg =  explode(",", $imgg);
                                        ?>
                                        <img src="../seller/<?php echo $imggg[0];?>" style="width: 80px;height: 80px;padding: 3px;" /></td>
                                    <td style="width: 10%" >
                                        <?php echo $row->description; ?>
                                    </td>
                                    <td style="width: 10%">
                                         <?php
                                            if($row->stock_status == 0)
                                            {
                                         ?>
                                         <i class="fa fa-toggle-off" title="No" onclick="activations('stock_status','active',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                            else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Yes" onclick="activations('stock_status','deactive',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                         ?>
                                         
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