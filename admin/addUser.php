
<?php

session_start();
if(!$_SESSION['login']){
  header("location: login.php");
  die;
}


if($_SESSION['type'] != Admin){
    header("location: index.php?error=1&message=You must be an admin to acess that page!");
    die;
  }
require('inc/connexion.php')

    if(!empty($_POST) AND isset($_POST['addUser'])){

        try {

            $name           = htmlspecialchars($_POST['name']);
            $email 			= htmlspecialchars($_POST['email']);
            $password		= htmlspecialchars($_POST['password']);
            $password_two	= htmlspecialchars($_POST['password2']);
            $type	        = htmlspecialchars($_POST['type']);

        

            if($password != $password_two){

                header('location: user.php?error=1&message=Password Do not Match');
                exit();

            }


            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

                header('location: user.php?error=1&message=Email Invalid');
                exit();
                    

            }   


            $req = $db->prepare("SELECT count(*) as numberEmail FROM user WHERE email = ?");
		    $req->execute(array($email));

		    while($email_verification = $req->fetch()){

			if($email_verification['numberEmail'] != 0){

				header('location: user.php?error=1&message=Votre adresse email est déjà utilisée par un autre utilisateur.');
				exit();

			}

		}
               
                $secret = sha1($email).time();
                $secret = sha1($secret).time();
                $password = "mac7".sha1($password."246")."27";



                $sqlInsert = "INSERT INTO user SET name = :name, email = :email, password = :password, type = :type, secret = :secret" ;
                    $paramsInsert = array(
                    ':name' => $name,
                    ':email' => $email,
                    ':password' => $password,
                    ':type' => $type,
                    ':secret' => $secret
                    );

                $reqInsert = $db->prepare($sqlInsert);
                $reqInsert->execute($paramsInsert);

                if($reqInsert){

                header('location: user.php?success');

                }
        }
        catch(PDOException $ex)
        {
            
        die("Erreur " . $ex->getMessage());
        }

	}
?>