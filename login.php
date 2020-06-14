<?php
  include_once(__DIR__."/classes/User.php");
  
  if ( !empty( $_POST ) ) {
    try {
        $user = new User();
        $user->setCurrentEmail( $_POST['email'] );
        $user->setCurrentPassword( $_POST['password'] );
        $canLogin = $user->canLogin();
        if ( $canLogin ) {
            $complete = $user->checkComplete();
            $user->login( $complete );
        } else {
            $error = "We kunnen u niet aanmelden, probeer opnieuw.";
        }

    } catch ( \Throwable $th ) {
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
    <div><?php if ( isset( $error ) ): ?></div>
    <div class="error" role = 'alert'>
        <?php echo $error ?>
    </div>
    <?php endif; ?>

    <h1 class="welcome">Hallo! <br>Log in om verder te tuinieren.</h1>

    <form class="form" action="" method="post">
      <div class="form-groupE">
        <img class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="email" placeholder="Email" name="email" id="email" class="form-control">
      </div>

      <div class="form-groupF">
        <img class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="password" placeholder="Wachtwoord" name="password" id="password" class="form-control">
      </div>

      <div class="loginbutton">
        <input type="submit" value="Log in">
      </div>

        <p class = 'account'>Nog geen account? <br><a href = 'index.php' >Registreer hier</a></p>
      
    </form>
 </body>
</html>