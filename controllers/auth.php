<?php
    session_start();
    include_once "../models/db.php";


    if(isset($_POST['submit'])){

        if(!isset($_POST['email']) && !isset($_POST['password'])){
            header( "Location:../views/login.php?Erreur=Les champs sont vide.");
            exit();
        }else if(!isset($_POST['email'])){
            header( "Location:../views/login.php?Erreur=Le champ email est vide.");
            exit();
        }else if(!isset($_POST['password'])){
            header( "Location:../views/login.php?Erreur=Le champ Mot de passe est vide.");
            exit();
        }else{
            $user= getUserByEmail($_POST['email']);

            if(isset($user) && password_verify($_POST['password'], $user['password'])){
                $_SESSION['user']['nom']=$user['nom'];
                $_SESSION['user']['email']=$user['email'];

                header( "Location:../views/home.php");
                exit();
            }else{
                header( "Location:../views/login.php?Erreur=Le Mot de passe/E-mail est incorrect.");
                exit();
            }
        }
    }


?>