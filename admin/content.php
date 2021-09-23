
<?php

session_start();

if(!$_SESSION['login']){
  header("location: login.php");
  die;
}

   require_once('inc/connexion.php');

   try {
      $sql =

      "SELECT headerImage, aboutName, aboutJob, aboutDescription, aboutLinkedin, aboutGithub, aboutDribble, skillsTitle1, skillsContent1, skillsTitle2, skillsContent2, contactEmail, contactPhone, contactAdress, footerFacebook, footerInstagram, footerTwitter FROM main";
      $request = $db->prepare($sql);
      $request->execute();
      $mainData = $request->fetch();

    }
    catch(PDOException $ex)
    {
    die("Erreur " . $ex->getMessage());
    }
    

if (!empty($_POST) AND isset($_POST['editMain'])) {

    $allowedExt = array('jpg', 'jpeg', 'png', 'pdf');
    $allowedSize = 1024 * 1024;

    if (isset($_FILES['headerImage']) AND $_FILES['headerImage']['error'] === 0) {


        if ($_FILES['headerImage']['size'] <= $allowedSize) {


            $fileInfoHeader = pathinfo($_FILES['headerImage']['name']);
            $fileActualExtHeader = $fileInfoHeader['extension'];
            $uniqHeaderImage = uniqid().basename($_FILES['headerImage']['name']);

            if (in_array($fileActualExtHeader, $allowedExt)) {

                if (move_uploaded_file($_FILES['headerImage']['tmp_name'], '../assets/img/'.$uniqHeaderImage)) {

                   
                    $headerImage = $uniqHeaderImage;
                    unlink('../assets/img/'.$mainData['headerImage']);

                }
           } else { echo '<script language="javascript">';
                    echo 'alert("Image extension is not allowed!")';
                    echo '</script>';
                     header ("Refresh:0 ;URL='content.php");}

        } else { echo '<script language="javascript">';
                 echo 'alert("headerImage is too big!")';
                 echo '</script>';
                 header ("Refresh:0 ;URL='content.php");}
    } 
    else {
        $headerImage = $_POST['headerImageNow'];
    }
            $reqUpdate = "UPDATE main

            SET headerImage = :headerImage, aboutName = :aboutName, aboutJob = :aboutJob, aboutDescription = :aboutDescription, aboutLinkedin = :aboutLinkedin, aboutGithub = :aboutGithub, aboutDribble = :aboutDribble, skillsTitle1 = :skillsTitle1, skillsContent1 = :skillsContent1, skillsTitle2 = :skillsTitle2, skillsContent2 = :skillsContent2, contactEmail  = :contactEmail, contactPhone = :contactPhone, contactAdress = :contactAdress, footerFacebook = :footerFacebook, footerInstagram = :footerInstagram, footerTwitter = :footerTwitter";

            $paramsUpdate = array(
              ':headerImage' => $headerImage,
              ':aboutName' => $_POST['aboutName'],
              ':aboutJob' => $_POST['aboutJob'],
              ':aboutDescription' => $_POST['aboutDescription'],
              ':aboutLinkedin' => $_POST['aboutLinkedin'],
              ':aboutGithub' => $_POST['aboutGithub'],
              ':aboutDribble' => $_POST['aboutDribble'],
              ':skillsTitle1' => $_POST['skillsTitle1'],
              ':skillsContent1' => $_POST['skillsContent1'],
              ':skillsTitle2' => $_POST['skillsTitle2'],
              ':skillsContent2' => $_POST['skillsContent2'],
              ':contactEmail' => $_POST['contactEmail'],
              ':contactPhone' => $_POST['contactPhone'],
              ':contactAdress' => $_POST['contactAdress'],
              ':footerFacebook' => $_POST['footerFacebook'],
              ':footerInstagram' => $_POST['footerInstagram'],
              ':footerTwitter' => $_POST['footerTwitter']                
            );


            try{
                $sqlUpdate = $db -> prepare($reqUpdate);
                $sqlUpdate -> execute($paramsUpdate);

                if ($sqlUpdate -> execute($paramsUpdate) == True) {

                  $result='<div class="alert alert-success">Update Sucess!</div>';

                  header ("Refresh:1 ;URL='content.php");

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
            Content Management</h1>
        </div>
      </div>
    </div>
  </header>

  <?php echo $result; ?> 

  <!-- DETAILS -->
  <section id="details" class="py-4">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Edit Content</h4>
            </div>
            <div class="card-body">
              
      <form action="content.php" method="post" enctype="multipart/form-data"> 

                <h5><u>Header</u></h5>
                <img src="<?php echo('../assets/img/'.$mainData['headerImage']);?>" alt="headerImage" class="img-thumbnail my-4 w-25">
                <input type="hidden" name="headerImageNow" value="<?php echo $mainData['headerImage']?>">
                <div class="form-group">
                  <label >Upload Image</label>
                  <div class="custom-file">
                    <input id="headerImage" type="file" name="headerImage" class="custom-file-input">
                    <label id="headerImageLabel" for ="headerImage" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
                </div>
              <hr>

              <h5><u>About</u></h5>
                </div>
                <div class="form-group">
                  <label >Name</label>
                  <input type="text" class="form-control" name="aboutName" value="<?php echo $mainData['aboutName']?>" >
                </div>
                <div class="form-group">
                  <label >Job</label>
                  <input type="text" class="form-control" name="aboutJob" value="<?php echo $mainData['aboutJob']?>">
                </div>
                 <div class="form-group">
                  <label >Description</label>
                  <textarea class="form-control" name="aboutDescription" ><?php echo $mainData['aboutDescription']?></textarea>
                </div>
                <div class="form-group">
                  <label >Lien Linkedin</label>
                  <input type="text" class="form-control" name="aboutLinkedin" value="<?php echo $mainData['aboutLinkedin']?>">
                </div>
                <div class="form-group">
                  <label >Lien Github</label>
                  <input type="text" class="form-control" name="aboutGithub" value="<?php echo $mainData['aboutGithub']?>">
                </div>
                <div class="form-group">
                  <label >Lien Dribble</label>
                  <input type="text" class="form-control" name="aboutDribble" value="<?php echo $mainData['aboutDribble']?>">
                </div>
              <hr>

              <h5><u>Skills</u></h5>
              <div class="form-group">
                <label >Skill Title 1</label>
                <input type="text" class="form-control" name="skillsTitle1" value="<?php echo $mainData['skillsTitle1']?>">
              </div>
              <div class="form-group">
                <label for="skillDescription1">Skill Description 1</label>
                <textarea id="skillDescription1" class="form-control" name="skillsContent1"><?php echo $mainData['skillsContent1']?></textarea>
              </div>
              <div class="form-group">
                <label  >Skill Title 2</label>
                <input type="text" class="form-control" name="skillsTitle2" value="<?php echo $mainData['skillsTitle2']?>">
              </div>
              <div class="form-group">
                <label for="skillDescription2"> Skill Description 2</label>
                <textarea id="skillDescription2" class="form-control"  name="skillsContent2" ><?php echo $mainData['skillsContent2']?></textarea>
                
              </div>
              <hr>

              <h5><u>Portfolio</u></h5>
              <div class="col-md-3" >
                <a href="portfolios.php" class="btn btn-success btn-block my-4">
                  <i class="fas fa-pencil-alt"></i> Edit Portfolio
                </a>
              </div>
              <hr>

              <h5><u>Contact</u></h5>
              <div class="form-group">
                <label >E-mail</label>
                <input type="text" class="form-control" name="contactEmail" value="<?php echo $mainData['contactEmail']?>" >
              </div>
              <div class="form-group">
                <label >Phone</label>
                <input type="text" class="form-control" name="contactPhone" value="<?php echo $mainData['contactPhone']?>" >
              </div>
              <div class="form-group">
                <label >Adress</label>
                <input type="text" class="form-control" name="contactAdress" value="<?php echo $mainData['contactAdress']?>">
              </div>
              <hr>
              <h5><u>Social media (footer)</u></h5>
              <div class="form-group">
                <label >Lien Facebook</label>
                <input type="text" class="form-control" name="footerFacebook" value="<?php echo $mainData['footerFacebook']?>">
              </div>
              <div class="form-group">
                <label >Lien Instagram</label>
                <input type="text" class="form-control" name="footerInstagram" value="<?php echo $mainData['footerInstagram']?>">
              </div>
              <div class="form-group">
                <label >Lien Twitter</label>
                <input type="text" class="form-control" name="footerTwitter" value="<?php echo $mainData['footerTwitter']?>">
              </div>
            </div>
          </div>
        </div>
          </div>
        </div>
        </section>

       <section id="actions" class="py-4 mb-4 bg-light">
         <div class="container">
           <div class="row">
             <div class="col-md-3 offset-md-8">
               <button class="btn btn-success btn-block" type="submit" name="editMain" >
              <i class="fas fa-check"></i> Save Changes
            </button>
            </div>
         </div>
        </div>
        </section>
     </form>
    </div>
</div>
</div>


<?php include("inc/footer.php"); ?>

