<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_GET['del']))
{
    $where['review_id']=$_GET['del'];
    $obj->my_delete("tbl_review", $where);
    header('location:managereview.php');
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
                        Manage Reviews
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> Product</a>
                        </li>
                        <li class="active">
                            Reviews
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reviews</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive nova-pagging" id="review">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Profile
                                    </th>
                                    <th style="width: 20%;text-align: center;" nova-search="yes">
                                        Name
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Email
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Review
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
                                    $data = $obj->my_select("tbl_review");
                                    while ($row = $data->fetch_object()) 
                                    {
                                        $c++;
                                ?>
                                        
                                <tr style="text-align: center;">
                                    <td style="width: 10%">
                                        <?php echo $c ?>
                                    </td>
                                    <td>
                                        <?php
                                        $img = $obj->my_select("tbl_registration",NULL,array("registration_id"=>$row->registration_id))->fetch_object();
                                        if ($img->profile == "") 
                                        {
                                        ?>
                                        <img src="../user/profile/a.jpg" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                        <?php
                                        } 
                                        else 
                                        {
                                            if ($us->autho_provider == "website") 
                                            {
                                        ?>
                                            <img src="../user/<?php echo $img->profile; ?>" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                            <?php
                                            } 
                                            else 
                                            {
                                            ?>
                                            <img src="<?php echo $img->profile; ?>" style="width: 40px;height: 40px;border-radius: 40px;padding: 3px;" />
                                        <?php
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td style="width: 10%">
                                        <?php if($img->user_name==""){echo "Not Specified";}{echo $img->user_name;} ?>
                                    </td>
                                    <td style="width: 20%">
                                        <?php echo $img->email; ?>
                                    </td>
                                    <td style="width: 20%">
                                        <?php echo $row->review; ?>
                                    </td>
                                    <td style="width: 10%">
                                         <?php
                                            if($row->status == 0)
                                            {
                                         ?>
                                         <i class="fa fa-toggle-off" title="Active Now" onclick="activation('review','active',<?php echo $row->review_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                           else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Block Now" onclick="activation('review','deactive',<?php echo $row->review_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                         ?>
                                    </td>
                                    <td style="width: 10%">
                                        <a href="managereview.php?del=<?php echo $row->review_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a> 
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