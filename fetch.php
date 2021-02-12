<?php
//fetch.php
if(isset($_POST["action"]))
{
 include_once 'connect.php';
 $output = '';
 if($_POST["action"] == "domaine")
 {
  $query = "SELECT * FROM filiere WHERE domaine_id = '".$_POST["query"]."'";
  $result = mysqli_query($dbc, $query);
  $output .= '<option value="">Choisir la filière</option>';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '<option value="'.$row["id"].'">'.$row["filiere"].'</option>';
  }
 }
 echo $output;
}
?>