<?php
    include_once(__DIR__."/classes/User.php");
    
    if (!empty($_POST)) {
        try {
            $user = new User();
            $user->setEmail($_POST['email']);
            $user->setFirstName($_POST['firstName']);
            $user->setLastName($_POST['lastName']);
            $user->setPassword($_POST['password']);          
            
            $user->save();
            $success = "Profiel is aangemaakt!";
        } catch (\Throwable $th) {
            $error = $th->getMessage();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' type='text/css' href='css/style.php'>
    <title>Sign in</title>
</head>
<body class="container">
    <?php include("includes/headerno.php") ?>
    <h1>Registreer hier <br> om te starten met tuinieren.</h1>
    <?php if (isset($error)): ?>
        <div class="error" role="alert">
            <?php echo $error ?>
        </div>
    <?php endif; ?>
    <form class="form" action="" method="post">
        <?php if (isset($success)): ?>
            <div class="success" role="alert">
                <?php echo $success ?>
                <p>Je kan nu inloggen!</p>
                <a href="login.php" class="btn btn-primary btn-xs">Ga naar login.</a>
            </div>
        <?php endif; ?>
        <div class="form-groupA">
            <img class= "plant" src="public/icons/plant.png" alt="plant icon">
            <input type="email" name="email" placeholder="Email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <span id="available"></span>
        </div>
        <div class="form-groupB">
            <img class="plant" src="public/icons/plant.png" alt="plant icon">
            <input class="form-control" name="firstName" type="text" placeholder="Voornaam" id="firstName">
        </div>
        <div class="form-groupC">
            <img class="plant" src="public/icons/plant.png" alt="plant icon">
            <input class="form-control" name="lastName" type="text" placeholder="Achternaam" id="lastName">
        </div>
        <div class="form-groupD">
            <img class="plant" src="public/icons/plant.png" alt="plant icon">
            <input type="password" name="password" class="form-control" placeholder="Wachtwoord" id="exampleInputPassword1">        
        </div>
        <button type="submit" class="register"><p>Registreer</p></button>

        <div class="account">
        <p class="acc">Heb je al een account? <br><a href="login.php">Log In</a></p>
        </div>
    </form>
    <script src="js/checkEmail.js"></script>
</body>
</html>