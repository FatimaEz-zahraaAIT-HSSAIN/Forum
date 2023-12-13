<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>


  
  <form class="form-horizontal m-5 p-5" action="../controllers/adduser.php" method="post">
  <h1 class="mb-5 mr-5">Enregistrement</h1>
    <?php if(isset($_GET['Erreur'])){ ?>
        <div class="alert alert-danger w-75">
            <p><strong>Erreur: </strong><?=$_GET['Erreur'] ?> </p>
        </div>
    <?php } ?>
    <div class="form-group m-3">
      <label class="control-label col-sm-2" for="nom">Nom:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="nom" placeholder="Nom" name="nom">
    </div>
    </div>
    <div class="form-group m-3">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
      </div>
    </div>
    <div class="form-group m-3">
      <label class="control-label col-sm-2" for="pwd">Mot de passe:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
      </div>
    </div>
    <div class="form-group m-3">
      <label class="control-label col-sm-2" for="c_pwd">Confirmer Mot de passe:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="c_pwd" placeholder="Confirmer password" name="c_password">
      </div>
    </div>
    <div class="form-group m-3">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary" name="submit" >Register</button>
      </div>
    </div>
  </form>


</body>
</html>
