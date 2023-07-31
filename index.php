<?php
require_once ('config/autoload.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
</head>
<body class="d-flex justify-content-center">
    <main class="col-8">
        <?php
            $db = new PDO('mysql:host=127.0.0.1;dbname=FinalBattle;charset=utf8', 'root');
            $heroManager = new HeroesManager($db);
            if (isset($_POST['name'])){
                $hero = new Hero($_POST['name'], $_POST['avatar']);
                $heroManager->add($hero);
            }
            $heroes = $heroManager->findAllAlive();
        ?>
        <form method="POST" class="text-center bg-success bg-gradient text-light">
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
            <label for="avatar">Changez votre avatar : </label>
            <select id="avatar" name="avatar">
                <option value="images/avatar1.png">Warrior</option>
                <option value="images/avatar2.png">Ranger</option>
                <option value="images/avatar3.png">Mage</option>
                <option value="images/avatar4.png">Rogue</option>
            </select>
            <img src="" width="100px"/> 
            <input type="submit" value="Envoyer">
        </form>
        <script>
            let image = document.querySelector('img');
            document.querySelector("select").addEventListener("change", function (e) {
                let src = e.target.value;
                image.setAttribute("src", src);
            });
        </script>
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner bg-success bg-gradient rounded">
            <?php $totalHeroes = count($heroes); ?>
                    <?php for ($i = 0; $i < $totalHeroes; $i += 3) : ?>
                        <div class="carousel-item <?php if ($i === 0) echo 'active'; ?>">
                            <div class="row">
                                <?php for ($j = $i; $j < min($i + 3, $totalHeroes); $j++) : ?>
                                    <?php $hero = $heroes[$j]; ?>
                                        <div class="col-md-4">
                                        <img src="<?php echo($hero->getAvatar()); ?>" class="card-img-top" height="500px">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><?php echo($hero->getName()); ?></h5>
                                            <p class="card-text"><i class="fa-solid fa-heart" style="color: #e01b24;"></i> <?php echo($hero->getHealthpoint(). " PV"); ?></p>
                                            <form method="GET" action="fight.php">
                                                <input type="hidden" name="id" value="<?php echo($hero->getId()); ?>">
                                                <input type="submit" href="fight.php" class="btn btn-primary" value="Choisir">
                                            </form>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>
</html>