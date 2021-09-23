<?php 

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;
}

if($_SESSION['type'] != Admin){
    header("location: index.php?error=1&message=You must be an admin to acess that page");
    die;
  }

include('inc/connexion.php');?>


<?php
if (isset($_POST['deletedata'])) {
  try
   {
 
   $sqlDelete = "DELETE FROM user WHERE id = :id";
   $paramsDelete = array (
       ':id'=> $_POST['delete_id']
   );
   $reqDelete = $db->prepare($sqlDelete);
   $reqDelete->execute($paramsDelete);
   if ($reqDelete) {
     
    header ("location: user.php");

    }
   }
   catch(PDOException $ex)
   {
   die("Erreur " . $ex->getMessage());
 }
 catch(PDOException $ex)
 {
 die("Erreur " . $ex->getMessage());
 }
 }

 ?>