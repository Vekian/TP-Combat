function addShakeEffect(cardContainer) {
    cardContainer.classList.add('shake-animation');

    setTimeout(() => {
        cardContainer.classList.remove('shake-animation');
    }, 400); // Supprime la classe d'animation après 1 seconde (1000 millisecondes)
    }
function hpBar(characterHP, characterHPLeft, side, heroNumber){
    if (side == "hero"){
    let percentage = (100 * characterHPLeft)/characterHP; // Remplacez cette valeur par le pourcentage réel que vous voulez afficher
    let progressBar = document.getElementsByClassName('progress-fill-hero');
        if (characterHPLeft <= 0){
            progressBar[heroNumber].style.width = 0 + '%';
            percentage = 0;
        } 
        progressBar[heroNumber].style.width = percentage + '%';
    }
    else {
        console.log(characterHP);
        let percentage = 100 * (characterHPLeft/characterHP); // Remplacez cette valeur par le pourcentage réel que vous voulez afficher
        let progressBarMonster = document.getElementsByClassName('progress-fill-monster');
        if (characterHPLeft <= 0){
            progressBarMonster[0].style.width = 0 + '%';
        } 
        progressBarMonster[0].style.width = percentage + '%';
    }
}

function manaBar(characterMana, characterManaLeft, side, heroNumber){
    if (side == "hero"){
    let percentage = (100 * characterManaLeft)/characterMana; // Remplacez cette valeur par le pourcentage réel que vous voulez afficher
    let progressBar = document.getElementsByClassName('mana-fill-hero');
        if (characterManaLeft <= 0){
            progressBar[heroNumber].style.width = 0 + '%';
            percentage = 0;
        } 
        progressBar[heroNumber].style.width = percentage + '%';
    }
    else {
        let percentage = 100 * (characterManaLeft/characterMana); // Remplacez cette valeur par le pourcentage réel que vous voulez afficher
        let progressBar = document.querySelector('.mana-fill-monster');
        if (characterManaLeft <= 0){
            progressBar.style.width = 0 + '%';
        } 
        progressBar.style.width = percentage + '%';
    }
}

function battleStart(results) {
    let arraySpecial = {
        'Mage' : 'Le héros lance une boule de feu !',
        'Warrior' : "Le héros lance un puissant coup !",
        'Ranger' : "Le héros décoche plusieurs flèches !",
        'Rogue' : "Le héros effectue une attaque sournoise !"
    };
    let i = 0;
    let heroNumber = 0;
    manaBar(heroMana[heroNumber], heroManaLeft[heroNumber], "hero", heroNumber);
    manaBar(monsterMana, monsterManaLeft, "monster", heroNumber);
    const battle = setInterval(() => {
        document.querySelector('.monster-container').classList.remove('flash');
        document.querySelector('#hero-container'+ heroNumber).classList.remove('flash');
        let result = results[i].split("/");
        if (result[2] === "dodge") {
            document.getElementById('results').innerHTML = result[0] + " a esquivé l'attaque.<br />";
            
        }
        else if (result[2] === "special"){
            if ((i % 2 != 0)) {
            document.getElementById('results').innerHTML = arraySpecial[result[3]] + result[0] + " a subit " + result[1] + ' dommages<br />';
            monsterHPLeft -= result[1];
            if (monsterHPLeft < 0) {
                monsterHPLeft = 0;
            };
            heroManaLeft[heroNumber] -= 20;
            hpBar(monsterHP, monsterHPLeft, "monster", heroNumber);
            manaBar(heroMana[heroNumber], heroManaLeft[heroNumber], "hero", heroNumber);
            document.getElementById('monsterHP').innerHTML = monsterHPLeft;
            document.getElementById('heroMana' + heroNumber).innerHTML = heroManaLeft[heroNumber];
            monsterManaLeft += 10;
            manaBar(monsterMana, monsterManaLeft, "monster", heroNumber);
            document.getElementById('monsterMana').innerHTML = monsterManaLeft;
            let monsterContainer = document.querySelector('.monster-container');
            addShakeEffect(monsterContainer);
            monsterContainer.classList.add('flash');
            }
            else {
                document.getElementById('results').innerHTML = result[0] + " s'enrage et lance un puissant coup ! Le héros subit " + result[1] + ' dommages<br />';
                heroHPLeft[heroNumber] -= result[1];
                if (heroHPLeft[heroNumber] < 0) {
                    heroHPLeft[heroNumber] = 0;
                }
                hpBar(heroHP[heroNumber], heroHPLeft[heroNumber], "hero", heroNumber);
                monsterManaLeft -= 50;
                manaBar(monsterMana, monsterManaLeft, "monster", heroNumber);
                document.getElementById('monsterMana').innerHTML = monsterManaLeft;
                document.getElementById('heroHP' + heroNumber).innerHTML = heroHPLeft[heroNumber];
                let heroContainer = document.querySelector('#hero-container' + heroNumber);
                addShakeEffect(heroContainer);
                heroContainer.classList.add('flash');
            }
        }
        else if (result[2] === "hit") {
            if ((i === 0) || (i % 2 === 0)) {
                    document.getElementById('results').innerHTML = result[0] + " a subit " + result[1] + ' dommages<br />';
                    heroHPLeft[heroNumber] -= result[1];
                    if (heroHPLeft[heroNumber] < 0) {
                        heroHPLeft[heroNumber] = 0;
                    }
                    hpBar(heroHP[heroNumber], heroHPLeft[heroNumber], "hero", heroNumber);
                    document.getElementById('heroHP' + heroNumber).innerHTML = heroHPLeft[heroNumber];
                    let heroContainer = document.querySelector('#hero-container' + heroNumber);
                    addShakeEffect(heroContainer);
            }
        else {
            document.getElementById('results').innerHTML = result[0] + " a subit " + result[1] + ' dommages<br />';
            monsterHPLeft -= result[1];
            if (monsterHPLeft < 0) {
                monsterHPLeft = 0;
            };
            hpBar(monsterHP, monsterHPLeft, "monster", heroNumber);
            monsterManaLeft += 5;
            manaBar(monsterMana, monsterManaLeft, "monster", heroNumber);
            document.getElementById('monsterMana').innerHTML = monsterManaLeft;
            document.getElementById('monsterHP').innerHTML = monsterHPLeft;
            let monsterContainer = document.querySelector('.monster-container');
            addShakeEffect(monsterContainer);
        }
        }
        else if (result[2] === "death"){
            if (result[3] === "hero") {
                if(heroNumber === 2){
                    document.getElementById('hero-container' + heroNumber).classList.add('d-none');
                    document.getElementById('hero-container' + heroNumber).classList.remove('d-none');
                    heroNumber++;
                    document.getElementById('results').innerHTML = "Vous avez perdu !<br /> " + result[0] + " est mort, il reste " + result[1] + "PV au monstre.";
                }
                else {
            document.getElementById('hero-container' + heroNumber).classList.add('d-none');
            heroNumber++;
            document.getElementById('hero-container' + heroNumber).classList.remove('d-none');
            document.getElementById('results').innerHTML = result[0] + " est mort, il reste " + result[1] + "PV au monstre.";
            }}
            else if (result[3] === "monster") {
                document.getElementById('results').innerHTML = "Bravo !<br /> " + result[0] + " est mort, il reste " + result[1] + "PV au héros.";
                clearInterval(battle);
            }
        }
        if ((i % 2 != 0)) {
            heroManaLeft[heroNumber] += 10;
            manaBar(heroMana[heroNumber], heroManaLeft[heroNumber], "hero", heroNumber);
            document.getElementById('heroMana' + heroNumber).innerHTML = heroManaLeft[heroNumber];
        };
        i++;
        if (i >= results.length) {
            clearInterval(battle);
        }
    }, 1000);
    }
    battleStart(dataFight);

    