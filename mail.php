<?php 

if (isset($_POST['send'])) {

        $to = '<macgeraldsamaniego@gmail.com>';
        $name = $_POST['name'];
        $subject = 'New mail from Portfolio';
        $message = $_POST['message']; 
        $from = $_POST['email'];
        // $headers = "From: <". $from ">" ;
        
        // Sending email
        mail($to, $subject, $message, $headers);
        header('location: index.php#contact?=success');
    }

 ?>
