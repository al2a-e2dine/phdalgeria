<?php 
    include_once('connect.php');

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


$q = "SELECT * FROM `charts`";
$result = mysqli_query($dbc, $q);
$rows = array();
$table = array();

$table['cols'] = array(
 array(
  'label' => 'Date', 
  'type' => 'string'
 ),
 array(
  'label' => 'visiteurs', 
  'type' => 'number'
 )
);

//print_r($table['cols']); exit();

// if($result){
//     echo"oui"; exit();
// }else{
//     echo"non"; exit();
// }

while($row = mysqli_fetch_array($result)){
    

 $sub_array = array();
 $datetime = $row["date"];

 //print_r($datetime); exit();

 $sub_array[] =  array(
      "v" => $datetime
     );
 $sub_array[] =  array(
      "v" => $row["visitor"]
     );

 //print_r($sub_array);exit();

 $rows[] =  array(
     "c" => $sub_array
    );
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);

 ?>
 <!DOCTYPE html>
 <html>
 <head>
    <title>Charts</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
  <script type="text/javascript">
   google.charts.load('current', {'packages':['corechart']});
   google.charts.setOnLoadCallback(drawChart);
   function drawChart()
   {
    var data = new google.visualization.DataTable(<?php echo $jsonTable; ?>);

    var options = {
     title:'Cette figure représente le nombre des visiteurs chaque jour',
     legend:{position:'bottom'},
     chartArea:{width:'95%', height:'65%'}
    };

    var chart = new google.visualization.LineChart(document.getElementById('line_chart'));

    chart.draw(data, options);
   }
  </script>
  <style>
  .page-wrapper
  {
   width:1000px;
   margin:0 auto;
  }
  </style>
 </head>
 <body>
 <div class="container">
    <br>

    <div class="page-wrapper">
   <br />
   <h2 align="center">Cette figure représente le nombre des visiteurs chaque jour</h2>
   <div id="line_chart" style="width: 100%; height: 500px"></div>
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
    
