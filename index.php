<?php
error_reporting(0);
include('db_connect.php');
$sql = "select * from tbl_car where delete_flag = 0   order by id desc";
$result = mysqli_query($conn, $sql);

if(isset($_POST['submit'])) {
    
    if($_SESSION['USER_ID']){  // check panel Login
        extract($_POST);
        $vehicle_id =   mysqli_real_escape_string($conn, $_POST['vehicle_id']);
        $user_id  = mysqli_real_escape_string($conn, $_POST['user_id']);
        $date  = mysqli_real_escape_string($conn, $_POST['date']);
        $booking_days  = mysqli_real_escape_string($conn, $_POST['booking_days']);
        
            $sql = "insert into  tbl_booked_vehicles( `vehicle_id`, `user_id`,`date`,`booking_days`)  values ('$vehicle_id','$user_id','$date',$booking_days)";
            $query = mysqli_query($conn, $sql);

            if( $query){
               
               
               echo"<script> alert('Thank You For Booking'); </script>";
                
            }else{
         
            header('location:index.php');
                $_SESSION['success-msg']='<div class="alert alert-danger"> Boooking Failed, Please Try again</div>';
              $msg = '<div class="alert alert-danger">Booking Failed, Please Try again</div>';
            }
    }
    else{
        header('location:login.php');
        $_SESSION['success-msg']="Neeed To Be Login For Vehical Booking";
    }
   
    
 
}

?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <title>Car Rental Agency</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link href="img/favicon.html" rel="icon">
<link href="css/styles.css" rel="stylesheet" />
    <style>
    .dropbtn {
        background: yellow;
        padding: 10px 30px;
        text-decoration: none;
        border-radius: 8px;
        margin-right: 20px;
        font-weight: 700;
        color: #000;
        font-size: 18px;
        border: none;
        margin-top: 10px;
    }

    .avtar {}



    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }


    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #ddd;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: yellow;
    }

    .after-login {
        display: flex;
    }

    .after-header {
        background-image: url('img/final-bg.jpeg');
        background-size: cover;
        height: 400px;
        background-repeat: no-repeat;
        background-position: center;
    }

    .parent {
        display: flex;
        flex-wrap: wrap;
        margin: 80px auto;
        width: 1150px;
    }

    .child {
        flex: 1 0 21%;
        margin: 10px;
        box-shadow: 0 0 25px 0 rgb(78 76 76 / 12%);
        height: 460px;
    }

    .child h3 {
        text-align: center;
        font-size: 20px;
        margin-bottom: 15px;
    }

    .child img {
        width: 255px;
        height: 200px;
    }

    .child button {
        border-radius: 8px;
        background: #0093D4;
        padding: 5px 15px;
        border: none;
        color: #fff;
    }

    .car-image img {
        width: 250px;
        height: 200px;
    }


    form {
        margin-top: 15px;padding: 15px;
    }

    .footer {
        background: #000;

    }

    .footer p {
        text-align: center;
        padding: 10px 0;
        color: #fff;
    }

    body {
        margin: 0px;
        padding: 0px;
    }

    .buttons {

        position: absolute;
        top: 4%;
        right: 3%;

    }

    .buttons .admin-btn {
        background: yellow;
        padding: 10px 30px;
        text-decoration: none;
        border-radius: 8px;
        margin-right: 20px;
        font-weight: 700;
        color: #000;
        font-size: 18px;
    }

    a.user-btn {
        background: yellow;
        padding: 10px 30px;
        text-decoration: none;
        border-radius: 8px;
        margin-right: 20px;
        font-weight: 700;
        color: #000;
        font-size: 18px !important;
    }
    label {
    display: inline-block;
    font-size: 12px;
}

@media screen and (max-width: 600px) {
 .parent {
    display: block;
    flex-wrap: unset;
    margin: 80px auto;
    width: fit-content;
}
h2{
    font-size:15px;
}
}
    </style>
</head>

<body>


    <section class="after-header">

        <div class="buttons">

            <?php 
            if(!$_SESSION['USER_ID']){ ?>
            <a href="register.php" class="admin-btn">Register</a>
            <?php }?>
            <?php 
            if(!$_SESSION['USER_ID']){  ?>

            <a href="login.php" class="user-btn" style="font-size:18px;"> Login</a>

            <?php } else{  ?>
            <div class="after-login">


              
                <h2 class="avtar"> <a href="profile.php">Hello <?php  echo  $_SESSION['USERNAME'] ?></a> </h2>
                <h2 class="avtar">  &nbsp;   <a href="logout.php">Logout</a> </h2>
              
                <?php }?>

            </div>
        </div>
    </section>
    <div class="parent">

        <?php foreach($result as $row){?>

        <div class="child">

            <center>
                <img src="admin/images/<?php echo $row['image']; ?>" alt="">

            </center>
            <form action="index.php" method="post">
                <?php if($_SESSION['USER_ID']){ ?>
                    <table style="width:100%">
                        <tr>
                            <td style="width:50%">  <label for="">Booking Date</label></td>
                            <td style="width:50%">  <input type="date" name="date" class="form-control" required></td>
                        </tr>
                        <tr>
                            <td ><label for="">Booking For Days</label></td>
                            <td> <select class="form-control" name="booking_days" required>
                                    <option value="" Selected>Select Days</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="user_id" value="<?php echo $_SESSION['USER_ID']; ?>">
                    <input type="hidden" name="vehicle_id" value="<?php echo $row['id']; ?>"><br>
       
                <?php }        ?>
               
                <h3><?php echo $row['vehicle_model']; ?></h3>

                <center><button name="submit" type="submit">Book Now</button></center>
            </form>
        </div>

        <?php } ?>

    </div>
    <div class="footer">
        <p>Copyright @2022. Car Rental</p>
    </div>
</body>

</html>