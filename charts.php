<?php 
    include_once('connect.php');
//echo date("Y-m-d"); exit();
$query = "SELECT DISTINCT `visit_date` FROM `counter`";
$result = mysqli_query($dbc, $query);
while ($row=mysqli_fetch_assoc($result)) {
    $day=$row['visit_date'];
    $q = "SELECT * FROM `counter` where visit_date='$day'";
    $r = mysqli_query($dbc, $q);
    $num=mysqli_num_rows($r);

    $q0 = "SELECT * FROM `charts` where date='$day'";
    $r0 = mysqli_query($dbc, $q0);
    $num0=mysqli_num_rows($r0);
    if($num0 == 0){
        $q1 = "INSERT INTO `charts`(`date`, `visitor`) VALUES ('$day','$num')";
        $r1 = mysqli_query($dbc, $q1);
    }else{
        $q1 = "UPDATE `charts` SET `visitor`='$num' WHERE date='$day'";
        $r1 = mysqli_query($dbc, $q1);
    }

}

$labels='';
$query0 = "SELECT * FROM `charts`";
$result0 = mysqli_query($dbc, $query0);
while($row0=mysqli_fetch_assoc($result0)){
    $date=$row0['date'];
    $visitor=$row0['visitor'];
//$labels.='"'.$date.'",';
$labels.="{ day: '".$date."', visitor: '".$visitor."' },";
}
$labels=substr($labels, 0, -1);
//echo $labels;
 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <title>Charts</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/bootstrap.bundle.min.js"></script>
  <script src="js/jquery-3.5.1.slim.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
 </head>
 <body>
 <div class="container">
    <br>
    <h1 class="text-center">Cette figure représente le nombre des visiteurs chaque jour</h1>
    <br>
    <!-- Content Row -->
                    <div class="row">
                        <div class="col" id="chart"></div>
                    </div>
    <hr>
    <div class="text-center">
        <a class="small" href="index.php">Page d'accueil</a>
    </div>
 </div>
 </body>
 </html>

 <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

<script>
Morris.Line({
 element : 'chart',
 data:[<?= $labels ?>],
 xkey:'year',
 ykeys:['value'],
 labels:['Value'],
 hideHover:'auto',
 stacked:true
});
</script>
    
