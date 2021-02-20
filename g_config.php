<?php 
	require_once 'gvendor/autoload.php';

	$google_client = new Google_Client();

	$google_client->setClientId('628049148651-crsjcsq5a8b442hi8a3v79j1id49occf.apps.googleusercontent.com');

	$google_client->setClientSecret('pMmBRhZ-U_6xxx1AjYmvTg4A');

	//$google_client->setRedirectUri('http://localhost/phdalgeria/register.php');
	$google_client->setRedirectUri('http://www.phdalgeria.com/register.php');

	$google_client->addScope('email');
	$google_client->addScope('profile');

	//session_start();
 ?>