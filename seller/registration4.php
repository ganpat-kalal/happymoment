<?php
require_once '../connection.php';
$obj = new model();

if(!isset($_SESSION['bank_benificiary_name']))
{
    header('location:index.php');
}

if(isset($_POST['btn'])) 
{
    
    
    $data['company_name'] = $_SESSION['company_name'];
    $data['email'] = $_SESSION['email'];
    $data['password'] = $obj->encrypt($_SESSION['password']);
    $data['contact_no'] = $_SESSION['contact_no'];
    $data['pincode'] = $_POST['pincode'];
    $data['pan'] = $_SESSION['pan'];
    $data['tin_no'] = $_SESSION['tin_no'];
    $data['address'] = $_POST['address'];
    $data['location_id'] = $_POST['location_id'];
    $data['bank_benificiary_name'] = $_SESSION['bank_benificiary_name'];
    $data['ifsc_code'] = $_SESSION['ifsc_code'];
    $data['bank_name'] = $_SESSION['bank_name'];
    $data['branch_name'] = $_SESSION['branch_name'];
    $data['ac_no'] = $_SESSION['a/c_no'];
    $data['status'] = 0;
    $data['path'] = $_SESSION['path'];
    $data['stock_status'] = 0;
    
    
    $obj->my_insert("tbl_seller", $data);
    $s = $obj->my_select("tbl_seller",NULL,array('email'=>$_SESSION['email']))->fetch_object();
    
    $_SESSION['seller'] = $s->seller_id;
    $_SESSION['lastlogin'] = date('Y-m-d h:i:s');
    
    unset($_SESSION['company_name']);
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    unset($_SESSION['contact_no']);
    unset($_SESSION['pan']);
    unset($_SESSION['tin_no']);
    unset($_SESSION['bank_benificiary_name']);
    unset($_SESSION['ifsc_code']);
    unset($_SESSION['bank_name']);
    unset($_SESSION['branch_name']);
    unset($_SESSION['a/c_no']);
    unset($_SESSION['path']);
        
    header('location:dashboard.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sell Product on Happy Moment</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?php
        require_once 'headlink.php';
        ?>
    </head>
    <body class="" style="background-image: url('../image/back.jpg') !important;background-size: 100% 100%;min-height: 662px;">
        <div class="container-fluid">
            <div class="row">
                <form action="" method="post" id="myform">
                <div class="col-md-4 col-md-offset-1">
                    <div class="admin-login" style="background: rgba(0,0,0,0.1)">
                        <div class="admin-login-heading">
                            <h1 style="color: white"><b>Welcome, <?php echo $_SESSION['company_name']; ?></b></h1>
                        </div>
                        <div style="padding: 20px;padding-bottom: 0px;">
                            <div class="form-group" >
                                <select class="form-control"  data-bvalidator="required" name="country" onchange="set_seller_combo('state', this.value);" style="font-size: 13px;padding: 05px;" >
                                    <option value="">Select Country</option> 
                                    <?php
                                    $cn = $obj->my_select("tbl_location", NULL, array('lable' => "country"));
                                    while ($row = $cn->fetch_object()) {
                                        ?>
                                        <option value="<?php echo $row->location_id; ?>"><?php echo $row->name; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group" >
                                <select class="form-control" data-bvalidator="required" name="state" onchange="set_seller_combo('city',this.value);" id="state" style="font-size: 13px;padding: 05px;" >
                                    <option value="">Select State</option>   
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control"  data-bvalidator="required" id="city" name="location_id" style="font-size: 13px;padding: 05px;" >
                                    <option value="">Select City</option>   
                                </select>
                            </div>
                            <div class="form-group" >
                                <textarea rows="5" cols="40" class="form-control"  data-bvalidator="required" name="address" placeholder="Pickup Address" style="font-size: 13px;padding: 05px;resize:none;"></textarea>
                            </div>
                            <div class="form-group" >
                                <input type="text" class="form-control"  data-bvalidator="required,digit" name="pincode" placeholder="Pincode" style="font-size: 13px;padding: 05px;" />
                            </div>
                            <div style="padding: 20px;padding-top: 0px;">
                                <div class="form-group">
                                    <input type="submit" name="btn" value="Go to Seller Panel" class="btn btn-primary btn-block"/>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
                </form>
            </div>
        </div>
        <?php
        require_once './scriptlink.php';
        ?>
        <script type="text/javascript">


            $(document).ready(function () {
                c = 0;
                $("#ps-btn").click(function () {

                    if (c == 0)
                    {
                        $("#ps").attr('type', 'text');
                        $("#ps-btn").attr('class', 'fa fa-unlock');
                        c = 1;
                    } else
                    {
                        $("#ps").attr('type', 'password');
                        $("#ps-btn").attr('class', 'fa fa-lock');
                        c = 0;
                    }
                });


            });


        </script>
    </body>
</html>