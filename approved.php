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

    $q="UPDATE `files` SET `safe`=1 WHERE `id`='$id'";
    $r=mysqli_query($dbc,$q);
    header('location: profile.php?id=1&approved');
}else{
    header('location: index.php?id=1&err');
}