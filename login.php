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
<!doctype html>
<html lang = 'en'>
<head>
    <meta charset = 'UTF-8'>
    <meta name = 'viewport' content = 'width=device-width, initial-scale=1.0, shrink-to-fit=no'>
<!--     <link rel = 'stylesheet' href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity = 'sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin = 'anonymous'>-->    
    <link rel = 'stylesheet' href = 'css/style.css'>
    <title>Login</title>
</head>
<body class="container">
    <div class="header">
        <a href="home.php"><img class="logo" src="public/images/logo.svg" alt="logo ecovybe"></a>
    </div>
    <?php if ( isset( $error ) ): ?>

    <div class = 'alert alert-danger' role = 'alert'>
        <?php echo $error ?>
    </div>
    <?php endif; ?>

    <h1 style="margin-top:5%">Hallo! Log in om verter te tuinieren.</h1>

    <form class="form" action="" method="post" style="margin-top:5.5%">
      <div class="form-groupE">
        <!---<label for="email">Email</label>--->
        <img class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="email" placeholder="Email" name="email" id="email" class="form-control">
      </div>

      <div class="form-groupF">
        <!---<label for="password">Wachtwoord</label>--->
        <img class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="password" placeholder="Wachtwoord" name="password" id="password" class="form-control">
      </div>

      <div class="loginbutton">
        <input type="submit" value="Log in" class="btn btn-primary" style="box-sizing: border-box; height: 45px; width: 170px; border: 1px solid #DFBD41; border-radius: 7px; background-color: #9FB26D; margin-top:5px; color: #EDEEDE; font-family: Muli; font-size: 18px; text-align: center;">
      </div>
        <p style="margin-top:5%" class = 'account'>Nog geen account? <a href = 'index.php' >Registreer hier.</a></p>
      
    </form>
<!--     <script src = 'https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity = 'sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin = 'anonymous'></script>
 --><!--     <script src = 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity = 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin = 'anonymous'></script>
 --><!--     <script src = 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity = 'sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin = 'anonymous'></script>
 --></body>
</html>