<?php
require_once('config/db.php');
require_once ('config/autoload.php');
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body class="d-flex flex-column align-items-center">
    <main class="col-10 col-md-8">
        <?php

            $heroManager = new HeroesManager($db);
            if (isset($_POST['name'])){
                    $hero = new $_POST['className'](htmlspecialchars($_POST['name']), $_POST['idClass']);
                $heroManager->add($hero);
            }
            $heroes = $heroManager->findAllAlive();
            
        ?>
        <header class="text-light">
        <form method="POST" class="text-center m-4">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" class="col-10 col-md-3">
            <label for="avatar" class="mt-1">Choisissez votre classe : </label>

            
            <select name="idClass" id="idClass" class="m-2" >
            <?php $query = $db->query('SELECT * FROM classes WHERE side = "hero"');
                $classes = $query->fetchAll(PDO::FETCH_ASSOC);
                $jsonClasses = json_encode($classes);
                echo('<option value="" selected disabled hidden>Choisir</option>');
                foreach($classes as $class) {
                    echo('<option value="'. $class['id'] . '">' . $class['nameClass'] . '</option>');
                }
            ?>
            </select class="btn btn-primary">
            <input type="hidden" id="avatar" name="avatar"  value="">
            <input type="hidden" id="className" name="className" value="">
            <img src="" width="100px"/> 
            <input type="submit" value="Envoyer" class="btn btn-primary">
        </form>
        </header>
        
        <script>
            let image = document.querySelector('img');
            let classes = <?= $jsonClasses ?>;
            document.querySelector("select").addEventListener("change", function (e) {
                let idClass = e.target.value;
                let src;
                let className;
                for(let i =0; i < classes.length; i++) {
                    if (idClass == classes[i]['id']){
                        src = classes[i]['avatar'];
                        className = classes[i]['nameClass'];
                    }
                }
                image.setAttribute("src", src);
                document.getElementById('avatar').value = src;
                document.getElementById('className').value = className;
            });
        </script>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner rounded">
            <?php $totalHeroes = count($heroes); ?>
                    <?php for ($i = 0; $i < $totalHeroes; $i += 3) : ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < min($i + 3, $totalHeroes); $j++) : ?>
                                    <?php $hero = $heroes[$j]; ?>
                                        <div class="col-md-4">
                                        <img src="<?php echo($hero->getAvatar()); ?>" class="card-img-top">
                                        <div class="card-body text-light  text-center">
                                            <h5 class="card-title"><?php echo(ucwords($hero->getName())); ?></h5>
                                            <p class="card-text">Classe : <?php echo($hero->getClassName()) ?><br /><?php echo("<span class='me-2'>" . $hero->getHealthpoint() . "</span>"); ?><i class="fa-solid fa-heart me-3 " style="color: #e01b24;"> </i><?php echo("<span >" . $hero->getMana() . "</span>"); ?><img id="mana" src="images/mana.png" height="24px" class="me-2"><?php echo("<span class='me-2'>" . $hero->getAttack() . "</span>"); ?><img id="attack" src="images/attack.png" height="24px"></p>
                                            <button class="btn btn-primary mb-3 submit" value="<?php echo($hero->getId()); ?>">Ajouter</button>
                                            <a href="process/deleteHero.php?id=<?php echo($hero->getId()); ?>"><i class="fa-solid fa-trash-can fa-xl"></i></a>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
                    <?php endfor; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </main>
    <section class="text-center text-light">
        <div class="text-center">
            <form method="POST" action="fight.php" id="formTeam">
                
            </form>
        </div>
        <p class="mt-3">Votre équipe actuelle : </p>
        <div id="heroesTeam" class="d-flex align-items-center text-light">
            
                <ul>
                    
                    
                </ul>
        </div>
    </section>
        <script>
            let buttonsSubmit = document.getElementsByClassName('submit');
            function findHero(id){
                $array = [];
                fetch('process/getHero.php', {
                    method: "POST",
                    body: JSON.stringify(id)
                    }
                )
                .then(function(response) {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Erreur lors de la requête AJAX');
                }
                })
                .then(function(data) {

                    document.getElementById('heroesTeam').innerHTML += `<div class="me-md-5 m-md-3 mt-3 p-2 card-body text-center d-flex flex-column">
                                            <h5 class="card-title">${data.name}</h5>
                                            <p class="card-text">Classe : ${data.nameClass}<br /><i class="fa-solid fa-heart" style="color: #e01b24;"></i> ${data.health_point} PV</p>
                                            </div>`;
                    
                })
                .catch(function(error) {
                console.log(error);
                });
            }
            let numberOfHeroes = 0;
            let teamOfHeroes = [];
            for(let button of buttonsSubmit ){
            button.addEventListener('click', function(e){
                findHero(e.target.value);
                document.getElementById('formTeam').innerHTML += `<input type="hidden" name="team[]" value="${e.target.value}">`;
                numberOfHeroes++;
                teamOfHeroes.push(e.target.value);
                button.classList.add('invisible');
                if (numberOfHeroes === 3) {
                    for(let input of buttonsSubmit ){
                    input.classList.add('invisible');
                    };
                    document.getElementById('formTeam').innerHTML += `<input type="submit" value="FIGHT" class="btn btn-primary pt-3 pb-3 m-2 col-4">`;
                }            
            })}
        </script>
    <form action="process/heal.php" method="POST">
        <input type="hidden" name="heal" value="1">
        <input type="submit" value="Soigner tous les héros" class="btn btn-primary mt-2">
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>