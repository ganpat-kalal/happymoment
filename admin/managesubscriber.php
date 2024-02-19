<?php
require_once '../connection.php';
require_once 'security.php';

$obj = new model();

if(isset($_GET['del']))
{
    $where['email_subscriber_id']=$_GET['del'];
    $obj->my_delete("tbl_email_subscribers", $where);
    header('location:managesubscriber.php');
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
                        Manage E-mail Subscriber                    
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home" title="Dashboard"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Pages</a>
                        </li>
                        <li class="active">
                            E-mail Subscriber
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 comment-form-name">
                                            <br/>
                                            <input type="text" style="width:214%;"value="" class="form-control border-radius" data-bvalidator="required,alpha" placeholder="Title" name="author" id="author">
                                        </div><br/><br/><br/><br/>
                                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-12">
                                            <div class="comment-form-comment">
                                                <textarea style="resize: none"id='editor1' rows="8" cols="40" name="comment" id="comment" data-bvalidator="required" placeholder="Message" class="form-control border-radius"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" class="btn btn-button global-bg white">Send</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <table class="table table-responsive nova-pagging">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding: 0px;">
                                                <div class="todoitemcheck checkbox checkbox-info">                                                    
                                                    <input type="checkbox" class="striked styled">                                                    
                                                    <label></label>                                                
                                                </div>
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;" nova-search="yes">
                                                E-mail
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px" nova-search="no">
                                                Remove
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                            <?php
                                                $c = 0;
                                                $data = $obj->my_select("tbl_email_subscribers");
                                                while ($row = $data->fetch_object()) 
                                                {
                                                $c++;
                                            ?>
                                        <tr style="text-align: center;">
                                            <td style="width: 10%; padding: 0px;" >
                                                <div class="todoitemcheck checkbox checkbox-info">
                                                    <input type="checkbox" class="striked styled">
                                                    <label>
                                                    </label>
                                                </div>
                                            </td>
                                            <td style="width: 10%; padding: 0px;" >
                                                <?php echo $c; ?>
                                            </td>
                                            <td style="width: 10%; padding: 0px;">
                                               <?php echo $row->email; ?>
                                            </td>
                                            <td style="width: 10%; padding: 0px;" >
                                                <a href="managesubscriber.php?del=<?php echo $row->email_subscriber_id; ?>" onclick="return confirm('Are you sure want to delete ?');"><i class="fa fa-recycle remove"  title="Remove"></i></a>
                                            </td>
                                        </tr>   
                                        <?PHP
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
        <script src="ckeditor/ckeditor.js" type="text/javascript"></script>
        <script type="text/javascript">
            CKEDITOR.replace(editor1);
            $("#myform").bValidator();
        </script>
    </body>
</html>