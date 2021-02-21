<?php
include_once('connect.php');
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
	$user_id=$_SESSION['user_id'];
}

if(isset($_GET['id'])){
    $id=$_GET['id'];

    $q="UPDATE `feedback` SET `archived`='1' WHERE `id`='$id'";
    $r=mysqli_query($dbc,$q);
    header('location: profile.php?id=1&feedback_deleted');
}else{
    header('location: profile.php?id=1&err');
}