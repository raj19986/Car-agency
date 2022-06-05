<?php
include "db_connect.php";
if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
$car_id = $_GET['id'] ; 
if(isset($_POST['submit'])) {
    extract($_POST);
    $vehicle_model=   mysqli_real_escape_string($conn, $_POST['vehicle_model']);
    $vehicle_number  = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $seating_capacity =  mysqli_real_escape_string($conn, $_POST['seating_capacity']);
    $rent_per_day =mysqli_real_escape_string($conn, $_POST['rent_per_day']);
    
    if($_FILES['image']['name'] != '' ){
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/'.$image;
		move_uploaded_file($image,  $uploads_dir);
		
	}else{
	    
	    $image =  mysqli_real_escape_string($conn, $_POST['image_old']);
	}

    $sql = "update tbl_car SET vehicle_model='$vehicle_model' ,  vehicle_number='$vehicle_number', seating_capacity='$seating_capacity', rent_per_day='$rent_per_day',image='$image' where id='$car_id'"; 
    $query = mysqli_query($conn, $sql);
    //$msg = '<div class="alert alert-success"> car Detail Updated SuccessFully</div>';
    if( $query){
        
        $msg = '<div class="alert alert-success"> Car Added Successfull</div>';
         
          header('location:listing.php');
          $_SESSION['success-msg']='<div class="alert alert-success">Update Successfully</div>';
          
      }else{
   
      header('location:edit_listing.php');
          $_SESSION['success-msg']='<div class="alert alert-danger"> Not Update, Please Try again</div>';
        $msg = '<div class="alert alert-danger">Not Added, Please Try again</div>';
      }
 
   
}


$result = mysqli_query($conn, "select * from  tbl_car where   id='$car_id' " );
$row=mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Update car</li>
                    </ol>

                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Vehicle model</label>
                                        <input type="text" class="form-control" name="vehicle_model"
                                            value="<?php echo $row['vehicle_model'] ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Vehicle number</label>
                                        <input type="text" class="form-control" name="vehicle_number"
                                            value="<?php echo $row['vehicle_number'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>seating capacity</label>
                                    <input type="text" class="form-control" name="seating_capacity"
                                        value="<?php echo $row['seating_capacity'] ?>" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>rent per day</label>
                                    <input type="text" class="form-control" name="rent_per_day"
                                        value="<?php echo $row['rent_per_day'] ?>" required>
                                </div>
                            
                                <div class="form-group col-md-12">
                            <label>Vehicle Image </label>
                            <input type="file" class="form-control" name="image" >
                            <?php if($row['image']) { ?>
                            <img src="images/<?php echo $row['image']; ?>" alt="" style="width:50px; height:50px; border-radius:50%;"> 
                             <input type="hidden" class="form-control" name="image_old" value="<?php echo $row['image']; ?>">
                            <?php } ?>
                            </div>
                                <div class="form-group col-md-6">
                                    <button type="submit" name="submit" class="btn btn-primary">Update Car</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
  
</body>

</html>