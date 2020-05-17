<?php 

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $person = new User;
    $info = $person->findCurrentUser($email);

    $currentUserId = $info['id'];
    
    $gardens = $person->findGardens($currentUserId);

} else {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" />
    <title>Home</title>
</head>
<body>
    <?php include("includes/header.php") ?>
    <h1>Welkom <?php echo htmlspecialchars($info['firstName'])?> !</h1>
    <div class="gardens">
        <?php foreach ($gardens as $garden) : ?>
           <?php $gardenId = $garden['id'];

            $vegetable = $person->findVegetable($gardenId);
            $herb = $person->findHerb($gardenId);
            $fruit = $person->findFruit($gardenId); ?>
        <a href="advice.php" class="advice">
            <div class="singleGarden">
                <p> 
                    <?php if($vegetable != false): ?>
                        <img src="public/images/tomaat.jpg" alt="product">
                        <h2><?php echo htmlspecialchars($garden['name'])?></h2>
                        <?php echo $vegetable['name']?>
                    <?php elseif($herb != false): ?>
                        <img src="public/images/basilicum.jpg" alt="product">
                        <h2><?php echo htmlspecialchars($garden['name'])?></h2>
                        <?php echo $herb['name']?>
                    <?php elseif($fruit != false): ?>
                        <img src="public/images/aardbei.jpg" alt="product">
                        <h2><?php echo htmlspecialchars($garden['name'])?></h2>
                        <?php echo $fruit['name']?>
                    <?php endif; ?>
                </p>
                <a href="advice.php">Advies</a>
            </div>
        </a>
        <?php endforeach; ?>
    </div>
    <?php include("includes/nav.php") ?>
</body>
</html>