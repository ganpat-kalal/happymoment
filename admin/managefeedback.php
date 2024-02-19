<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

$data = $obj->my_select("tbl_feedback");                        

if(isset($_GET['del']))
{
    $where['feedback_id']=$_GET['del'];
    $obj->my_delete("tbl_feedback", $where);
    header('location:managefeedback.php');
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
                        Manage Feedbacks
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="active">
                            Feedback
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-body">
                        <table class="table table-responsive nova-pagging">
                            <thead>
                                <tr style="text-align: center;">
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        No.
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="yes">
                                        Name
                                    </th>
                                    <th style="width: 50%;text-align: center;" nova-search="yes">
                                        Message
                                    </th>
                                    <th style="width: 10%;text-align: center;" nova-search="no">
                                        Remove
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $c = 0;
                            
                            while($row = $data->fetch_object()) 
                            {
                                $c++;
                            ?>
                            
                            <tr>
                                <td style="width: 10%;text-align: center;">
                                    <?php echo $c; ?>
                                </td style="width: 10%;text-align: center;">
                                <td style="width: 10%;text-align: center;">
                                    <?php echo $row->feedback_name; ?>
                                </td>
                                <td style="width: 10%;text-align: center;">
                                    <?php echo $row->msg; ?>
                                </td>
                                <td style="width: 10%;text-align: center;">
                                    <a href="managefeedback.php?del=<?php echo $row->feedback_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove" title="Remove"></i></a>
                                </td>
                            </tr>
                            
                            <?php
                            }
                            ?>
                            </tbody>
                            <!--<tbody>
                                <tr style="text-align: center;">
                                    <td style="width: 10%">
                                        1
                                    </td>
                                    <td style="width: 10%">
                                        Ankit Ramani
                                    </td>
                                      <td style="width: 50%">
                                        Hi sddf adewtrdrghg vgrf   frerewrewr xdsrd sferetret dsrestertretertret sdfs aseaweawe sferetret dsrestertretertret sdfs aseaweawesferetret dsrestertretertret sdfs aseaweawesferetret dsrestertretertret sdfs aseaweawe
                                    </td>
                                    <td style="width: 10%" >
                                        <i class="fa fa-recycle remove"  title="Remove"></i>
                                    </td>
                                </tr>
                                <tr style="text-align: center;">
                                    <td style="width: 10%">
                                        2
                                    </td>
                                    <td style="width: 10%">
                                        Ankit Ramani
                                    </td>
                                    <td style="width: 50%">
                                        Hi sddf adewtrdrghg vgrf   frerewrewr xdsrd sferetret dsrestertretertret sdfs aseaweawe sferetret dsrestertretertret sdfs aseaweawesferetret dsrestertretertret sdfs aseaweawesferetret dsrestertretertret sdfs aseaweawe
                                    </td>
                                    <td style="width: 10%">
                                        <i class="fa fa-recycle remove" title="Remove"></i>
                                    </td>
                                </tr>
                            </tbody>-->
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