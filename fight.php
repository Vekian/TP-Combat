<?php
require_once('config/db.php');
require_once ('config/autoload.php');
$heroManager = new HeroesManager($db);
$heroManager->teamMaker($_POST['team']);
$team = $heroManager->getTeam();
$heroHPTeam = [];
foreach($team as $hero){
    $heroHP = $hero->getHealthPoint();
    array_push($heroHPTeam, $heroHP);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main class="col-12 d-flex flex-column align-items-center">
        <div class="col-12 d-flex justify-content-center">
            <div class="col-md-3 rounded me-5 hero-container" id="hero-container0">
                <img src="<?php echo($team[0]->getAvatar()); ?>" class="card-img-top" height="430px">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo(ucwords($team[0]->getName())); ?></h5>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                            <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i> <span id="heroHP0"><?php echo($heroHPTeam[0]); ?></span> PV</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded me-5 hero-container d-none" id="hero-container1">
                <img src="<?php echo($team[1]->getAvatar()); ?>" class="card-img-top" height="430px">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo(ucwords($team[1]->getName())); ?></h5>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                            <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i> <span id="heroHP1"><?php echo($heroHPTeam[1]); ?></span> PV</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 rounded me-5 hero-container d-none" id="hero-container2">
                <img src="<?php echo($team[2]->getAvatar()); ?>" class="card-img-top" height="430px">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo(ucwords($team[2]->getName())); ?></h5>
                    <div class="progress-bar-hero">
                        <div class="progress-fill-hero">
                            <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i> <span id="heroHP2"><?php echo($heroHPTeam[2]); ?></span> PV</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 rounded ms-5 monster-container">
                <img src="<?echo ($monster->getAvatar()); ?>" class="card-img-top" height="430px">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo(ucwords($monster->getName())); ?></h5>
                    <div class="progress-bar-monster">
                        <div class="progress-fill-monster">
                            <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i><span id="monsterHP"><?php echo($monsterHP); ?></span> PV</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="results">
        </div>
        <div class="col-4 mt-5">
            <a href="index.php" class="btn btn-primary col-12" id="fight" > Choisir un nouvel héros </a href="index.php">
        </div>
    </main>

<script>
    let dataFight = <?= $results ?>;
    let heroHPLeft = <?php echo(json_encode($heroHPTeam)); ?>;
    let monsterHPLeft = <?php echo($monsterHP); ?>;
    let heroNumber = 0;
</script>
<script src="js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

</body>
</html>