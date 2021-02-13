<?php 
$pageName="Politique d’utilisation";
include_once 'connect.php';
session_start();

include 'function_inc.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
// }

/*if (isset($_POST['submit'])) {
    $user_id=$_SESSION['user_id'];
    $feedback=$_POST['feedback'];

    $query="INSERT INTO `feedback`(`user_id`, `feedback`) VALUES ('$user_id','$feedback')";
    $result=mysqli_query($dbc,$query);
    $msg="Commentaire ajouté avec succes";
}*/


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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php
            //include 'sidebar.html';
        ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <?php
                    include 'topbar.html';
                ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>


                    
                    <p>Il s'agit de la politique de confidentialité la plus simple au monde. Ce document doit vous expliquer pourquoi l'application collecte certaines informations, ce qui se passe lorsque votre compte est supprimé et certaines autres questions fréquemment posées concernant votre vie privée.</p>
                    <hr>
                    <h3>Quelles informations identifiables sont stockées sur moi?</h3>
                    <p>Votre nom et votre adresse e-mail sont stockés avec vos informations d'utilisateur, et bien sûr, toutes les informations que vous saisissez dans votre profil sont également stockées dans la base de données.</p>
                    <hr>
                    <h3>Comment tout cela est-il gratuit? Il doit y avoir un hic!</h3>
                    <p>Absolument aucun piège à ce billet de faveur. Ce projet est juste ma façon de redonner à la communauté dont j'ai tant appris. Cependant, si vous souhaitez montrer votre appréciation, vous pouvez me suivre sur mes réseaux sociaux et me dire à quel point cela vous a aidé, ou faire un don pour aider à payer les factures de cloud, ou si vous êtes un autre développeur, vous pouvez m'envoyer un e-mail directement..</p>
                

                    <img class="img-fluid mx-auto d-block img-thumbnail" src="img/privacypolicy.png" alt="privacy policy">
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <?php
                    include 'footer.html';
                ?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>