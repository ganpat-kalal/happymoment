<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();
$data = $obj->my_select("tbl_registration");
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
                        Manage Members
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#"> Users</a>
                        </li>
                        <li class="active">
                            Member
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-heading">
                        <h3 class="panel-title">Members</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-responsive nova-pagging" id="user">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Autho. Provider
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
                                        Contact no
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Status
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $c = 0;

                                while ($row = $data->fetch_object()) {
                                    $c++;
                                    ?>
                                    <tr style="text-align: center;">
                                        <td style="width: 10%">
                                            <?php echo $c; ?>
                                        </td>
                                        <td>
                                            <?php echo $row->autho_provider; ?>
                                        </td>
                                        <td style="width: 10%">
                                            <img src="<?php if($row->profile == ""){echo "profile/a.jpg";}else{echo $row->profile;} ?>" style="width: 40px;height: 40px;border-radius: 40px; padding: 3px;" />
                                        </td>
                                        <td style="width: 20%">
                                            <?php if($row->user_name==""){echo "Not Specified";}{echo $row->user_name;} ?>
                                        </td>

                                        <td style="width: 10%" >
                                            <?php echo $row->email; ?>
                                        </td>
                                        <td style="width: 10%">
                                            <?php if($row->contact_number==""){echo "Not Specified";}{echo $row->contact_number;} ?>
                                        </td>
                                        <td style="width: 10%">
                                            <?php
                                            if($row->status == 0)
                                            {
                                         ?>
                                         <i class="fa fa-toggle-off" title="Active Now" onclick="activation('user','active',<?php echo $row->registration_id; ?>);" style="font-size:15px; cursor: pointer"></i>
                                         <?php
                                            }
                                            else
                                            {
                                         ?>
                                         <i class="fa fa-toggle-on" title="Block Now" onclick="activation('user','deactive',<?php echo $row->registration_id; ?>);" style="font-size:15px; cursor: pointer"></i>
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