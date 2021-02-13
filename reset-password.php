<?php 
$pageName="Réinitialiser le mot de passe";
include_once 'connect.php';
session_start();

    if (!isset($_GET['email']) || !isset($_GET['token'])) {
        header('Location: register.php');
    }else{
        $email = $_GET['email'];
        $token = $_GET['token'];

        $q="SELECT * FROM `users` WHERE `email`='$email' and `token`='$token'";
        $r=mysqli_query($dbc,$q);
        $num=mysqli_num_rows($r);

        if($num==1){
        $row=mysqli_fetch_assoc($r);
        $user_id=$row['id'];
        if (isset($_POST['submit'])) {
            $password=$_POST['password'];
            $cpassword=$_POST['cpassword'];

                if ($password==$cpassword) {
                    $password=md5($password);

                    $q0="UPDATE `users` SET `password`='$password' WHERE `id`='$user_id'";
                    $r0=mysqli_query($dbc,$q0);
                    header('Location: login.php?success3');
                }else{
                    $msg="Les deux mots de passe ne sont pas identiques";
                }
        }
        }else{
            header('Location: register.php');
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
                                        <h1 class="h4 text-gray-900 mb-2">Réinitialiser le mot de passe</h1>
                                    </div>
                                    <form class="user" action="reset-password.php?email=<?= $email ?>&token=<?= $token ?>" method="post">
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Ajouter un nouveau mot de passe">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                            name="cpassword" placeholder="Répéter le mot de passe">
                                        </div>
                                        <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Mettre à jour le mot de passe">
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="index.php">Page d'accueil</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="register.php">Créer un compte!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="login.php">Vous avez déjà un compte? S'identifier!</a>
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