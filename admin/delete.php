<?php 

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;
}

include('inc/connexion.php');?>

<?php
if (isset($_POST['deletedata'])) {

    $sql =

    "SELECT pageHeaderImage, pageImage1, pageImage2 FROM portfoliopage WHERE id = :id";
    $paramsDel = array (
      ':id'=> $_POST['delete_id']
  );

  try{
    $request = $db->prepare($sql);
    $request->execute($paramsDel);
    $portfolioData = $request->fetch();

  }
  catch(PDOException $ex)
  {
  die("Erreur " . $ex->getMessage());
  }
   
  unlink('../assets/img/'.$portfolioData['pageHeaderImage']);
  unlink('../assets/img/'.$portfolioData['pageImage1']);
  unlink('../assets/img/'.$portfolioData['pageImage2']);
  
  try
   {
 
   $sqlDelete = "DELETE FROM portfoliopage WHERE id = :id";
   $paramsDelete = array (
       ':id'=> $_POST['delete_id']
   );
   $reqDelete = $db->prepare($sqlDelete);
   $reqDelete->execute($paramsDelete);
   if ($reqDelete) {
     
    header ("location: portfolios.php");

    }else {

    $result='<div class="alert alert-danger">Sorry there was an error. Please try again.</div>';

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