<?php 


session_start();

if(!$_SESSION['login']){
  header("location: login.php");
  die;
}


include('inc/connexion.php');?>


<?php
try
{

$sql2 =

"SELECT id, pageHeaderImage, pageTitle FROM portfoliopage";

$request2 = $db->prepare($sql2);
$request2->execute();
$listPortfolios = $request2->fetchAll(); 
}


catch(PDOException $ex)
{
die("Erreur " . $ex->getMessage());
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

<!-- HEADER -->
<header id="main-header" class="py-2 text-white">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <h1>
            <i class="fas fa-users"></i> Portfolio</h1>
        </div>
      </div>
    </div>
  </header>

  <!-- ADD PORTFOLIO -->
  <section id="search" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 offset-md-8">
            <a href="#" class="btn btn-purple btn-block" data-toggle="modal" data-target="#addModal">
              <i class="fas fa-plus"></i> Add Portfolio
            </a>
          </div>
      </div>
    </div>
  </section>

  <!-- PORTFOLIOS -->
  <section id="portfolios">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-header">
              <h4>Portfolio list</h4>
            </div>
            <table class="table table-striped table-responsive-md">
              <thead class="thead-dark">
                <tr>
                  <th>id</th>
                  <th>Nom</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($listPortfolios as $portfolioData): ?>
                <tr>
                  <td><?php echo $portfolioData['id']?></td>
                  <td><?php echo $portfolioData['pageTitle']?></td>
                  <td>
                    <a href="edit-portfolio.php?id=<?php echo $portfolioData['id']?>" class="btn btn-secondary">
                      <i class="fas fa-pencil-alt"></i> Edit
                    </a>
                    <button id="dele" class="btn btn-danger deletebtn" data-toggle="modal" data-target="#deleteModal">
                      <i class="fas fa-trash"></i> Delete
                    </button>
                  </td>
              </tr>
              <?php endforeach;?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
    </div>
</div>

</div>

<!-- Delete PORTFOLIO MODAL -->
<div class="modal fade" id="deleteModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Portfolio</h5>
        <button class="close" data-dismiss="modal">
          <span>&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="delete.php"  method="post">
      <h4>Delete Portfolio</h4>
      <input type="hidden" name="delete_id" id="delete_id">
      <p>Are you sure you want to delete this portfolio?</p>
      </div>
      <div class="modal-footer">
        <button  class="btn btn-secondary" data-dismiss="modal" type="button">Cancel</button>
        
        <button class="btn btn-danger" type="submit" name="deletedata"> <i class="fas fa-trash"></i> Delete </button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- ADD PORTFOLIO MODAL -->
<div class="modal fade" id="addModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <form action="add.php" method="post" enctype="multipart/form-data">
        <div class="modal-header purple text-white">
          <h5 class="modal-title">Add Portfolio</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5><u>Header</u></h5>
                <div class="form-group">
                  <label>Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="pageHeaderImage" name="pageHeaderImage">
                    <label id="pageHeaderImageLabel" for="pageHeaderImage" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
                </div>
            <div class="form-group mt-4">
              <label for="text">Title</label>
              <input type="text" class="form-control" name="pageTitle">
            </div>
            <h5><u>Description</u></h5>
            <div class="form-group">
              <label for="pageDescription">Description</label>
              <textarea id="pageDescription" class="form-control"  name="pageDescription"></textarea>
            </div>
            <h5><u>Showcase</u></h5>
                <div class="form-group">
                  <label>Upload Image Showcase 1</label>
                  <div class="custom-file">
                  <input type="file" class="custom-file-input" id="pageImage1" name="pageImage1">
                    <label id="pageImageLabel1" for="pageImage1" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
                    <label>Upload Image Showcase 2</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="pageImage2" name="pageImage2">
                    <label id="pageImageLabel2" for="pageImage2" class="custom-file-label mb-2">Choose File</label>
                    <small class="form-text text-muted">Max Size 1mb</small>
              </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-purple" type="submit" name="addPortfolio" >Add Portfolio</button>
        </div>
      </div>
      </form>
    </div>
  </div>


  <?php include("inc/footer.php"); ?>