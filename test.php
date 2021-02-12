<?php
include_once 'connect.php';

	$domaine = array(
		"Sciences de la Nature et de la Vie",
"Sciences de la Matière",
"Mathématiques et Informatique",
"Sciences et Techniques des Activités Physiques et Sportives",
"Langues et Culture Amazighes",
"Lettres et Langues Etrangères",
"Sciences Humaines et Sociales",
"Arts",
"Sciences et Technologies",
"Sciences de la terre et de l Univers",
"Droit et Sciences Politiques",
"Langues et Littérature Arabes",
"Architecture, urbanisme et métiers de la ville",
"Sciences Economiques, de Gestion et Sciences Commerciales"
	);

	

	$filiere1 = array(
		"Biotechnologie",
"Ecologie et environnement",
"Sciences Agronomiques",
"Sciences Alimentaires",
"hydrobiologie marine et continentale",
"Sciences Biologiques",
"sciences vétérinaires"
	);

	$filiere2 = array(
		"Physique",
"Chimie"
	);

	$filiere3 = array(
		"mathématiques appliquées",
"Mathématiques",
"Informatique"
	);

	$filiere4 = array(
		"Activité physique et sportive éducative",
"administration et gestion du sport",
"entrainement sportif",
"activité physique et sportive adaptée"
	);

	$filiere5 = array(
		"langue et civilisation",
"linguistique et didactique"
	);

	$filiere6 = array(
		"traduction",
"langue espagnole",
"Langue Anglaise",
"Langue Française",
"langue allemande",
"langue italienne"
	);

	$filiere7 = array(
		"Sciences sociales - orthophonie",
"Sciences sociales - psychologie",
"Sciences Sociales - sciences des populations",
"sciences sociales",
"sciences islamiques – charia",
"Sciences sociales - philosophie",
"sciences humaines - archéologie",
"Sciences humaine - histoire",
"Sciences islamiques - langue arabe et civilisation islamique",
"Sciences sociales - sciences de l éducation",
"sciences humaines - bibliothéconomie",
"sciences humaines - sciences de l information et de la communication",
"sciences sociales - anthropologie",
"Sciences islamiques - Oussoul Eddine",
"sciences sociales - sociologie"
	);

	$filiere8 = array(
		"arts visuels",
"arts du spectacle"
	);

	$filiere9 = array(
		"Automatique",
"Télécommunications",
"Génie Mécanique",
"génie de l environnement",
"ingénierie des transports",
"génie minier",
"travaux publics",
"energies renouvelables",
"industries pétrochimiques",
"génie industriel",
"Génie Civil",
"hygiene et sécurite industielle",
"génie climatique",
"Hydraulique",
"génie maritime",
"Electronique",
"optique et mécanique de précision",
"science et génie de l environnement",
"Génie des Procédés",
"Electrotechnique",
"métallurgie",
"Electromécanique",
"Génie Biomédical",
"aéronautique"
	);

	$filiere10 = array(
		"géologie",
"géophysique",
"géographie et aménagement du territoire"
	);

	$filiere11 = array(
		"Droit",
"Sciences politiques"
	);

	$filiere12 = array(
		"Etudes littéraires",
"Etudes critiques",
"Etudes linguistiques"
	);

	$filiere13 = array(
		"architecture",
"gestion des techniques urbaines"
	);

	$filiere14 = array(
		"Sciences de Gestion",
"Sciences Economiques",
"Sciences Financières et Comptabilité",
"Sciences Commerciales"
	);

	for ($i=0; $i <= 3; $i++) {
		$f=$filiere14[$i];

		$q0="SELECT * FROM `filiere` where filiere='$f'";
		$r0=mysqli_query($dbc,$q0);
		$num=mysqli_num_rows($r0);
		if($num==0){
			$q="INSERT INTO `filiere`(`domaine_id`, `filiere`) VALUES (14,'$f')";
			$r=mysqli_query($dbc,$q);
		}
	}
	header('location: test.php?success');
?>