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
<!--     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->    
    <link rel="stylesheet" href="css/style.css">
    <title>Advies</title>
</head>
<body class="container">
    <?php include("includes/header.php") ?>
    <h1><?php echo $gardenData['name']; ?></h1>
    <p><?php echo $item['name']; ?></p>
    
    <ul class="progress">
        <li>Zaaien</li>
        <li>Wateren</li>
        <li>Oogsten</li>
    </ul>

    <p>Temperatuur: <?php echo $curlData['temperature']; ?> °c</p>
    <p>Bodemvochtigheid: <?php echo $curlData['humidity']; ?> %</p>
    <p>UV-index: <?php echo $curlData['uv_index']; ?></p>

    <iframe src="https://console.thinger.io/#!/dashboards/Data?authorization=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJqdGkiOiJEYXNoYm9hcmRfRGF0YSIsInVzciI6Ikxpc2FEcnNlIn0.PrKchtvblAevWCZH_idVyfQseaOfjrr5W7HjcWG8igk" frameborder="0" title="dashboard"></iframe>
    <?php include("includes/nav.php") ?>
</body>
<!--     <script src = 'https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity = 'sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin = 'anonymous'></script>
    <script src = 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity = 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin = 'anonymous'></script>
    <script src = 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity = 'sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin = 'anonymous'></script>
 --></html>