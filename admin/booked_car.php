<?php

include('db_connect.php');
if(!$_SESSION['ADMIN_ID']){  // check panel Login
    header('location:login.php');
    $_SESSION['invalid_login']="Please Try With Login Details";
}


$sql = "select bv.* , car.vehicle_model ,car.vehicle_number , car.seating_capacity , car.rent_per_day  ,users.name, users.email  
from tbl_booked_vehicles bv
left join tbl_car  car on car.id = bv.vehicle_id
left join tbl_users  users on users.id  = bv.user_id ";

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

   .booked {
        background: green;
        padding: 3px;
        border-radius: 5px;
        color: #fff;
        text-align:center;
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
                            <table style="width:100%">
                                <tr>
                                    <th>Sno </th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Vehicle model</th>
                                    <th>Vehicle number</th>
                                    <th>Booking Days</th>
                                    <th>Booking Date</th>
                                    
                                    <th>Staus</th>


                                </tr>
                                <?php  $i=1; 
                                  foreach($result as $cars){
                                      ?>
                                <tr>


                                    <td><?php echo $i;?></td>
                                    <td><?php echo $cars['name']; ?></td>
                                    <td><?php echo $cars['email']; ?></td>
                                    <td><?php echo $cars['vehicle_model']; ?></td>
                                    <td><?php echo $cars['vehicle_number']; ?></td>
                                    <td><?php echo $cars['booking_days']; ?> Days</td>
                                    <td><?php echo date('d M Y' , strtotime( $cars['date']) ); ?></td>

                                    

                                    <td>

                                        <?php  if($cars['status']=='booked'){?>
                                        <p class="booked">Booked</p>
                                        <?php }?>
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