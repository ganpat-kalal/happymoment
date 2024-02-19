<?php
require_once '../connection.php';
require_once 'security.php';
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
                        Update City
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Location</a>
                        </li>
                        <li class="">
                            <a href="managecity.php">Manage City</a>
                        </li>
                        <li class="active">
                            Update City
                        </li>
                    </ol>
                </section>
                <div class="panel panel-widget">
                    <hr/>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-6">
                                <form class="comment-form respond-form" action="" method="post" id="myform">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 comment-form-name">
                                            <br/>
                                            <h4 style="font-size: 14px;">Update Country</h4>
                                            <br/>
                                            <select class="form-control" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select Country</option>
                                                <option>India</option>
                                                <option>USA</option>
                                            </select>
                                            <br/>
                                            <select class="form-control" data-bvalidator="required" style="font-size: 13px">
                                                <option value="">Select State</option>
                                                <option>gujrat</option>
                                                
                                            </select>
                                            <br/>
                                            <input type="text" class="form-control" style="font-size: 13px"  placeholder="Enter City" data-bvalidator="required"/>

                                        </div>

                                    </div>
                                    <div class="form-submit">
                                        <span class="button-set padding-30"><br/>
                                            <button  type="submit" class="btn btn-button global-bg white">Update</button>
                                        </span>
                                        <span class="button-set padding-30">
                                            <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-6">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr style="text-align: center;">
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                                                No
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                                                Country
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                                                State
                                            </th>
                                            <th style="width: 10%;text-align: center; padding-bottom: 13px;">
                                                City
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                        for ($x = 1; $x <= 10; $x++) {
                                            ?>
                                           <tr style="text-align: center;">
                                            <td style="width: 10%; padding: 0px;" >
                                                1
                                            </td>

                                            <td>
                                                India
                                            </td>
                                            <td>
                                                Gujrat
                                            </td>
                                            <td>
                                                Surat
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
        <script type="text/javascript">
            $("#myform").bValidator();
        </script>
    </body>
</html>