<?php
require_once('connect.php');

if (isset($_POST['searchtxt'])) {
    $search = $_POST['searchtxt'];
    $search = "%$search%";
    $select_stmt = $db->prepare('SELECT * FROM tbl_file2 WHERE name LIKE :search');
    $select_stmt->bindParam(':search', $search);
    $select_stmt->execute();
    $results = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: index2.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
    <div class="container text-center">
        <h1>Search Results</h1>
        <a href="index2.php" class="btn btn-primary">Back to Index</a>
        <table class="table table-striped table-bordered table-hover">
            
        <thead>
                <tr>
                <td>Date</td> 
                    <td>Name</td>
                    <td>ป้ายทะเบียน</td>
                    <td>รายละเอียดสินค้า</td>
                    <td>รายละเอียดสินค้า</td>
                    <td>ยืนยันการขนส่ง</td>
                    <td>Edit</td>
                    <td>pdf</td> 
                </tr>
            </thead>
            <tbody>
                <?php 
                    foreach ($results as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['uploaded_on']; ?></td>
                        <td><?php echo $row['name']; ?></td>                        
                        <td><img src="fileupload/<?php echo $row['image']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image2']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image3']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image4']; ?>" width="100px" height="100px" alt=""></td>                        
                        <td><a href="edit.php?update_id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a></td>                        
                        <td><a target="" href="pdf_maker.php?pdf_id=<?php echo $row['id']; ?>&ACTION=VIEW" class="btn btn-success"method="post"><i class="fa fa-file-pdf-o"></i> View PDF</a></td> &nbsp;&nbsp; 
                                               
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVY
