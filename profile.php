<?php 

session_start();
include_once( __DIR__ . '/classes/User.php' );

if (isset($_SESSION['user'])) {
    $email = $_SESSION['user'];
    $person = new User;
    $info = $person->findCurrentUser($email);

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
    <title>Profiel</title>
</head>
<body>
    <?php include("includes/header.php") ?>
    <h1><?php echo htmlspecialchars($info['firstName'])." ".htmlspecialchars($info['lastName'])?></h1>
    <?php include("includes/nav.php") ?>
</body>
</html>