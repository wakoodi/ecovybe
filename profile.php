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
    $allGardens = $garden->findGardens($currentUserId);

} else {
    header("Location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css" >
    <link rel='stylesheet' type='text/css' href='css/style.php'>
    <title>Profiel</title>
</head>
<body class="container">
    <?php include("includes/header.php") ?>
    <h1 class="profileheader"><?php echo htmlspecialchars($info['firstName'])." ".htmlspecialchars($info['lastName'])?></h1>
    <ul class="profilesummary">
        <?php foreach ($allGardens as $oneGarden): ?>
        <li>
            <p>Heeft tuin "<?php echo $oneGarden['name']; ?>" aangemaakt </p>
            <p>op <?php echo $oneGarden['created']; ?></p>
        </li>
        <?php endforeach; ?>
    </ul>
<?php include("includes/nav.php") ?>
</body>
</html>