<?php 

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;
}

include('inc/connexion.php');?>

<?php include("inc/header.php"); ?>

 <!-- Page Content Holder --> 
               
<div id="content">
    <button type="button" id="sidebarCollapse" class="navbar-btn">
        <span></span>
        <span></span>
        <span></span>
    </button>
<div class="container-sm">

<!-- HEADER -->
<header id="main-header" class="shadow py-2 text-white">
    <div class="container ">
      <div class="row text-center">
        <div class="col-md-12 text-center">
          <h1>
            <i class="fas fa-tachometer-alt"></i> Dashboard</h1>
        </div>
      </div>
    </div>
  </header>

<?php if(isset($_GET['error'])){

if(isset($_GET['message'])) {

  echo'<div class="alert alert-danger mt-2">'.htmlspecialchars($_GET['message']).'</div>';

}

} else if(isset($_GET['success'])) {

echo'<div class="alert alert-success mt-2">Logged in!</div>';

} ?>

  
  <div class="card mt-5">
  <div class="card-header">
    Admin Panel
  </div>
  <div class="card-body">
    <h5 class="card-title">Welcome!</h5>
    <p class="card-text">Welcome to you portfolio's admin page!</p>
  </div>
</div>
  
    

<?php include("inc/footer.php"); ?>
