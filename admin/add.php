<?php 

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;

} include('inc/connexion.php')?>

<?php

if (!empty($_POST) AND isset($_POST['addPortfolio'])) {

try {

  $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');
  $allowedSize = 1024*1024;

  if( isset($_FILES['pageHeaderImage']) AND $_FILES['pageHeaderImage']['error'] === 0) {
    

    if ($_FILES['pageHeaderImage']['size'] <= $allowedSize) {

    

      $fileInfoHeader = pathinfo($_FILES['pageHeaderImage']['name']);
      $fileActualExtHeader = $fileInfoHeader['extension'];
      $uniqPageHeaderImage = uniqid().basename($_FILES['pageHeaderImage']['name']);
  
      if (in_array($fileActualExtHeader, $allowedExt)) {
        

        if(move_uploaded_file($_FILES['pageHeaderImage']['tmp_name'], '../assets/img/'.$uniqPageHeaderImage)){
                    
            $pageHeaderImage = $uniqPageHeaderImage ;
                              
        }
      } 
    } else {echo '<script language="javascript">';
      echo 'alert("pageImage1 is too big!")';
      echo '</script>';
      header ("Refresh:0 ;URL='portfolios.php");}
  }
  if( isset($_FILES['pageImage1']) AND $_FILES['pageImage1']['error'] === 0) {
    
    if ($_FILES['pageImage1']['size'] <= $allowedSize) {

      $fileInfoImage1 = pathinfo($_FILES['pageImage1']['name']);
      $fileActualExtImage1 = $fileInfoImage1['extension'];
      $uniqPageImage1 = uniqid().basename($_FILES['pageImage1']['name']);
  
      if (in_array($fileActualExtImage1, $allowedExt)) {

        if(move_uploaded_file($_FILES['pageImage1']['tmp_name'], '../assets/img/'.$uniqPageImage1)){
                    
            $pageImage1 = $uniqPageImage1;              
      
        }
      }
    }else { echo '<script language="javascript">';
      echo 'alert("pageImage1 is too big!")';
      echo '</script>';
      header ("Refresh:0 ;URL='portfolios.php");}
  }

 if( isset($_FILES['pageImage2']) AND $_FILES['pageImage2']['error'] === 0) {
    
    if ($_FILES['pageImage2']['size'] <= $allowedSize) {

      $fileInfoImage2 = pathinfo($_FILES['pageImage2']['name']);
      $fileActualExtImage2 = $fileInfoImage2['extension'];
      $uniqPageImage2 = uniqid().basename($_FILES['pageImage2']['name']);
  
      if (in_array($fileActualExtImage2, $allowedExt)) {

        if(move_uploaded_file($_FILES['pageImage2']['tmp_name'], '../assets/img/'.$uniqPageImage2 )){
                    
            $pageImage2 = $uniqPageImage2;              
      
        }
      }
    }else { echo '<script language="javascript">';
      echo 'alert("pageImage2 is too big!")';
      echo '</script>';
      header ("Refresh:0 ;URL='portfolios.php");}
  }

  $sqlInsert = "INSERT INTO portfoliopage SET pageHeaderImage = :pageHeaderImage, pageTitle = :pageTitle, pageDescription = :pageDescription, pageImage1 = :pageImage1, pageImage2 = :pageImage2" ;
  $paramsInsert = array(
  ':pageHeaderImage' => $pageHeaderImage,
  ':pageTitle' => $_POST['pageTitle'],
  ':pageDescription' => $_POST['pageDescription'],
  ':pageImage1' => $pageImage1,
  ':pageImage2' => $pageImage2
    );
  $reqInsert = $db->prepare($sqlInsert);
  $reqInsert->execute($paramsInsert);
  if ($reqInsert) {

    header ("location: portfolios.php");

    }else {

    $result='<div class="alert alert-danger">Sorry there was an error. Please try again.</div>';

    }

}
  catch(PDOException $ex)
  {
      
    echo '<script language="javascript">';
    echo 'alert("Please fill the fields correctly")';
    echo '</script>';
    header ("Refresh:0 ;URL='portfolios.php");
  }
}

?>