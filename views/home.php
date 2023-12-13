<?php 
    session_start();

    include_once "../models/db.php";
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

        
            <form class="mb-5 position-relative" action="home.php" method="post">
                <div>
                    <input class=" mx-5 mb-2" style="height: 50px; width: 1140px" type="text" name="question" id="question" placeholder="Votre question ici...">
                </div>

                <button class="btn btn-primary position-absolute end-0 mx-3" id="question-btn" name="envoyer_question" type="submit">Envoyer</button>
            </form>
        
    <?php 
        if(isset($_POST['envoyer_question'])){

            $u= getUserByEmail($_SESSION['user']['email']);
            $date = date('Y/m/d H:i:s');
    
            addQuestion($u['id'], $_POST['question'], $date);
    
        }

    endif;
        $questions = getQuestions();

        if(sizeof($questions) > 0):
            $json_data = json_encode($questions, JSON_PRETTY_PRINT);
            $file = '../public/questions.json';
            file_put_contents($file, $json_data);
    ?>

    <div id="displayquestions" class="container border border-secondary display-flex mx-5">
        <?php foreach($questions as $q){ 
            $question = (array)$q;
            ?>
            <div class="border border-primary position-relative display-flex m-3 p-3">
            <p class="mx-2"><?=$question['date']?> - <span class="text-success"><?=$question['nom']?></span></p>
            <div class="border border-secondary mx-5 mb-2">
                <p class="m-2"><?=$question['question']?></p>
            </div>
            <a class="text-decoration-none float-left mx-5 end-0 " href="question.php?question_id=<?=$question['id']?>&question=<?=$question['question']?>">Reponses</a></div>
        <?php } ?>
    </div>

    <?php endif; ?>
    
    <script src="../public/questions.js"></script>
</body>
</html>


