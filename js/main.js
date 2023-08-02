function addShakeEffect(cardContainer) {
    cardContainer.classList.add('shake-animation');

    setTimeout(() => {
        cardContainer.classList.remove('shake-animation');
    }, 400); // Supprime la classe d'animation après 1 seconde (1000 millisecondes)
    }
function hpBar(characterHP, characterHPLeft, side, heroNumber){
    if (side == "hero"){
    let percentage = (100 * characterHPLeft)/characterHP; 
    console.log(percentage);// Remplacez cette valeur par le pourcentage réel que vous voulez afficher
    let progressBar = document.getElementsByClassName('progress-fill-hero');
        if (characterHPLeft <= 0){
            progressBar[heroNumber].style.width = 0 + '%';
            percentage = 0;
        } 
        progressBar[heroNumber].style.width = percentage + '%';
    }
    else {
        let percentage = 100 * (characterHPLeft/characterHP); // Remplacez cette valeur par le pourcentage réel que vous voulez afficher
        let progressBar = document.querySelector('.progress-fill-monster');
        if (characterHPLeft <= 0){
            progressBar.style.width = 0 + '%';
        } 
        progressBar.style.width = percentage + '%';
    }
}

function battleStart(results) {
    let i = 0;
    let heroNumber = 0;
    let heroHP = heroHPLeft[heroNumber];
    let monsterHP = document.getElementById('monsterHP').innerHTML;
    const battle = setInterval(() => {
        let result = results[i].split("/");
        if (result[2] === "hit") {
        if( (i === 0) || (i % 2 === 0) ){
        document.getElementById('results').innerHTML = result[0] + " a subit " + result[1] + ' dommages<br />';
        heroHPLeft[heroNumber] -= result[1];
        hpBar(heroHP, heroHPLeft[heroNumber], "hero", heroNumber);
        document.getElementById('heroHP' + heroNumber).innerHTML = heroHPLeft[heroNumber];
        let heroContainer = document.querySelector('#hero-container' + heroNumber);
        addShakeEffect(heroContainer);
        }
        else {
            document.getElementById('results').innerHTML = result[0] + " a subit " + result[1] + ' dommages<br />';
            monsterHPLeft -= result[1];
            hpBar(monsterHP, monsterHPLeft), "monster";
            document.getElementById('monsterHP').innerHTML = monsterHPLeft;
            let monsterContainer = document.querySelector('.monster-container');
            addShakeEffect(monsterContainer);
        }
        i++;}
        else if (result[2] === "death"){
            if (result[3] === "hero") {
            document.getElementById('hero-container' + heroNumber).classList.add('d-none');
            heroNumber++;
            document.getElementById('hero-container' + heroNumber).classList.remove('d-none');
            document.getElementById('results').innerHTML = result[0] + " est mort, il reste " + result[1] + "PV au monstre.";
            i++;}
            else if (result[3] === "monster") {
                document.getElementById('results').innerHTML = result[0] + " est mort, il reste " + result[1] + "PV au héros.";
            }
        }
        if (i >= results.length) {
            clearInterval(battle);
        }
    }, 1000);
    }
    battleStart(dataFight);

    