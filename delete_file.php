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

    $q="UPDATE `files` SET `archived`='1' WHERE `id`='$id' and user_id='$user_id'";
    $r=mysqli_query($dbc,$q);
    header('location: profile.php?delete');
}else{
    header('location: profile.php');
}