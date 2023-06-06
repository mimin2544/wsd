<?php 
require_once('connect.php');

if (isset($_REQUEST['update_id'])) {
    try {
        $id = $_REQUEST['update_id'];
        $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id = :id');
        $select_stmt->bindParam(":id", $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    } catch(PDOException $e) {
        $e->getMessage();
    }
}
    

    if (isset($_REQUEST['btn_update2'])) {
        try {

            $name = $_REQUEST['txt_name'];

            $image_file = $_FILES['txt_file']['name'];
            $type = $_FILES['txt_file']['type'];
            $size = $_FILES['txt_file']['size'];
            $temp = $_FILES['txt_file']['tmp_name'];
            $timestamp = time();
    
            $image_file2 = $_FILES['txt_file2']['name'];
            $type2 = $_FILES['txt_file2']['type'];
            $size2 = $_FILES['txt_file2']['size'];
            $temp2 = $_FILES['txt_file2']['tmp_name'];

            $image_file3 = $_FILES['txt_file3']['name'];
            $type3 = $_FILES['txt_file3']['type'];
            $size3 = $_FILES['txt_file3']['size'];
            $temp3 = $_FILES['txt_file3']['tmp_name'];

            $image_file4 = $_FILES['txt_file4']['name'];
            $type4 = $_FILES['txt_file4']['type'];
            $size4 = $_FILES['txt_file4']['size'];
            $temp4 = $_FILES['txt_file4']['tmp_name'];

            $image_file = $timestamp . "_" . $image_file;
            $image_file2 = $timestamp . "_" . $image_file2;
            $image_file3 = $timestamp . "_" . $image_file3;
            $image_file4 = $timestamp . "_" . $image_file4;
            $path = "fileupload/" . $image_file; 
            $path2 = "fileupload/" . $image_file2;
            $path3 = "fileupload/" . $image_file3; 
            $path4 = "fileupload/" . $image_file4; 

            if (empty($name)) {
                $errorMsg = "Please Enter name";
            } else if (empty($image_file) || empty($image_file2)|| empty($image_file3)|| empty($image_file4)) {
                $errorMsg = "Please select both images";
            } else if (($type == "image/jpg" || $type == 'image/jpeg' || $type == "image/png" || $type == "image/gif") && ($type2 == "image/jpg" || $type2 == 'image/jpeg' || $type2 == "image/png" || $type2 == "image/gif")&& ($type3 == "image/jpg" || $type3 == 'image/jpeg' || $type3 == "image/png" || $type3 == "image/gif")
            && ($type4 == "image/jpg" || $type4 == 'image/jpeg' || $type4 == "image/png" || $type4 == "image/gif")) {
                if (!file_exists($path) && !file_exists($path2) && !file_exists($path3) && !file_exists($path4)) { 
                 if ($size < 5000000 && $size2 < 5000000) { 
                        move_uploaded_file($temp, 'fileupload/'.$image_file); 
                        move_uploaded_file($temp2, 'fileupload/'.$image_file2); 
                        move_uploaded_file($temp3, 'fileupload/'.$image_file3); 
                        move_uploaded_file($temp4, 'fileupload/'.$image_file4);
                    } else {
                        $errorMsg = "Your files are too large, please upload files with size up to 5MB"; 
                    }
                } else {
                    $errorMsg = "Files already exist... Check upload folder"; 
                }
            } else {
                $errorMsg = "Upload JPG, JPEG, PNG & GIF file formats...";
            }

            if (!isset($errorMsg)) {
                $update_stmt = $db->prepare("UPDATE tbl_file2 SET name = :name_up, image = :file1_up, image2 = :file2_up, image3 = :file3_up, image4 = :file4_up, uploaded_on = NOW() WHERE id = :id");
                $update_stmt->bindParam(':name_up', $name);
                $update_stmt->bindParam(':file1_up', $image_file);
                $update_stmt->bindParam(':file2_up', $image_file2);
                $update_stmt->bindParam(':file3_up', $image_file3);
                $update_stmt->bindParam(':file4_up', $image_file4);
                $update_stmt->bindParam(':id', $id);


                if ($update_stmt->execute()) {
                    $updateMsg = "File update successfully...";
                    header("refresh:2;index2.php");
                }
            }

        } catch(PDOException $e) {
            $e->getMessage();
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<div class="container text-center">
        <h1>Update file page</h1>
        <?php 
            if(isset($errorMsg)) {
        ?>
            <div class="alert alert-danger">
                <strong><?php echo $errorMsg; ?></strong>
            </div>
        <?php } ?>

        <?php 
            if(isset($updateMsg)) {
        ?>
            <div class="alert alert-success">
                <strong><?php echo $updateMsg; ?></strong>
            </div>
        <?php } ?>

        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">Name</label>
            <div class="col-sm-9">
                <input type="text" name="txt_name" class="form-control" placeholder="Enter name" value="<?php echo $name; ?>">
            </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ป้ายทะเบียน</label>
            <div class="col-sm-9">
                <input type="file" name="txt_file" class="form-control">
            </div>
            </div>
            </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">รายละเอียดสินค้า</label>
            <div class="col-sm-9">
                <input type="file" name="txt_file2" class="form-control">
            </div>
            </div>
            </div>
        <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">รายละเอียดสินค้า</label>
            <div class="col-sm-9">
                <input type="file" name="txt_file3" class="form-control">
            </div>
            </div>
            </div>
            <div class="form-group">
            <div class="row">
            <label for="name" class="col-sm-3 control-label">ยืนยันการขนส่ง</label>
            <div class="col-sm-9">
                <input type="file" name="txt_file4" class="form-control">
            </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-12">
                <input type="submit" name="btn_update2" class="btn btn-success" value="Update">
                <a href="index.php" class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>