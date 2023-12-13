<?php 
    session_start();

    include_once "../models/db.php";
    $reponses = getReponses($_GET['question_id']);
    foreach($reponses as $r){ 
        $reponse = (array)$r; }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home</title>
</head>
<body class="py-4 px-5">
    <?php
        if(!isset($_SESSION['user'])):
     ?>
        <header class="w-100 mb-5 position-relative"><a class="text-decoration-none position-absolute top-0 end-0 " href="login.php">Login</a></header>
    <?php else:?>
        <header class="w-100 mb-5 position-relative"><a class="text-decoration-none position-absolute top-0 end-0" href="logout.php">Logout</a></header>
    <?php endif;?>

    <div class="border border-secondary mx-5 mb-4 px-3 py-2" style="width: 92.5%"><?=$reponse['question']?></div>

    <?php if(isset($_SESSION['user'])): ?>
        <form class="mb-5 position-relative" action="question.php" method="post">
            <div>
                <input class=" mx-5 mb-2" style="min-height: 50px; width: 92.5%" type="text" name="reponse" id="reponse" placeholder="Votre reponse ici...">
            </div>

            <button class="btn btn-primary position-absolute end-0" style="margin-right: 50px;" name="envoyer_reponse" type="submit">Envoyer</button>
        </form>
    <?php 
        if(isset($_POST['envoyer_reponse'])){

            $u= getUserByEmail($_SESSION['user']['email']);
            $date = date('Y/m/d H:i:s');
    
            addReponse($u['id'],$_SESSION['question_id'] ,$_POST['reponse'], $date);
    
            header('Location: ../views/question.php?question_id='.$_SESSION['question_id']."&question=".$_SESSION['question']);
        }
    endif; 
        $_SESSION['question_id'] = $_GET['question_id'];
        $_SESSION['question']=$_GET['question'];
        
        
        
        if(sizeof($reponses) != 0 ):
            $json_data = json_encode($reponses, JSON_PRETTY_PRINT);
            $file = '../public/responses.json';
            file_put_contents($file, $json_data);
    ?>

    <div id="displayreponses" class="container border border-secondary display-flex mx-5">
        <?php foreach($reponses as $r){ 
            $reponse = (array)$r;
            ?>

            <div class="border border-primary position-relative display-flex m-3 p-3">
                <p class="mx-2"><?=$reponse['date']?> - <span class="text-success"><?=$reponse['nom']?></span></p>
                <div class="border border-secondary mx-5 mb-2">
                    <p class="m-2"><?=$reponse['response']?></p>
                </div>
            </div>

        <?php  } ?>

    </div>

    <?php endif; ?>
    
    <script src="../public/reponses.js"></script>
</body>
</html>


