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
    $gardens = $garden->findGardens($currentUserId);
    

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
    <link rel = 'stylesheet' href = 'css/style.css'>
    <link rel='stylesheet' type='text/css' href='css/style.php'>
    <title>Home</title>
</head>
<body class="container">
    <?php include("includes/header.php") ?>
    <h1 class="hello">Welkom <?php echo htmlspecialchars($info['firstName'])?> !</h1>
    <div class="gardens">
        <?php foreach ($gardens as $g) : ?>
           <?php $gardenId = $g['id'];
                 $item = $garden->findItem($gardenId);
            ?>
        <a href="detail.php?id=<?php echo $gardenId;?>" class="detail">
            <div class="singleGarden">
                <p> 
                    <img src="<?php echo $item['pic_url']?>" alt="product">
                    <h2 class="gardenname"><?php echo htmlspecialchars($g['name'])?></h2>
                    <p class="gardenname"><?php echo $item['name']?></p>
                </p>
                <a class="advicelink advice" href="detail.php?id=<?php echo $gardenId;?>">Details</a>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php include("includes/nav.php") ?>
</body>
</html>