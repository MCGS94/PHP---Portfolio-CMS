<?php

@session_start();

?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Portfolio</title>

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar" >
            <div class="text-center sidebar-header">
                <h3>Portfolio</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="row position-relative">
                <img class="img-fluid position-absolute ml-2 col-md-4 rounded-circle h-20 w-20" src="img/avatar.png" alt="Avatar">
                <p class="ml-5 pl-5 col-md-8" ><?php echo("{$_SESSION['name']}") ?></p>
                </li>
                <li class="border-top border-secondary active" >
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="content.php">Content</a>
                </li>
                <li>
                    <a href="user.php">Users</a>
                </li>
            </ul>

            <ul class="list-unstyled logout">
              <li>
                  <a href="logout.php" class="btn btn-danger btn-sm text-center "> Logout <i class="fas fa-sign-out-alt"></i> </a>
              </li>
          </ul>

        </nav>