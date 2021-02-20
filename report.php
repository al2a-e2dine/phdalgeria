<?php
include_once('connect.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
	$user_id=$_SESSION['user_id'];
}

if(isset($_GET['fid'])){
    $id=$_GET['fid'];

    $q="INSERT INTO `report`(`fid`) VALUES ('$id')";
    $r=mysqli_query($dbc,$q);
    header('location: index.php?report');
}else{
    header('location: index.php');
}