<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_GET['del']))
{
    $id = $_GET['del'];
    $all = $obj->my_select("tbl_product_image",NULL,array("product_id"=>$id));
    while ($pt = $all->fetch_object())
    {
        $arr = explode(",", $pt->path);
        foreach ($arr as $value) 
        {
            unlink("../seller/product".$value);
        }
    }
    $obj->my_delete("tbl_product", array("product_id"=>$id));
    $obj->my_delete("tbl_product_image", array("product_id"=>$id));
    $obj->my_delete("tbl_attribute_value", array("product_id"=>$id));
    
    header('location:managepro.php');
}

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
                        <table class="table table-responsive nova-pagging" id="product">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Seller Name
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Product Code
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Product Name
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Photo 
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Price
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Status
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Remove
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 0;
                                $data = $obj->my_select("tbl_product");
                                while ($row = $data->fetch_object()) {
                                    $c++;
                                    ?>
                                <tr style="text-align: center;">
                                    <td style="width: 10%"> 
                                        <?php echo $c; ?>
                                    </td>
                                    <td style="width: 10%">
                                    <?php
                                        $sname = $obj->my_select("tbl_seller",NULL,array("seller_id"=>$row->seller_id))->fetch_object();
                                        echo $name = $sname->company_name;
                                        ?>
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
                                        <?php echo $row->price; ?>
                                    </td>
                                    <td style="width: 10%">
                                        <?php
                                            if($row->status == 0)
                                            {
                                         ?>
                                        <i class="fa fa-toggle-off" title="Active Now" onclick="activation('product','active',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                            else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Block Now" onclick="activation('product','deactive',<?php echo $row->product_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                         ?>
                                    </td>
                                    <td style="width: 10%">
                                        <a href="managepro.php?del=<?php echo $row->product_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a> 
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