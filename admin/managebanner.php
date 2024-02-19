<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

if (isset($_GET['del'])) {
    $pt = $obj->my_select("tbl_banner", NULL, array("banner_id" => $_GET['del']))->fetch_object();
    unlink($pt->path);
    $obj->my_delete("tbl_banner", array("banner_id" => $_GET['del']));
    header('location:managebanner.php');
}

if (isset($_POST['upload'])) {
    //print_r($_POST);
    //print_r($_FILES['photo']);
    if ($_FILES['photo']['error'] == 0) {
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) {
            $exet = substr($_FILES['photo']['type'], 6);
            if ($exet == "jpeg" || $exet == "png") {
                $filename = "banner/" . date('d-m-y h-i-s') . "profile_" . rand(1000, 9999) . "." . $exet;
                $full_path = dirname(__FILE__) . "/../" . $filename;

                $size = $_FILES['photo']['size'] / 1024 / 1024;

                //move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                $obj->compress($_FILES['photo']['tmp_name'], $full_path, $size);

                
                $data['path'] = $filename;
                $data['status'] = "1";

                $obj->my_insert("tbl_banner", $data);
                header('location:managebanner.php');
            } 
            else {
                echo 'exet error';
            }
        } else {
            echo 'size error';
        }
    } else {
        echo "upload error";
    }
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
        <script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>
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
                        Manage Banner
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> Pages</a>
                        </li>
                        <li class="active">
                            Banner
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <form class="comment-form respond-form" enctype="multipart/form-data" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;">Add New Banner..</h4>
                                            <br/>
                                            <input type="file" multiple="" name="photo" class="form-control"  data-bvalidator="required"/>
                                            
                                        </div>
                                       <?php
                                        $data = $obj->my_select("tbl_banner");                                        
                                       ?>
                                       </div>
                                        <div class="form-submit">
                                            <span class="button-set padding-30"><br/>
                                                <button  type="submit" name="upload" class="btn btn-button global-bg white">Add</button>
                                            </span>
                                            <span class="button-set padding-30">
                                                <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                            </span>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <table class="table table-responsive nova-pagging" id="banner">
                                        <thead>
                                            <tr style="text-align: center;">
                                                <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                    No
                                                </th>
                                                <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                    Banner
                                                </th>
                                                <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                    Status
                                                </th>
                                                <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                    Remove
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                              <?php
                                                    $c=0;
                                                  while ($row = $data->fetch_object()) 
                                                  {
                                                      $c++;
                                               ?>
                                                <tr style="text-align: center;">
                                                    <td style="width: 10%; padding: 0px;" >
                                                        <?php echo $c; ?>
                                                    </td>
                                                    <td>
                                                        <img src="../<?php echo $row->path; ?>" title="Banner" style="width: 150px">
                                                    </td>
                                                    <td style="width: 10%; padding: 0px;" >
                                                        <?php
                                            if($row->status == 0)
                                            {
                                         ?>
                                         <i class="fa fa-toggle-off" title="Active Now" onclick="activation('banner','active',<?php echo $row->banner_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                            else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Block Now" onclick="activation('banner','deactive',<?php echo $row->banner_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                         ?>
                                                    </td>
                                                    <td style="width: 10%" >
                                                        <a href="managebanner.php?del=<?php echo $row->banner_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                                                    </td>
                                                </tr>
                                            
                                        <?php
                                        }
                                        ?>
                                        
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                    </div>

                </aside>
            </div>
            <div id="qn"></div>
            <?php
            require_once 'footersclink.php';
            ?>
        <script type="text/javascript">
            $("#myform").bValidator();
        </script>
    </body>
</html>