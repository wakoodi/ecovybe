<?php 

session_start();
include_once( __DIR__ . '/classes/User.php' );
include_once( __DIR__ . '/classes/Garden.php' );

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $user = new User;
    $info = $user->findCurrentUser($email);
    $currentUserId = $info['id'];

    $garden = new Garden;
    if (!empty($_POST)) {
        $garden->setName($_POST['gardenName']);
        $garden->setItems_id($_POST['item']);
        $garden->setKitCode($_POST['kitCode']);
        $garden->setCreated(date("Y-m-d h:i:sa"));
        $garden->setUser_id($currentUserId);
        
        $garden->save();
        $success = "Tuin is aangemaakt!";
    }
    $items = $garden->findAllItems();

} else {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Muli&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' type='text/css' href='css/style.php'>
    <title>Tuin</title>
</head>
<body class="container">
    <?php include("includes/header.php") ?>
    <?php if ( isset( $success ) ): ?>
        <div class = "success" role = 'alert'>
            <?php echo $success ?>
        </div>
    <?php endif; ?>

    <h1 class="newgardenheader">Nieuwe tuin toevoegen:</h1>

    <form class="form" action="" method="post">
      <div class="form-groupG">
        <img  class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="text" placeholder="Naam tuin" name="gardenName" id="gardenName" class="form-control">
      </div>

      <div class="form-groupI">
        <img class="plant" src="public/icons/plant.png" alt="plant icon">
        <input type="text" placeholder="Kit Code" name="kitCode" id="kitCode" class="form-control">
        <p class="kitCodeInfo">Deze code is terug te vinden op de Ecovybe kit.</p>
      </div>

      <div class="form-groupH">
        <div class="dropdown">
        <label class="choose" for="item">Kies wat je zal kweken</label></br>
            <select name="item" class="form-control" style="margin-left:2.5%; margin-top:5%;">
                <?php foreach ($items as $item): ?>
                    <option class="chooseoption" value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
      </div>
      
      <div class="value">
        <input type="submit" value="Start met groeien!" class="register" style=" margin-left:26%; height:40px; margin-top:5px; color: #EDEEDE; font-family: Muli; font-size: 16px; text-align: center;">
      </div>

    </form>
    <?php include("includes/nav.php") ?>
</body>
</html>

