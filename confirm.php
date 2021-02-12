<?php
	include_once 'connect.php';

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		header('Location: register.php');
	} else {
		$email = $_GET['email'];
		$token = $_GET['token'];

		$q="SELECT * FROM `users` WHERE `email`='$email' and `token`='$token'";
  		$r=mysqli_query($dbc,$q);
		$num=mysqli_num_rows($r);
		
		if($num==1){
		$row=mysqli_fetch_assoc($r);
		$user_id=$row['id'];
		$q0="UPDATE `users` SET `active`=1 WHERE `id`='$user_id'";
		$r0=mysqli_query($dbc,$q0);
		header('Location: login.php?success2');
		}else{
			header('Location: register.php');
		}
	}
?>