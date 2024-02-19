<?php
require_once '../connection.php';
require_once 'security.php';
$obj = new model();

$data = $obj->my_select("tbl_seller",NULL,array("seller_id"=>$_SESSION['seller_id']))->fetch_object();

if($data->status==0)
{
    header('location:dashboard.php');
}
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
                        Add New Product
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">
                                <i class="fa fa-fw fa-home"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#">Product</a>
                        </li>
                        <li class="active">
                            Add New Product
                        </li>
                    </ol>
                </section>
                <hr/>
                <div style="border: 1px solid #ddd; margin: 30px">
                    <form class="comment-form respond-form" action="" method="post" id="myform" style="background-color: #F5F5F5">
                        <div class="row" >
                            <div class="col-md-6">
                                <div style="margin: 10px; font-size: 20px">Product Details</div>
                                <select class="form-control" data-bvalidator="required" onchange="set_combo('sub', this.value)" style="font-size: 13px; width:500px; margin: 15px ">
                                    <option value="">Select Main Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Sub Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Peta Category</option>

                                </select>
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <input type="text" class="form-control" name="p_code" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Code" data-bvalidator="required,alphanum"/>
                                <div class="form-submit" style="margin-left: 20px; padding-bottom: 10px">
                                    <span class="button-set padding-30"><br/>
                                        <button  type="submit" name="sub" class="btn btn-button global-bg white">Set Specification</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <textarea rows="6" placeholder="Description" name="desc" style="font-size: 13px; width:450px; margin-top: 52px;" class="form-control border-radius" data-bvalidator="required"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="border: 1px solid #ddd; margin: 30px">
                    <form class="comment-form respond-form" action="" method="post" id="myform" style="background-color: #F5F5F5">
                        <div class="row" >
                            <div class="col-md-6">
                                <div style="margin: 10px; font-size: 20px">Highlights</div>
                                <hr/>
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <select class="form-control" data-bvalidator="required" onchange="set_combo('sub', this.value)" style="font-size: 13px; width:500px; margin: 15px ">
                                    <option value="">Select Main Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Sub Category</option>

                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 450px; margin: 15px; margin-top: 78px;"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <lable  style="font-size: 13px; width: 450px; margin: 15px;">Washable:<input type="radio" style="margin-left: 10px"/> Yes<input type="radio" style="margin-left: 10px"/> No</lable>
                            </div>
                        </div>
                        <br/>
                        <div class="row" >
                            <div class="col-md-6">
                                <div style="margin: 10px; font-size: 20px">Highlights</div>
                                <hr/>
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <select class="form-control" data-bvalidator="required" onchange="set_combo('sub', this.value)" style="font-size: 13px; width:500px; margin: 15px ">
                                    <option value="">Select Main Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Sub Category</option>

                                </select>
                                <div class="form-submit" style="margin-left: 20px; padding-bottom: 10px">
                                    <span class="button-set padding-30">
                                        <button  type="button" name="back" class="btn btn-button global-bg white">< Back</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="submit" name="sub" class="btn btn-button global-bg white">Set Image</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 450px; margin: 15px; margin-top: 78px;"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <lable  style="font-size: 13px; width: 450px; margin: 15px;">Washable:<input type="radio" style="margin-left: 10px"/> Yes<input type="radio" style="margin-left: 10px"/> No</lable>
                            </div>
                        </div>
                    </form>
                </div>
                <div style="border: 1px solid #ddd; margin: 30px">
                    <form class="comment-form respond-form" action="" method="post" id="myform" style="background-color: #F5F5F5">
                        <div class="row" >
                            <div class="col-md-6">
                                <div style="margin: 10px; font-size: 20px">Product Details</div>
                                <select class="form-control" data-bvalidator="required" onchange="set_combo('sub', this.value)" style="font-size: 13px; width:500px; margin: 15px ">
                                    <option value="">Select Main Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Sub Category</option>

                                </select>
                                <select class="form-control" name="sub" id="sub" data-bvalidator="required" style="font-size: 13px; width:500px; margin: 15px">
                                    <option value="">Select Peta Category</option>

                                </select>
                                <input type="text" class="form-control" name="name" style="font-size: 13px; width: 500px; margin: 15px"  placeholder="Enter Product Name" data-bvalidator="required,alphanum"/>
                                <div class="form-submit" style="margin-left: 20px; padding-bottom: 10px">
                                    <span class="button-set padding-30">
                                        <button  type="button" name="back" class="btn btn-button global-bg white">< Back</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="submit" name="add" class="btn btn-button global-bg white">Add</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="submit" name="finish" class="btn btn-button global-bg white">Finish</button>
                                    </span>
                                    <span class="button-set padding-30">
                                        <button  type="reset" class="btn btn-button global-bg white">Clear</button>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <img src="profile/profile_0.jpeg" style="font-size: 13px; width: 150px; margin: 15px; margin-top: 52px;" />
                                <input type="file" name="photo" class="form-control" style="font-size: 13px; width: 450px; margin: 11px;" id="file" data-bvalidator="required"/>
                            </div>
                        </div>
                    </form>
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