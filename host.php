<?php
session_start();

include_once 'connect.php';

include "config.php";
$pageName="Hébergement";

include 'function_inc.php';

if (isset($_POST['filtrer'])) {
    $wilaya=mysqli_real_escape_string($dbc, htmlentities(trim($_POST['wilaya'])));

    if ($wilaya) {
        $q2="SELECT * FROM `host` WHERE `wilaya`='$wilaya' and `archived`=0";
    }else{
        $q2="SELECT * FROM `host` where active=1 and archived=0 order by id desc";
    }

    //echo $q2;exit();
    $r2=mysqli_query($dbc,$q2);


    }else{
        $q2="SELECT * FROM `host` where active=1 and archived=0 order by id desc";
        $r2=mysqli_query($dbc,$q2);
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
                    <br>
                    <h1 class="h3 mb-2 text-gray-800 text-center"><?= $pageName ?></h1>
                    
                    <?php if (isset($_SESSION['user_id'])) { ?>
                        <hr>
                            <a href="add_host.php" class="btn btn-primary btn-block">Héberger</a>
                            <br>
                    <?php } ?>


                    <form class="user" action="host.php" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                <select class="form-control" name="wilaya">
                                    <?php if($wilaya){ $wilaya_info=getInfoById('algeria_cities',$wilaya); ?>
                                        <option value="<?= $wilaya_info['id'] ?>"><?= $wilaya_info['wilaya_name'] ?></option>
                                    <?php }else{ ?>
                                <option value="">Recherche par wilaya</option>
                                <?php } ?>
                                <?php
                                $q="SELECT DISTINCT wilaya_name,id FROM `algeria_cities`";
                                $r=mysqli_query($dbc,$q);
                                while($row=(mysqli_fetch_assoc($r))){ ?>
                                
                                    <option value="<?= $row['id'] ?>"><?= $row['id']."-".$row['wilaya_name'] ?></option>
                                <?php } ?>
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-2">
                                <input type="submit" name="filtrer" class="btn btn-primary btn-user btn-block" value="<?= $lang['7'] ?>">
                            </div>
                        </div>
                                
                            </form>
                        <br>
                            

                    <div class="row">
                        <?php while ($row2=mysqli_fetch_assoc($r2)) { 
                            $userInfo=getInfoById('users',$row2['user_id']);
                            $wilayaInfo=getInfoById('algeria_cities',$row2['id']);
                            ?>
                            <!-- begin -->
                        <div class="col-sm-3 text-center">
                            <img class="card-img-top" src="<?= $row2['profile'] ?>" alt="profile" style="width:100%">
                            <div class="card-body">
                                <a href="profile.php?id=<?= $userInfo['id'] ?>">
                                    <h5 class="card-title"><?= $userInfo['firstname']." ".$userInfo['lastname'] ?></h5>
                                </a>
                                <h6><b>Wilaya de : </b><?= $wilayaInfo['wilaya_name'] ?></h6>
                              <p class="card-text"><?= $row2['description'] ?></p>
                              <div class="row">

                                  <!-- <div class="col-sm-4">
                                  <button class="btn btn-primary btn-block mb-2"><?= $wilayaInfo['wilaya_name'] ?></button>
                                    </div> -->

                                    <div class="col-sm-6">
                                  <button class="btn btn-info btn-block mb-2">
                                    <?= $userInfo['phone'] ?></button>
                                    </div>

                                    <div class="col-sm-6">
                                  <a class="btn btn-success btn-block mb-2" href="<?= $row2['map_url'] ?>" target="_blank">Maps</a>
                                    </div>

                              </div>
                              
                              <!-- <a href="#" class="btn btn-primary">See Profile</a> -->
                              <h4>
                                <?php if($userInfo['linkedin']!=""){ ?>
                                <a href="<?= $userInfo['linkedin'] ?>" target="_blank"><i class="fab fa-linkedin"></i></a>
                                <?php } ?>
                                <?php if($userInfo['twitter']!=""){ ?>
                                <a href="<?= $userInfo['twitter'] ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                <?php } ?>
                                <?php if($userInfo['instagram']!=""){ ?>
                                <a href="<?= $userInfo['instagram'] ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                <?php } ?>
                                <?php if($userInfo['facebook']!=""){ ?>
                                <a href="<?= $userInfo['facebook'] ?>" target="_blank"><i class="fab fa-facebook"></i></a>
                                <?php } ?>
                            </h4>
                            </div>
                          </div>
                          <!-- end -->
                        <?php } ?>
                        

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