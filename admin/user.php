<?php

session_start();

if(!$_SESSION['login']){
  header("location:index.php");
  die;
}

if($_SESSION['type'] != Admin){
  header("location: index.php?error=1&message=You must be an admin to acess that page!");
  die;
}


?>


<?php include('inc/connexion.php')?>

<?php

try
{

$sql =

"SELECT id, name, email, type FROM user";

$request = $db->prepare($sql);
$request->execute();
$listUsers = $request->fetchAll(); 
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
            <i class="fas fa-users"></i> User</h1>
        </div>
      </div>
    </div>
  </header>

  <?php if(isset($_GET['error'])){

if(isset($_GET['message'])) {

  echo'<div class="alert alert-danger mt-2">'.htmlspecialchars($_GET['message']).'</div>';


}

} else if(isset($_GET['success'])) {

echo'<div class="alert alert-success mt-2">User Added.</div>';

} ?>

  <!-- ADD PORTFOLIO -->
  <section id="search" class="py-4 mb-4 bg-light">
    <div class="container">
      <div class="row">
        <div class="col-md-3 offset-md-8">
            <a href="#" class="btn btn-purple btn-block" data-toggle="modal" data-target="#addUserModal">
              <i class="fas fa-plus"></i> Add User
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
              <h4>User list</h4>
            </div>
            <table class="table table-striped table-responsive-md">
              <thead class="thead-dark">
                <tr>
                  <th>id</th>
                  <th>Nom</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($listUsers as $userData): ?>
                <tr>
                  <td><?php echo $userData['id']?></td>
                  <td><?php echo $userData['name']?></td>
                  <td><?php echo $userData['email']?></td>
                  <td><?php echo $userData['type']?></td>
                  <td>
                    <button class="btn btn-danger deletebtn" data-toggle="modal" data-target="#deleteModal">
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

<!-- Delete User Modal -->
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
      <form action="deleteUser.php"  method="post">
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


<!-- ADD User MODAL -->
<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
      <form action="addUser.php" method="post" >
      <div class="modal-header purple text-white">
          <h5 class="modal-title">Add User</h5>
          <button class="close" data-dismiss="modal">
            <span>&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name">
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div class="form-group">
              <label for="password2">Confirm Password</label>
              <input type="password" class="form-control" name="password2">
            </div>
            <div class="form-group">
              <label >User Role</label>
              <select class="form-control" id="type" name="type">
                <option value="Editor">Editor</option>
                <option value="Admin">Admin</option>
              </select>
            </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-purple" type="submit" name="addUser">Add User</button>
        </div>
      </div>
      </form>
    </div>
  </div>


  <?php include("inc/footer.php"); ?>