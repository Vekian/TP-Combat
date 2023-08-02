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
                $iHero = $hero;
                $result = $hero->getName() . "/" . $monster->hit($hero) . "/hit";
                array_push($results, $result);
                if ($hero->getHealthPoint() > 0) {
                    $result = $monster->getName() . "/" . $hero->hit($monster) . "/hit";
                    array_push($results, $result);
                }
                else {
                    array_push($results, ($hero->getName() . "/" . $monster->getHealthPoint() . "/death/hero"));
                    break;
                }
            }
            }
            array_push($results,($monster->getName() . "/" . $iHero->getHealthPoint() . "/death/monster"));
            return $results;
        }
    }
?>