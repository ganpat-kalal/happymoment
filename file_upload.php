
<?php
require_once './connection.php';
$obj = new model();

if(isset($_GET['del']))
{
    $pt = $obj->my_select("tbl_file",NULL,array("file_id"=>$_GET['del']))->fetch_object();
    unlink($pt->path);
    $obj->my_delete("tbl_file",array("file_id"=>$_GET['del']));
    header('location:file.php');
}

if (isset($_POST['upload'])) {
    //print_r($_POST);
    //print_r($_FILES);
    if ($_FILES['photo']['error'] == 0) {
        $size_limit = 4 * 1024 * 1024;
        if ($_FILES['photo']['size'] < $size_limit) {
            $exet = substr($_FILES['photo']['type'], 6);
            if ($exet == "jpeg" || $exet == "png") {
                $filename = "image/" . date('d-m-y h-i-s') . "profile_" . rand(1000, 9999) . "." . $exet;
                $full_path = dirname(__FILE__) . "/" . $filename;

                $size = $_FILES['photo']['size'] / 1024 / 1024;

                //move_uploaded_file($_FILES['photo']['tmp_name'], $full_path);

                $obj->compress($_FILES['photo']['tmp_name'], $full_path, $size);

                $data['name'] = $_POST['name'];
                $data['path'] = $filename;

                $obj->my_insert("tbl_file", $data);
            } else {
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
<html>
    <body>
        <h1>le maro photo</h1>
        <form method="POST" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>Name</td>
                    <td>
                        <input type="text" name="name" required="" />
                    </td>
                <tr>
                    <td>Photo</td>
                    <td>
                        <input type="file" name="photo" required="" />
                    </td>
                </tr>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="upload"/>
                    </td>
                </tr>
            </table>
        </form>
        <table>
            <thead>

            <th>name</th>
            <th>Img</th>
            <th>Del</th>

            </thead>
            <tbody>
                <?php
                $dt = $obj->my_select("tbl_file");
                while ($row = $dt->fetch_object()) {
                ?>
            <tr>
                <td><?php echo $row->name; ?></td>
                <td><img src="<?php echo $row->path ?>" width="200px" /></td>
                <td><a href="file.php?del=<?php echo $row->file_id; ?>">del</a></td>
            </tr>

            <?php
            }
            ?>
            </tbody>   
        </table>
</body>
</html>