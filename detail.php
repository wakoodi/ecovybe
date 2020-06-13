<?php 
session_start();
include_once( __DIR__ . '/classes/User.php' );
include_once( __DIR__ . '/classes/Garden.php' );

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $user = new User;
    $info = $user->findCurrentUser($email);
    $user_id = $info["id"];
    
    $garden = new Garden;
    $gardenId = $_GET['id'];
    $gardenData = $garden->specificGarden($user_id, $gardenId);

    $curlData = $garden->doCurl();
    $item = $garden->findItem($gardenId);
   
} else {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel='stylesheet' type='text/css' href='css/style.php'>
    <title>Advies</title>
</head>
<body class="container">
    <?php include("includes/header.php") ?>
    <h1 class= "gardenheader"><?php echo $gardenData['name']; ?></h1>
    <p class="detailname"><?php echo $item['name']; ?></p>
    
    <p class="detailtemp">Temperatuur: <?php echo $curlData['temperature']; ?> °c</p>
    <p class="detailsoil">Bodemvochtigheid: <?php echo $curlData['humidity']; ?> %</p>
    <p class="detailuv">UV-index: <?php echo $curlData['uv_index']; ?></p>

    <iframe class="iframedetail" src="https://console.thinger.io/#!/dashboards/Data?authorization=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJEYXNoYm9hcmRfRGF0YSIsInVzciI6Ikxpc2FEcnNlIn0.PrKchtvblAevWCZH_idVyfQseaOfjrr5W7HjcWG8igk" frameborder="0" title="dashboard"></iframe>
    <?php include("includes/nav.php") ?>
</body>
</html>