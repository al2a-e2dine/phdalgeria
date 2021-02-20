<?php

	if (!isset($_SESSION['lang']))
		$_SESSION['lang'] = "fr";
	else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
		if ($_GET['lang'] == "fr")
			$_SESSION['lang'] = "fr";
		else if ($_GET['lang'] == "ar")
			$_SESSION['lang'] = "ar";
		else if ($_GET['lang'] == "en")
			$_SESSION['lang'] = "en";
		else if ($_GET['lang'] == "darija")
			$_SESSION['lang'] = "darija";
		else if ($_GET['lang'] == "tmzgh")
			$_SESSION['lang'] = "tmzgh";
	}

	require_once "languages/" . $_SESSION['lang'] . ".php";
?>