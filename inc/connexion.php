<?php
$host 		= "localhost";
$dbname 	= "portfolio";
$username 	= "root";
$password 	= "root";

try
{
	$db = new PDO('mysql:host='.$host.';dbname='.$dbname, $username, $password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo "Connexion réussie !"; 
}
catch(PDOException $ex)
{
	die('Erreur : ' . $ex->getMessage());
}

?>