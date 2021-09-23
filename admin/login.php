

<?php

session_start();

if (isset($_SESSION['name'])) {
  header("location: index.php");
  die;
} else {

  require('inc/connexion.php');

  if(!empty($_POST['email']) && !empty($_POST['password']) && isset($_POST['login'])){


		
		$email 			= htmlspecialchars($_POST['email']);
		$password		= htmlspecialchars($_POST['password']);

	
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {

			header('location: login.php?error=1&message=Email invalid.');
			exit();

		}

	
		$password = "mac7".sha1($password."246")."27";

		
		$req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
		$req->execute(array($email));

		while($email_verification = $req->fetch()){
			if($email_verification['numberEmail'] != 1){
				header('location: login.php?error=1&message=Impossible to connect.');
				exit();
			}
		}

		
		$req = $db->prepare("SELECT * FROM user WHERE email = ?");
		$req->execute(array($email));

		while($user = $req->fetch()){

			if($password == $user['password']){

				$_SESSION['login'] = True ;
				$_SESSION['email']   = $user['email'];
        $_SESSION['name']   = $user['name'];
        $_SESSION['type']   = $user['type'];

				header('location: index.php?success=1');
				exit();

			}
			else {

				header('location: login.php?error=1&message= Impossible to connect. ');
				exit();

			}

		}

	}
}
?>



<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portfolio Admin</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <nav class="m-0 navbar navbar-expand-sm navbar-dark bg-dark p-0">
        <div class="container">
          <a href="index.html" class="navbar-brand">Admin Panel</a>
        </div>
      </nav>
    
      <!-- HEADER -->
      <header id="main-header" class="py-2 purple text-white">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h1>
                <i class="fas fa-user"></i> Portfolio</h1>
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
    
      <!-- ACTIONS -->
      <section id="actions" class="py-4 mb-4 bg-light">
        <div class="container">
          <div class="row">
    
          </div>
        </div>
      </section>
    
      <!-- LOGIN -->
      <section id="login">
        <div class="container">
          <div class="row">
            <div class="col-md-6 mx-auto">
              <div class="card">
                <div class="card-header">
                  <h4>Account Login</h4>
                </div>
                <div class="card-body">
                  <form action="login.php" method="post" >
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" name="password">
                    </div>
                    <input type="submit" name="login" class="btn btn-purple btn-block">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


</div>


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    
</body>

</html>