<?php

session_start();
error_reporting(0);
define('ENCRYPTION_KEY', 'dfsdfsfsdfvsgsdhgbdsxfgesdgvsdxd');
date_default_timezone_set("Asia/kolkata");
class model {

    private $con;

    public function __construct() {
        $this->con = new mysqli("localhost", "root", "", "happymoment");
    }

    public function sendmail($email, $subject, $msg)
    {
        require_once './PHPMailerAutoload.php';

            $mail = new PHPMailer;

            $mail->isSMTP();                            // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                     // Enable SMTP authentication
            $mail->Username = 'happymoment0000@gmail.com';          // SMTP username
            $mail->Password = '000000000000'; // SMTP password
            $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                          // TCP port to connect to

            $mail->setFrom('happymoment0000@gmail.com', 'Happy Moment');
            $mail->addReplyTo('happymoment0000@gmail.com', 'Happy Moment');
            $mail->addAddress($email);   // Add a recipient

            $mail->isHTML(true);  // Set email format to HTML

            $bodyContent = '<div style=" padding:15px; "><p style="padding:10px 0px;">Dear Customer,</p><p style = "padding:2px 0px;"> Your forgotten password is as follow. Please Next time be carefull.</p><div style = "display:inline-flex;"><p style = "padding:2px 0px;">Your Password : ';
            $bodyContent.=$msg;
            $bodyContent .= '</p></div></div>';

            $mail->Subject = $subject;
            $mail->Body = $bodyContent;

            if (!$mail->send()) 
            {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            }
    }
    
    public function my_insert($table, $data) {
        $k = array_keys($data);
        $v = array_values($data);

        $key = implode("`,`", $k);
        $val = implode("','", $v);

        $q = "INSERT INTO `$table` (`$key`) VALUES ('$val')";
        return $this->con->query($q);
    }
    
  
    public function my_select($table, $field = NULL, $where = NULL, $op = "AND") {

        if (isset($field)) {
            $ff = implode("`,`", $field);

            $q = "SELECT `$ff` FROM `$table`";
        } else {
            $q = "SELECT * FROM `$table`";
        }

        if (isset($where)) {
            $q = $q . " WHERE ";

            foreach ($where as $key => $val) {
                $q .= " `" . $key . "` = '" . $val . "' " . $op;
                //`lable`='country' and
            }
            //echo $q;
            $q = rtrim($q, $op);
            //echo $q;
        }
        //echo $q;
        return $this->con->query($q);
    }
  
     public function my_update($tbl, $set, $where) {
        $q = "UPDATE `$tbl` SET ";
        foreach ($set as $key => $val) {
            $q.=" `$key` = '$val' ,";
        }
        $q=rtrim($q,',');
         $q = $q . " WHERE ";

            foreach ($where as $key => $val) {
                $q.=" `$key` = '$val' AND";
            }
            $q = rtrim($q, "AND");
      //echo $q;      
        
    return $this->con->query($q);

    }

    function my_delete($table, $where) {
        $q = "DELETE FROM $table";

        $q .= " WHERE ";
        foreach ($where as $key => $val) {
            $q .= "`" . $key . "` = '" . $val . "'" . "AND";
        }
        $q = rtrim($q, "AND");

        return $this->con->query($q);
    }

    function count_record($table, $where) {
        // SELECT count(*) FROM table

        $q = "SELECT COUNT(*) AS cn FROM `$table` WHERE";
        foreach ($where as $key => $val) {
            $q .= "`" . $key . "` = '" . $val . "'" . " AND";
        }
        $q = rtrim($q, "AND");

        $ans = $this->con->query($q);
        //print_r($ans);

        $rec = $ans->fetch_object();

        return $rec->cn;
    }

    public function my_query($query) {
        return $this->con->query($query);
    }

    function compress($source, $destination, $size) {

        $info = getimagesize($source);

        ini_set('memory_limit', '-1');
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif')
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png')
            $image = imagecreatefrompng($source);

        if ($size >= 4)
            $quality = 10;
        else if ($size >= 3)
            $quality = 20;
        else if ($size >= 2)
            $quality = 30;
        else if ($size >= 1)
            $quality = 40;
        else
            $quality = 100;

        imagejpeg($image, $destination, $quality);

        return $destination;
    }

    function encrypt($encrypt) {
        $key = ENCRYPTION_KEY;
        $encrypt = serialize($encrypt);
        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);
        $key = pack('H*', $key);
        $mac = hash_hmac('sha256', $encrypt, substr(bin2hex($key), -32));
        $passcrypt = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $encrypt . $mac, MCRYPT_MODE_CBC, $iv);
        $encoded = base64_encode($passcrypt) . '|' . base64_encode($iv);
        return $encoded;
    }

    function decrypt($decrypt) {
        $key = ENCRYPTION_KEY;
        $decrypt = explode('|', $decrypt . '|');
        $decoded = base64_decode($decrypt[0]);
        $iv = base64_decode($decrypt[1]);
        if (strlen($iv) !== mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC)) {
            return false;
        }
        $key = pack('H*', $key);
        $decrypted = trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $decoded, MCRYPT_MODE_CBC, $iv));
        $mac = substr($decrypted, -64);
        $decrypted = substr($decrypted, 0, -64);
        $calcmac = hash_hmac('sha256', $decrypted, substr(bin2hex($key), -32));
        if ($calcmac !== $mac) {
            return false;
        }
        $decrypted = unserialize($decrypted);
        return $decrypted;
    }

    function mailer($sender,$senderpassword,$receiver,$title,$msg)
    {
        require_once './PHPMailerAutoload.php';
        $mail = new PHPMailer;

        $mail->isSMTP();                            // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                     // Enable SMTP authentication
        $mail->Username = $sender;          // SMTP username
        $mail->Password = $senderpassword; // SMTP password
        $mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;                          // TCP port to connect to

        $mail->setFrom($sender, 'Happy Moment');
        $mail->addReplyTo($sender, 'Happy Moment');
        $mail->addAddress($receiver);   // Add a recipient
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        $mail->isHTML(true);  // Set email format to HTML

        $mail->Subject = $title;
        $mail->Body = $msg;

        if(!$mail->send()) 
        {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            echo 'Message has been sent';
        }    
        
    }
    
}

$l = new model();

$off = $l->my_select("tbl_offer");

while($offer = $off->fetch_object())
{
   $today = date('Y-m-d');
   
   if($today >= $offer->start_date)
   {
        $l->my_update("tbl_offer", array("status"=>1), array("offer_id"=>$offer->offer_id));
        
        $all = $l->my_select("tbl_product", NULL, array("status" => 1));
        
        while($alll = $all->fetch_object())
        {
            $min = $offer->min_price;
            $max = $offer->max_price;
            $id = $offer->offer_id;
            $cat = $offer->category_id;
            
            if($offer->category_id == 0)
            {
                $l->my_query("UPDATE tbl_product SET offer_id = $id WHERE status = 1 AND price >= $min AND price <= $max");
            }
            else 
            {
                $l->my_query("UPDATE tbl_product SET offer_id = $id WHERE status = 1 AND price >= $min AND price <= $max AND category_id = $cat");
            }
        }
        
   }
   if($today > $offer->end_date)
   {
        $l->my_update("tbl_offer", array("status"=>0), array("offer_id"=>$offer->offer_id));
   
        $l->my_update("tbl_product", array("offer_id"=> 0), array("offer_id"=>$offer->offer_id));
   }
}

?>