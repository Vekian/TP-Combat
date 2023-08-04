<?php
require_once('config/db.php');
require_once ('config/autoload.php');
$heroManager = new HeroesManager($db);
$heroManager->teamMaker($_POST['team']);
$team = $heroManager->getTeam();
$heroHPTeam = [];
$heroManaTeam = [];
foreach($team as $hero){
    $heroHP = $hero->getHealthPoint();
    array_push($heroHPTeam, $heroHP);
    $heroMana = $hero->getMana();
    array_push($heroManaTeam, $heroMana);
}
$fightManager = new FightsManager($db);
$monsters = $fightManager->getMonster();
$monster = $monsters[0];
$monsterHP = $monster->getHealthPoint();
$fightResults = $fightManager->fight($team, $monster);
$results = json_encode($fightResults);
$heroManager->update($team);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="col-12 d-flex flex-column align-items-center">
        <div class="col-12 d-flex justify-content-center">
            <div class="col-md-3 col-6 rounded me-md-5 hero-container" id="hero-container0">
                <img src="<?php echo($team[0]->getAvatar()); ?>" class="card-img-top" >
                <div class="card-body text-light text-center p-3 ">
                    <p class="card-title"><?php echo(ucwords($team[0]->getName())); ?></p>
                    <p class="card-text"> <span id="heroHP0" class="me-2"> <?php echo($heroHPTeam[0]); ?></span><i class="fa-solid fa-heart me-3" style="color: #e01b24;"></i><span id="heroMana0" class="me-1"><?php echo($heroManaTeam[0]); ?></span><img id="mana" src="images/mana.png" height="24px" class="me-2"></p>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                        </div>
                    </div>
                    <div class="mana-bar-hero">
                        <div class="mana-fill-hero">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 rounded me-md-5 hero-container d-none" id="hero-container1">
                <img src="<?php echo($team[1]->getAvatar()); ?>" class="card-img-top" >
                <div class="card-body text-light text-center p-3">
                    <p class="card-title"><?php echo(ucwords($team[1]->getName())); ?></p>
                    <p class="card-text"><span id="heroHP1" class="me-2"><?php echo($heroHPTeam[1]); ?>  </span><i class="fa-solid fa-heart me-3" style="color: #e01b24;"></i><span id="heroMana1" class="me-1"><?php echo($heroManaTeam[1]); ?></span><img id="mana" src="images/mana.png" height="24px" class="me-2"></p>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                        </div>
                    </div>
                    <div class="mana-bar-hero">
                        <div class="mana-fill-hero">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6 rounded me-md-5 hero-container d-none" id="hero-container2">
                <img src="<?php echo($team[2]->getAvatar()); ?>" class="card-img-top" >
                <div class="card-body text-light text-center p-3">
                    <p class="card-title"><?php echo(ucwords($team[2]->getName())); ?></p>
                    <p class="card-text"><span id="heroHP2" class="me-2"><?php echo($heroHPTeam[2]); ?>  </span><i class="fa-solid fa-heart me-3" style="color: #e01b24;"></i><span id="heroMana2" class="me-1"><?php echo($heroManaTeam[2]); ?></span><img id="mana" src="images/mana.png" height="24px" class="me-2"></p>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                        </div>
                    </div>
                    <div class="mana-bar-hero">
                        <div class="mana-fill-hero">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 ms-2 col-6 rounded ms-md-5 monster-container">
                <img src="<?echo ($monster->getAvatar()); ?>" class="card-img-top" >
                <div class="card-body text-light text-center p-3">
                    <p class="card-title"><?php echo(ucwords($monster->getName())); ?></p>
                    <p class="card-text"><span id="monsterHP" class="me-2"><?php echo(" " . $monsterHP); ?></span><i class="fa-solid fa-heart me-3" style="color: #e01b24;"></i><span id="monsterMana" class="me-1"><?php echo($monster->getMana()); ?></span><img id="mana" src="images/mana.png" height="24px" class="me-2"></p>
                    <div class="progress-bar-monster">
                        <div class="progress-fill-monster">
                        </div>
                    </div>
                    <div class="mana-bar-monster">
                        <div class="mana-fill-monster">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="results" class="text-light card-body p-4 mt-4">
        </div>
        <div class="col-md-4 col-8 mt-5">
            <a href="index.php" class="btn btn-primary col-12" id="fight" > Choisir un nouvel héros </a href="index.php">
        </div>
    </main>

<script>
    let dataFight = <?= $results ?>;
    let heroHP = <?php echo(json_encode($heroHPTeam)); ?>;
    let heroHPLeft = <?php echo(json_encode($heroHPTeam)); ?>;
    let heroMana = [50, 50, 50];
    let heroManaLeft = <?php echo(json_encode($heroManaTeam)); ?>;
    let monsterHPLeft = <?php echo($monsterHP); ?>;
    let monsterHP = <?php echo($monsterHP); ?>;
    let monsterMana = 50;
    let monsterManaLeft = 10;
    let heroNumber = 0;
</script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>