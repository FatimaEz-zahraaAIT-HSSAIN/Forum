<?php

function connect(){
    try {
        $db = new PDO('mysql:host=localhost;dbname=forum', 'root', '');
        return $db;
        }catch(PDOException $e){
            echo $e->getMessage();
            die();
        }

}
$db=connect();

function adduser($nom,$email,$password){
    global $db;
        $req=$db->prepare("INSERT INTO users (`id`, `nom`, `email`, `password`) VALUES (NULL, :nom, :email, :password)");
        $req->execute(["nom"=>$nom, "email"=>$email,"password"=>$password]);
}


function getUserByEmail($email){
    global $db;
        $req=$db->prepare("SELECT * FROM users WHERE email=:email" );
        $req->execute(["email"=>$email]);
        $user=$req->fetch(PDO::FETCH_OBJ);

        return (array)$user;
}


function addQuestion($user_id, $question, $date){
    global $db;
        $req=$db->prepare("INSERT INTO questions (`id`, `user_id`, `question`, `date`) VALUES (NULL, :user_id, :question, :date)");
        $req->execute(["user_id"=>$user_id, "question"=>$question, "date"=>$date]);
}

function getQuestions(){
    global $db;
        $req=$db->prepare("SELECT q.id, q.user_id, q.question, q.date, u.nom 
        FROM questions AS q
        INNER JOIN users AS u
        WHERE q.user_id = u.id
        ORDER BY q.date DESC" );
        $req->execute();

        $questions=$req->fetchAll(PDO::FETCH_OBJ);

        return (array)$questions;
}

function addReponse($user_id, $question_id, $response, $date){
    global $db;
        $req=$db->prepare("INSERT INTO reponses (`id`, `user_id`, `question_id`, `response`,`date`) VALUES (NULL, :user_id, :question_id, :response, :date)");
        $req->execute(["user_id"=>$user_id, "question_id"=>$question_id, "response"=>$response,"date"=>$date]);
}

function getReponses($question_id){
    global $db;
        $req=$db->prepare("SELECT r.id, r.user_id, r.question_id, r.response, r.date, u.nom, q.question
        FROM reponses AS r
        INNER JOIN users AS u
        INNER JOIN questions AS q
        WHERE r.question_id=:question_id AND r.user_id = u.id AND r.question_id = q.id
        ORDER BY r.date DESC" );
        $req->execute(["question_id"=>$question_id]);
        $responses=$req->fetchAll(PDO::FETCH_OBJ);

        return (array)$responses;
}


 ?>