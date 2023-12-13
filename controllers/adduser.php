<?php
    session_start();
    include_once "../models/db.php";



    if( isset($_POST['submit']) ){


        if(!isset($_POST['nom'])){
            header( "Location:../views/register.php?Erreur=Le champ nom est vide.");
            exit();
        }

        if(!isset($_POST['email'])){
            header( "Location:../views/register.php?Erreur=Le champ email est vide.");
            exit();
        }

        if(!isset($_POST['password'])){
            header( "Location:../views/register.php?Erreur=Le champ Mot de passe est vide.");
            exit();
        }

        if(!isset($_POST['c_password'])){
            header( "Location:../views/register.php?Erreur=Le champ Confirmer Mot de passe est vide.");
            exit();
        }

        if($_POST['password'] === $_POST['c_password']){
            $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

            adduser($_POST['nom'], $_POST['email'], $pass_hash);

            header( "Location:../views/login.php");
            exit();
            
        }else{
            header( "Location:../views/register.php?Erreur=Mot de passe et Confirmer Mot de passe ne sont pas identique.");
            exit();
        }
        

    }