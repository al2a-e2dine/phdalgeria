<?php
include_once('connect.php');
session_start();

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

	$q0="SELECT * FROM `reaction` WHERE `post_id`='$post_id' and `user_id`='$user_id'";
    $r0=mysqli_query($dbc,$q0);
    $num0=mysqli_num_rows($r0);

    if ($num0==0) {
    	$q="INSERT INTO `reaction`(`user_id`, `post_id`, `reaction`) VALUES ('$user_id','$post_id',1)";
    	$r=mysqli_query($dbc,$q);
    	header('location: post.php?id='.$post_id.'&success_add');
    }else{
    	$row0=mysqli_fetch_assoc($r0);
    	$reaction_id=$row0['id'];

    	$q="UPDATE `reaction` SET `reaction`=1 WHERE id='$reaction_id'";
    	$r=mysqli_query($dbc,$q);
    	header('location: post.php?id='.$post_id.'&success_update');
    }

    
