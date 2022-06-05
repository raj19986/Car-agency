<?php 
include 'db_connect.php';
$msg="";
if (isset($_POST['email']) && isset($_POST['password'])){
    if(($_POST['email'] != '') && ($_POST['password'] !='')){
            $email= mysqli_real_escape_string($conn,$_POST['email']);
            $password= base64_encode(mysqli_real_escape_string($conn, $_POST['password']));
            $sql="select * from tbl_users where email='$email' and password='$password'";
            $query=mysqli_query($conn,$sql);
            $row_count=mysqli_num_rows($query);
            if($row_count>0){
                $row=mysqli_fetch_assoc($query);
                $_SESSION['USER_ID']=$row['id'];
                $_SESSION['USERNAME']=$row['name'];
                header('location:index.php');
                die();
            }else{
                
                   $sql="select * from tbl_admin  where email='$email' and password='$password'";
                  $query=mysqli_query($conn,$sql);
                  $row_count=mysqli_num_rows($query);
                  if($row_count>0){
                      $row=mysqli_fetch_assoc($query);
                      $_SESSION['ADMIN_ID']=$row['id'];
                      $_SESSION['USERNAME']=$row['name'];
                      header('location:admin/dashboard.php');
                      die();
                  }
                  else{
                      
                      $msg="Please enter correct details";
                  }
                
            }
            
    }else{
        
        $msg="Please enter required details";
    }
$_SESSION['success-msg']=$msg;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>User  Login</title>
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4"> Login Dashboard</h3>
                                </div>
                                <div class="card-body">
                                    <p style="color:red">
                                          <?php 
                        
                                    if(isset($_SESSION['success-msg'])){
                                        echo $_SESSION['success-msg'];
                                        unset($_SESSION['success-msg']);
                                    }
                                    
                                    ?>
                                    </p>
                                  
                                    <form method="post" action="login.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  type="email" name="email"  required/>
                                            <label for="inputEmail">Email address*</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control"  type="password" name="password"   required/>
                                            <label for="inputPassword">Password*</label>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">

                                            <button type="submit" name="submit" class="btn btn-primary" >Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="register.php">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>

    </div>
  
</body>

</html>