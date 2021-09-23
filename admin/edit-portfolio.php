<?php

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;
}

include('inc/connexion.php');?>


<?php 

if (isset($_GET['id']) AND is_numeric($_GET['id'])) {

try{

$sql =

  "SELECT pageHeaderImage, pageTitle, pageDescription, pageImage1, pageImage2 FROM portfoliopage WHERE id = :id";

  $params = array(
    ':id' => $_GET['id']
);
$request = $db->prepare($sql);
$request->execute($params);
$portfolioData = $request->fetch();
} catch (PDOException $ex) {
die("Erreur ".$ex->getMessage());
}

}

if (!empty($_POST) AND isset($_POST['editPortfolio'])) {

  $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');
  $allowedSize = 1024*1024;

  if( isset($_FILES['pageHeaderImage']) AND $_FILES['pageHeaderImage']['error'] === 0) {
    

    if ($_FILES['pageHeaderImage']['size'] <= $allowedSize) {

      $fileInfoHeader = pathinfo($_FILES['pageHeaderImage']['name']);
      $fileActualExtHeader = $fileInfoHeader['extension'];
      $uniqPageHeaderImage = uniqid().basename($_FILES['pageHeaderImage']['name']);
  
      if (in_array($fileActualExtHeader, $allowedExt)) {
        

        if(move_uploaded_file($_FILES['pageHeaderImage']['tmp_name'], '../assets/img/' . $uniqPageHeaderImage)){
                    
            $pageHeaderImage = $uniqPageHeaderImage;
            unlink('../assets/img/'.$portfolioData['pageHeaderImage']);
                              
        }
      } 
    } else { echo '<script language="javascript">';
      echo 'alert("pageHeaderImage is too big!")';
      echo '</script>';
      header ("Refresh:0");}
  }else {
    $pageHeaderImage = $_POST['pageHeaderImageNow'];
}
  if( isset($_FILES['pageImage1']) AND $_FILES['pageImage1']['error'] === 0) {
    
    if ($_FILES['pageImage1']['size'] <= $allowedSize) {

      $fileInfoImage1 = pathinfo($_FILES['pageImage1']['name']);
      $fileActualExtImage1 = $fileInfoImage1['extension'];
      $uniqPageImage1 = uniqid().basename($_FILES['pageImage1']['name']);
  
      if (in_array($fileActualExtImage1, $allowedExt)) {

        if(move_uploaded_file($_FILES['pageImage1']['tmp_name'], '../assets/img/' . $uniqPageImage1)){
                    
            $pageImage1 = $uniqPageImage1;
            unlink('../assets/img/'.$portfolioData['pageImage1']);         
      
        }
      }
    }else { echo '<script language="javascript">';
      echo 'alert("pageImage1 is too big!")';
      echo '</script>';
      header ("Refresh:0");}
  }else {
    $pageImage1 = $_POST['pageImage1Now'];
}

 if( isset($_FILES['pageImage2']) AND $_FILES['pageImage2']['error'] === 0) {
    
    if ($_FILES['pageImage2']['size'] <= $allowedSize) {

      $fileInfoImage2 = pathinfo($_FILES['pageImage2']['name']);
      $fileActualExtImage2 = $fileInfoImage2['extension'];
      $uniqPageImage2 = uniqid().basename($_FILES['pageImage2']['name']);
  
      if (in_array($fileActualExtImage2, $allowedExt)) {

        if(move_uploaded_file($_FILES['pageImage2']['tmp_name'], '../assets/img/' . $uniqPageImage2)){
                    
            $pageImage2 = $uniqPageImage2;
            unlink('../assets/img/'.$portfolioData['pageImage2']);           
      
        }
      }
    }else { echo '<script language="javascript">';
      echo 'alert("pageImage2 is too big!")';
      echo '</script>';
      header ("Refresh:0");}
  }else {
    $pageImage2 = $_POST['pageImage2Now'];
}

$reqUpdate = "UPDATE portfoliopage

SET pageHeaderImage = :pageHeaderImage, pageTitle = :pageTitle, pageDescription = :pageDescription, pageImage1 = :pageImage1, pageImage2 = :pageImage2
WHERE id = :id ";

$paramsUpdate = array(
    ':id' => $_GET['id'],
    ':pageHeaderImage' => $pageHeaderImage,
    ':pageTitle' => $_POST['pageTitle'],
    ':pageDescription' => $_POST['pageDescription'],
    ':pageImage1' => $pageImage1,
    ':pageImage2' => $pageImage2
);
try{
    $sqlUpdate = $db -> prepare($reqUpdate);
    $sqlUpdate -> execute($paramsUpdate);

    if ($sqlUpdate -> execute($paramsUpdate) == True) {

      $result='<div class="alert alert-success">Update Sucess!</div>';

      header ("Refresh:1 ");

      }else {

      $result='<div class="alert alert-danger">Sorry there was an error. Please try again.</div>';

      }

} catch (PDOException $ex) {
    die("Erreur ".$ex -> getMessage());
}
}
?>



<?php include("inc/header.php"); ?>

 <!-- Page Content Holder --> 
               
<div id="content">
    <button type="button" id="sidebarCollapse" class="navbar-btn">
        <span></span>
        <span></span>
        <span></span>
    </button>
<div class="container">

<header id="main-header" class="py-2 text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            Edit Portfolio</h1>
        </div>
      </div>
    </div>
  </header>
  <?php echo $result; ?> 

  <!-- Form -->
  <section id="details" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Content</h4>
            </div>
            <div class="card-body">
              <form action="edit-portfolio.php?id=<?php echo  $_GET['id']?>" method="post" enctype="multipart/form-data">
              <h5><u>Header</u></h5>
                <div class="form-group">
                  
                  <img src="<?php echo('../assets/img/'.$portfolioData['pageHeaderImage']);?>" alt="pageHeaderImage" class="img-thumbnail d-block my-4 w-25">
                  <input type="hidden" name="pageHeaderImageNow" value="<?php echo $portfolioData['pageHeaderImage']?>">
                  <label>Upload Image</label>
                  
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="pageHeaderImage" name="pageHeaderImage">
                    <label id="pageHeaderImageLabel" for="pageHeaderImage" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
                </div>
            <div class="form-group mt-4">
              <label for="text">Title</label>
              <input type="text" class="form-control" name="pageTitle" value="<?php echo $portfolioData['pageTitle']?>" >
            </div>
            <h5><u>Description</u></h5>
            <div class="form-group">
              <label for="pageDescription">Description</label>
              <textarea id="pageDescription" class="form-control"  name="pageDescription"><?php echo $portfolioData['pageDescription']?> </textarea>
            </div>
            <h5><u>Showcase</u></h5>
                <div class="form-group">                 
                  <img src="<?php echo('../assets/img/'.$portfolioData['pageImage1']);?>" alt="pageImage1" class="img-thumbnail d-block my-4 w-25">
                  <label>Upload Image Showcase 1</label>
                <input type="hidden" name="pageImage1Now" value="<?php echo $portfolioData['pageImage1']?>">
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="pageImage1" name="pageImage1">
                    <label id="pageImageLabel1" for="pageImage1" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
                    
                    <img src="<?php echo('../assets/img/'.$portfolioData['pageImage2']);?>" alt="pageImage2" class="img-thumbnail d-block my-4 w-25">
                    <label>Upload Image Showcase 2</label>
                    <input type="hidden" name="pageImage2Now" value="<?php echo $portfolioData['pageImage2']?>">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="pageImage2" name="pageImage2">
                    <label id="pageImageLabel2" for="pageImage2" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
              </div>
            </div>
             
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    <!-- ACTIONS -->
    <section id="actions" class="py-4 mb-4 bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-3 offset-md-8">
            <button type="submit" name="editPortfolio" class="btn btn-success btn-block">
              <i class="fas fa-check"></i> Save Changes
            </button>   
          </div>
        </div>
      </div>
      </form>
    </section>

    </div>
</div>
</div>

<?php include("inc/footer.php"); ?>