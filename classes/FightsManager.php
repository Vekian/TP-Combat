<?php
    class FightsManager {
        private $db;

        public function setDb (PDO $db){
            return $this->db = $db;
        }
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function getMonster(){
            $monsters = [];
            $query = $this->db->query('SELECT * FROM classes
                                        JOIN monsters ON classes.id = monsters.class_id ');
            $monstersData = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($monstersData as $monsterData) {
            $monster = new Monster;
            $monster->hydrate($monsterData);
            array_push($monsters, $monster);
        }
            shuffle($monsters);
            return $monsters;
        }
        public function fight($team, $monster){
            $results = [];
            $iHero= 0;
            foreach($team as $hero){
            while ($monster->getHealthPoint() > 0){
                $specialDmg = $hero->specialHit($monster);
                $iHero = $hero;
                if ($this->dodge($hero)){
                    $result = $hero->getName() . "/". 0 . "/dodge";
                    array_push($results, $result);
                }
                else {
                $result = $hero->getName() . "/" . $monster->hit($hero) . "/hit";
                array_push($results, $result);
                }
                if ($hero->getHealthPoint() > 0) {
                    if($specialDmg > 0) {
                        $result = $monster->getName() . "/" . $hero->hit($monster, $specialDmg) . "/special" . "/" . $hero->getClassName();
                        array_push($results, $result);
                    }
                    else {
                        $result = $monster->getName() . "/" . $hero->hit($monster, $specialDmg) . "/hit";
                        array_push($results, $result);
                    }
                }
                else {
                    array_push($results, ($hero->getName() . "/" . $monster->getHealthPoint() . "/death/hero"));
                    break;
                }
                if ($hero->getMana() <= 50) {
                $hero->setMana($hero->getMana() + 10);
                }
            }
            }
            if ($monster->getHealthPoint() < 0){
            array_push($results,($monster->getName() . "/" . $iHero->getHealthPoint() . "/death/monster"));
            return $results;
            }
            else {
                array_push($results,($hero->getName() . "/" . $iHero->getHealthPoint() . "/death/hero"));
                return $results;
            }
        }

        public function dodge(Hero $hero){
            if ($hero-> getDodge() >= (rand(0, 100))) {
                return true;
            }
            else return false;
        }
    }
?>