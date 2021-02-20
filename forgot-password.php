<?php 
session_start();
include_once 'connect.php';
include "config.php";
$pageName=$lang['39'];


if(isset($_POST['submit'])){
  $email = mysqli_real_escape_string($dbc, htmlentities(trim($_POST['email'])));

  $q="SELECT * FROM `users` WHERE `email`='$email'";
  $r=mysqli_query($dbc,$q);
  $num=mysqli_num_rows($r);

  if($num==1){
    $row=mysqli_fetch_assoc($r);
    $token=$row['token'];

    $message=$lang['40']." phdalgeria.com/reset-password.php?email=".$email."&token=".$token;

      if(mail($email,"PHD Algeria",$message)){
      $msg=$lang['41'];
        }
    
  }else{
    $msg=$lang['42'];
  }
}
 ?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $pageName ?></title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-white">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2"><?= $lang['39'] ?></h1>
                                        <p class="mb-4"><?= $lang['43'] ?></p>
                                    </div>

                                    <?php 
                                    if(isset($msg)){ ?>
                                        <div class="alert alert-info">
                                          <strong>PHD Algeria!</strong> <?= $msg ?>
                                        </div>
                                    <?php } ?>

                                    <form class="user" action="forgot-password.php" method="post">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="<?= $lang['44'] ?>">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="<?= $lang['45'] ?>">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php"><?= $lang['46'] ?></a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php"><?= $lang['47'] ?></a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php"><?= $lang['48'] ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>