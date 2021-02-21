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
    $c_id=$_GET['id'];
}

$commentInfo=getInfoById('comment',$c_id);
$post_id=$commentInfo['post_id'];

if($commentInfo['user_id']==$user_id){

    $q="UPDATE `comment` SET `archived`='1' WHERE `id`='$c_id'";
    $r=mysqli_query($dbc,$q);
    header('location: post.php?id='.$post_id.'&comment_deleted');
}else{
    header('location: post.php?id='.$post_id.'&err');
}