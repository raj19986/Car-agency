<?php

include('db_connect.php');

if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}
if(isset($_GET['type']) && $_GET['type']=='delete' &&  ($_GET['id'])){
  $id= mysqli_real_escape_string($conn,$_GET['id']);
   $sql = "update tbl_car SET delete_flag='1' where id='$id'";
    $query = mysqli_query($conn, $sql);
 
}


$sql = "select * from tbl_car  where delete_flag = 0  order by id desc";
$result = mysqli_query($conn, $sql);

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
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    .link {
        margin: 15px 0;
    }
    .available{
        background:green;
        padding:3px;
        border-radius:5px;
        color:#fff;
    }
    .booked{
        background:red;
        padding:3px;
        border-radius:5px;
        color:#fff;  
    }
    </style>
</head>

<body class="sb-nav-fixed">
    <?php include 'header.php'; ?>
    <div id="layoutSidenav">
        <?php include 'sidebar.php'; ?>
        <div id="layoutSidenav_content">
        <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Dashboard</h1>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            All car Listing
                        </div>
                        <div class="card-body">
                            <?php 
                            
                            if(isset($_SESSION['success-msg'])){
                                echo $_SESSION['success-msg'];
                                unset($_SESSION['success-msg']);
                            }
                            
                            ?>
                            <a href="add_car.php" class=" btn btn-primary link ">Add Car</a>
                            <table style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Vehicle model</th>
                                    <th>Vehicle number</th>
                                    <th>Vehicle Image</th>
                                    <th>seating capacity</th>
                                    <th>rent per day</th>
                                    <th>Status</th>
                                    <th>Action</th>


                                </tr>
                                <?php  $i=1; 
                                  foreach($result as $cars){
                                      ?>
                                <tr>


                                    <td><?php echo $i;?></td>
                                    <td><?php echo $cars['vehicle_model']; ?></td>
                                    <td><?php echo $cars['vehicle_number']; ?></td>
                                    <td>
                                        <center><img src="images/<?php echo $cars['image']; ?>" alt=""
                                                style="width:50px; height:50px; border-radius:50%;"></center>
                                    </td>
                                    <td><?php echo $cars['seating_capacity']; ?></td>

                                    <td><?php echo $cars['rent_per_day']; ?></td>
                                    <td>

                                        <?php if($cars['status']='available'){ ?>
                                        <p class="available">Available</p> 
                                        <?php } else {?>
                                            <p calss="booked">Booked</p> 

                                           <?php } ?>
                                       
                                    </td>

                                    <td> <a href="edit_listing.php?id=<?php echo $cars['id']; ?>"
                                            class="btn btn-primary btn-sm"><i class="fas fa-edit"></i>
                                            Edit</a>
                                        <a href="listing.php?id=<?php echo $cars['id'] ?>&type=delete"
                                            class="btn btn-danger btn-sm" onclick="return myConfirm();"> <i
                                                class="fa fa-trash" aria-hidden="true"></i> Delete</a>
                                    </td>

                                </tr>
                                <?php $i++  ;        } 
                                    ?>
                            </table>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="assets/demo/chart-area-demo.js"></script>
    <script src="assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
    function myConfirm() {
        var result = confirm("Are you sure you want to delete?");
        if (result == true) {
            return true;
        } else {
            return false;
        }
    }
    </script>
</body>

</html>