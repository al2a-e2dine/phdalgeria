<?php 
$pageName="Paramètres généraux du compte";
include_once 'connect.php';
include 'function_inc.php';

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
    $user_info=getInfoById('users', $user_id);
}

if(isset($_POST['submit'])){
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$phone=$_POST['phone'];

if (isset($_POST['bio'])) {
    $bio=$_POST['bio'];
}else{
    $bio="";
}

if (isset($_POST['linkedin'])) {
    $linkedin=$_POST['linkedin'];
}else{
    $linkedin="";
}

if (isset($_POST['twitter'])) {
    $twitter=$_POST['twitter'];
}else{
    $twitter="";
}

if (isset($_POST['instagram'])) {
    $instagram=$_POST['instagram'];
}else{
    $instagram="";
}

if (isset($_POST['facebook'])) {
    $facebook=$_POST['facebook'];
}else{
    $facebook="";
}

$password=$_POST['password'];
$password=md5($password);

if ($_SESSION['ali_baba']==$password) {
    $q="UPDATE `users` SET `firstname`='$firstname',`lastname`='$lastname',`phone`='$phone',`bio`='$bio',`linkedin`='$linkedin',`twitter`='$twitter',`instagram`='$instagram',`facebook`='$facebook' WHERE `id`='$user_id'";
    $r=mysqli_query($dbc,$q);
    $msg="Modifié avec succès";
}else{
    $msg="Le mot de passe est incorrect";
}

}

if(isset($_POST['submit2'])){
$old_password=$_POST['old_password'];
$old_password=md5($old_password);

$password1=$_POST['password1'];
$password2=$_POST['password2'];

if ($_SESSION['ali_baba']==$old_password) {
    if ($password1==$password2) {
        $password1=md5($password1);
        $q_pass="UPDATE `users` SET `password`='$password1' WHERE `id`='$user_id'";
        $r_pass=mysqli_query($dbc,$q_pass);
        $msg="mot de passe modifié";
    }else{
        $msg="Les deux mots de passe ne sont pas identiques";
    }
}else{
    $msg="Le mot de passe actuel est incorrect";
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

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4"><?= $pageName ?></h1>
                            </div>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>
                            
                            <form class="user" action="update_user.php" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label>Prénom</label>
                                        <input type="text" class="form-control form-control-user" name="firstname"
                                            value="<?= $user_info['firstname'] ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label>Nom</label>
                                        <input type="text" class="form-control form-control-user" name="lastname"
                                            value="<?= $user_info['lastname'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Numéro de téléphone</label>
                                    <input type="number" class="form-control form-control-user" name="phone"
                                        value="<?= $user_info['phone'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>à propos de vous</label>
                                    <input type="text" class="form-control form-control-user" name="bio"
                                        value="<?= $user_info['bio'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>LinkedIn URL</label>
                                    <input type="url" class="form-control form-control-user" name="linkedin"
                                        value="<?= $user_info['linkedin'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Twitter URL</label>
                                    <input type="url" class="form-control form-control-user" name="twitter"
                                        value="<?= $user_info['twitter'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Instagram URL</label>
                                    <input type="url" class="form-control form-control-user" name="instagram"
                                        value="<?= $user_info['instagram'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Facebook URL</label>
                                    <input type="url" class="form-control form-control-user" name="facebook"
                                        value="<?= $user_info['facebook'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" class="form-control form-control-user" name="password"
                                        placeholder="Mot de passe" required>
                                </div>

                                <input type="submit" name="submit" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Modifier le mot de passe</h1>
                            </div>
                            <form class="user" action="update_user.php" method="post">
                                
                                
                                <div class="form-group">
                                    <label>Mot de passe</label>
                                    <input type="password" class="form-control form-control-user" name="old_password"
                                        placeholder="Mot de passe actuel" required>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name="password1" placeholder="Nouveau mot de passe" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name="password2" placeholder="Répéter le mot de passe" required>
                                    </div>
                                </div>
                                <input type="submit" name="submit2" class="btn btn-success btn-user btn-block" value="Modifier">
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#" data-toggle="modal" data-target="#deleteuser">
                                <h1 class="h4 text-danger mb-4">Supprimer mon compte</h1>
                                </a>

                                <!--  Modal-->
                <div class="modal fade" id="deleteuser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Supprimer mon compte</h5>
                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                            </div>
                            <div class="modal-body">Êtes-vous sûr de supprimer définitivement votre compte?</div>
                            <div class="modal-footer">
                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Annuler</button>
                                <a class="btn btn-primary" href="delete_user.php">Oui</a>
                            </div>
                        </div>
                    </div>
                </div>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="profile.php?id=<?= $user_id ?>">Profil</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="index.php">Page d'accueil</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="update_password.php">Modifier le mot de passe</a>
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