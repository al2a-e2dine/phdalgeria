<?php 
include_once 'connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
    $user_id=$_SESSION['user_id'];
}

$q="UPDATE `users` SET `archived`=1 WHERE `id`='$user_id'";
$r=mysqli_query($dbc,$q);
session_destroy();
header('Location: index.php');
 ?>