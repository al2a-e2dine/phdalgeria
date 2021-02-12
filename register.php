<?php 
$pageName="S'inscrire";
include_once 'connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
}

if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];

$q="SELECT * FROM `users` WHERE `email`='$email'";
$r=mysqli_query($dbc,$q);
$num=mysqli_num_rows($r);

if($num==0){
    if($password==$cpassword){
      $password=md5($password);

      $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
            $token = str_shuffle($token);
      $token = substr($token, 0, 30);
      $message="
      Veuillez cliquer sur le lien ci-dessous:
      http://localhost/phdalgeria/confirm.php?email=".$email."&token=".$token;
      
      if(mail($email,"PHD Algeria",$message)){
      $q="INSERT INTO `users`(`firstname`, `lastname`, `phone`, `email`, `password`, `token`) VALUES ('$firstname', '$lastname', '$phone', '$email', '$password', '$token')";
      $r=mysqli_query($dbc,$q);
      if($r){
        header('Location: login.php?success');
      }else{
        $msg="Il y a un problème pendant le processus d'inscription";
      }
        }

  }else{
    $msg="Les deux mots de passe ne sont pas identiques";
  }
}else{
    $msg="L'adresse email est déjà utilisée";
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

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Créer un compte!</h1>
                            </div>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>
                            
                            <form class="user" action="register.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="firstname"
                                            placeholder="Prénom">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="lastname"
                                            placeholder="Nom">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control form-control-user" name="phone"
                                        placeholder="Numéro de téléphone">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email"
                                        placeholder="Adresse e-mail">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="password" placeholder="Mot de passe">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="cpassword" placeholder="Répéter le mot de passe">
                                    </div>
                                </div>
                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Créer un compte">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="index.php">Page d'accueil</a>
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>