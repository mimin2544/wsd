<?php 

    require_once('connect.php');

    if (isset($_REQUEST['delete_id'])) {
        $id = $_REQUEST['delete_id'];
    
        $select_stmt = $db->prepare('SELECT * FROM tbl_file WHERE id = :id');
        $select_stmt->bindParam(':id', $id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        unlink("fileupload/".$row['image']); 

        
        $delete_stmt = $db->prepare('DELETE FROM tbl_file WHERE id = :id');
        $delete_stmt->bindParam(':id', $id);
        $delete_stmt->execute();

        header("Location: index2.php");
       
    }

?>
<!DOCTYPE html>

<html lang="en">
<head>
<title>How to generate PDF in PHP dynamically by using TCPDF</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

</head>
<body>
    <div class="container text-center">
        <h1>Index export Page</h1>
        
    
    <form action='search.php' class='form-group my-3' method='POST'>
    <div class='search-box'>
        <div class="row">
            <div class='col-md-9'>
                <input name='searchtxt' type='text' placeholder='NAME PRODUCT' class='form-control'>
            </div>
            <div class='col-md-3'>
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12 text-center">
        <a href="addexit.php" class="btn btn-success">Add Image</a>
        <a href="index.php" class="btn btn-success">index</a>
    </div>
</div>


       
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
                    <td>Pdf</td>
                    <td>Pdf</td>
                    <td>Pdf</td>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php 
                    $select_stmt = $db->prepare('SELECT * FROM tbl_file'); 
                    $select_stmt->execute();

                    while ($row = $select_stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>   
                    <tr>
                        
                        <td><?php echo $row['uploaded_on']; ?></td>
                        <td><?php echo $row['name']; ?></td>                        
                        <td><img src="fileupload/<?php echo $row['image']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image2']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image3']; ?>" width="100px" height="100px" alt=""></td>
                        <td><img src="fileupload/<?php echo $row['image4']; ?>" width="100px" height="100px" alt=""></td>                        
                        
                        <td><a href="edit2.php?update_id=<?php echo $row['id']; ?>"class="btn btn-warning"method="post">Edit</a></td>                        
                        <td><a target="" href="pdf_maker.php?pdf_id=<?php echo $row['id']; ?>&ACTION=VIEW" class="btn btn-success"method="post"><i class="fa fa-file-pdf-o"></i> View PDF</a></td> &nbsp;&nbsp; 
                        
                    
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    
   
</body>
</html>