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
    <link rel = 'stylesheet' href = 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity = 'sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin = 'anonymous'>
    <link rel="stylesheet" href="css/style.css" />
    <title>Tuin</title>
</head>
<body>
    <?php include("includes/header.php") ?>
    <?php if ( isset( $success ) ): ?>
        <div class = 'alert alert-success' role = 'alert'>
            <?php echo $success ?>
        </div>
    <?php endif; ?>
    <h1>Nieuwe tuin toevoegen:</h1>
    <form action="" method="post">
      <div class="form-group">
        <img src="public/icons/plant.png" alt="plant icon">
        <input type="text" placeholder="Naam tuin" name="gardenName" id="gardenName" class="form-control">
      </div>
      <div class="form-group">
        <div class="dropdown">
        <label for="item">Kies wat je zal kweken</label></br>
            <select name="item" class="form-control">
                <?php foreach ($items as $item): ?>
                    <option value="<?php echo $item['id'] ?>"><?php echo $item['name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
      </div>
      <div class="form-group">
        <img src="public/icons/plant.png" alt="plant icon">
        <input type="text" placeholder="Kit Code" name="kitCode" id="kitCode" class="form-control">
        <p class="kitCodeInfo">Deze code is terug te vinden op de Ecovybe kit.</p>
      </div>
      <div>
        <input type="submit" value="Start met groeien!" class="btn btn-primary">
      </div>
    </form>
    <?php include("includes/nav.php") ?>
</body>
<script src = 'https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity = 'sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin = 'anonymous'></script>
    <script src = 'https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity = 'sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin = 'anonymous'></script>
    <script src = 'https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity = 'sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin = 'anonymous'></script>
</html>

