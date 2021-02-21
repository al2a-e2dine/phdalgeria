<?php
include_once('connect.php');
session_start();

include 'function_inc.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
}else{
	$user_id=$_SESSION['user_id'];
}

if (!isset($_GET['id'])) {
    header('Location: forum.php');
}else{
    $post_id=$_GET['id'];
}

$postInfo=getInfoById('post',$post_id);

if($postInfo['user_id']==$user_id){

    $q="UPDATE `post` SET `archived`='1' WHERE `id`='$post_id'";
    $r=mysqli_query($dbc,$q);
    header('location: forum.php?post_deleted');
}else{
    header('location: forum.php?err');
}