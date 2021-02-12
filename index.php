<?php 
$pageName="PHD Algeria";
include_once 'connect.php';
session_start();



include 'function_inc.php';

// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
// }

if (isset($_POST['submit'])) {
    $user_id=$_SESSION['user_id'];
    $domaine=$_POST['domaine'];
    $filiere=$_POST['filiere'];
    $wilaya=$_POST['wilaya'];
    $title=$_POST['title'];
    $url=$_POST['url'];
    include 'uploadfile.php';

    if ($url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url', '$file_name')";
    }elseif ($url and !$file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `url`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$url')";
    }elseif (!$url and $file_name) {
        $query="INSERT INTO `files`(`user_id`, `domaine`, `filiere`, `wilaya`, `title`, `path`) VALUES ('$user_id', '$domaine', '$filiere', '$wilaya', '$title', '$file_name')";
    }

    $result=mysqli_query($dbc,$query);
    header('Location: index.php?upload');
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

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

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
                    <p class="text-center"><b>PHD Algeria</b> est un site éducatif dont l'objectif de fournir toutes les leçons et synthèses dont l'ingénieur algérien a besoin pour les différentes universités pour préparer le concours de doctorat</p>
                    <div class="alert alert-info text-center">
                        « إنما الصدقات للفقراء والمساكين والعاملين عليها والمؤلفة قلوبهم وفي الرقاب والغارمين وفي سبيل الله وابن السبيل فريضة من الله والله عليم حكيم - التوبة »
                    </div>
                    <hr>
                    <?php
                        if (isset($_SESSION['user_id'])) { ?>
                    <a class="btn btn-primary btn-block mb-2" href="" data-toggle="modal" data-target="#upload">Enrichir le site</a>

                            <?php 
                            if(isset($msg)){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> <?= $msg ?>
                                </div>
                            <?php } ?>

                            <?php 
                            if(isset($_GET['upload'])){ ?>
                                <div class="alert alert-info">
                                  <strong>PHD Algeria!</strong> Le fichier a été téléchargé avec succès
                                </div>
                            <?php } ?>

                <!-- The Modal -->
              <div class="modal fade" id="upload">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                  
                    <!-- Modal Header -->
                    <div class="modal-header">
                      <h4 class="modal-title">Enrichir le site</h4>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    
                    <!-- Modal body -->
                    <div class="modal-body">
                      <form class="user" action="index.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                <select class="form-control action" name="domaine" id="domaine" required>
                                <option value="">Choisir un domaine</option>
                                <?php 
                                    $qd="SELECT * FROM `domaine`";
                                    $rd=mysqli_query($dbc,$qd);
                                    while ($rowd=mysqli_fetch_assoc($rd)) { ?>
                                        <option value="<?= $rowd['id'] ?>"><?= $rowd['domaine'] ?></option>
                                    <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control action" name="filiere" id="filiere" required>
                                <option value="">Choisir la filière</option>
                                </select>
                                </div>

                                <div class="form-group">
                                <select class="form-control" name="wilaya" required>
                                <option value="">Ce fichier est pour la wilaya</option>
                                <?php
                                $q="SELECT DISTINCT wilaya_name,id FROM `algeria_cities`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                
                                    <option value="<?= $row['id'] ?>"><?= $row['id']."-".$row['wilaya_name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="title"
                                        placeholder="Titre de ce fichier" required>
                                </div>
                                <div class="form-group">
                                    <input type="URL" class="form-control form-control-user" name="url"
                                        placeholder="Si vous possédez le lien des fichiers dans Google Drive ou le lien YouTube">
                                </div>

                                <p class="text-center"><span style="color: red">OR</span> Upload des fichiers (jpg, docx, xlsx, pptx, pdf, zip, rar)</p>
                                 <div class="custom-file mb-3">
                                 <input type="file" class="custom-file-input" id="customFile" name="fileToUpload">
                                 <label class="custom-file-label" for="customFile">Choisir un fichier </label>
                                 </div>

                                <input type="submit" name="submit" class="btn btn-primary btn-user btn-block" value="Enrichir le site">
                            </form>
                    </div>
                    
                    <!-- Modal footer  -->
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    
                  </div>
                </div>
              </div>

              <?php } ?>

                    <br> 

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">PHD Algeria</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th>Wilaya</th>
                                            <th>Date</th>
                                            <th>Par</th>
                                            <th>Voir</th>
                                            <th>Télécharger</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $q2="SELECT * FROM `files` where archived=0";
                                        $r2=mysqli_query($dbc,$q2);
                                        while ($row2=mysqli_fetch_assoc($r2)) {
                                            $id_wilaya=$row2['wilaya'];
                                            $id_user=$row2['user_id'];

                                            $wilaya_data=getInfoById('algeria_cities',$id_wilaya);
                                            $user_data=getInfoById('users',$id_user);
                                            ?>
                                            <tr>
                                            <td><?= $row2['id'] ?></td>
                                            <td><?= $row2['title'] ?></td>
                                            <td><?= $wilaya_data['wilaya_name'] ?></td>
                                            <td><?= $row2['date'] ?></td>
                                            <td><?= $user_data['firstname']." ".$user_data['lastname'] ?></td>
                                            <?php if ($row2['url']) { ?>
                                                    <td>
                                                        <a class="btn btn-dark btn-block" href="<?= $row2['url'] ?>" target="_blank">Voir</a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                    <button class="btn btn-dark btn-block" href="" disabled>Voir</button>
                                                </td>
                                            <?php } ?>

                                            <?php if ($row2['path']) { ?>
                                                    <td>
                                                        <a class="btn btn-success btn-block" href="<?= $row2['path'] ?>" target="_blank">Télécharger</a>
                                                    </td>
                                            <?php }else{ ?>
                                                <td>
                                                        <button class="btn btn-success btn-block" href="" disabled>Télécharger</button>
                                                    </td>
                                            <?php } ?>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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

<script>
$(document).ready(function(){
 $('.action').change(function(){
  if($(this).val() != '')
  {
   var action = $(this).attr("id");
   var query = $(this).val();
   var result = '';
   if(action == "domaine")
   {
    result = 'filiere';
   }
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:{action:action, query:query},
    success:function(data){
     $('#'+result).html(data);
    }
   })
  }
 });
});
</script>