<?php
require_once ('config/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
        <input type="submit" value="Envoyer">
    </form>

    <?php
        $db = new PDO('mysql:host=127.0.0.1;dbname=FinalBattle;charset=utf8', 'root');
        $heroManager = new HeroesManager($db);
        if (isset($_POST['name'])){
            $hero = new Hero($_POST['name']);
            $heroManager->add($hero);
        }
        $heroes = $heroManager->findAllAlive();
    ?>
</body>
</html>