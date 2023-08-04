<?php
    class HeroesManager {
        private $db;
        private $team;

        public function setDb (PDO $db){
            return $this->db = $db;
        }
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function add(Hero $hero) {
            $query = $this->db->prepare('INSERT INTO heroes(name, health_point, mana, attack, class_id) VALUES (:name, :health_point, :mana, :attack, :class_id)');
            $query->bindValue(':name', $hero->getName());
            $query->bindValue(':class_id', $hero->getClass());
            $query->bindValue(':attack', $hero->getAttack());
            $query->bindValue(':health_point', $hero->getHealthPoint());
            $query->bindValue(':mana', $hero->getMana());
            $query->execute();
            $id = $this->db->lastInsertId();
            $hero->setId($id);
            $hero->setHealthPoint(100);
        }

        public function find(int $id){
            $query = $this->db->query('SELECT * FROM classes
                                        JOIN heroes ON classes.id = heroes.class_id 
                                        WHERE heroes.id = "' . $id . '"');
            $heroSelected = $query->fetchAll(PDO::FETCH_ASSOC);
            $heroData = $heroSelected[0];
            $className = $heroData['nameClass'];
                $hero = new $className();
                $hero->hydrate($heroData);
            return $hero;
        }

        public function findAllAlive() {
            $query = $this->db->query('SELECT * FROM classes
                                    JOIN heroes ON classes.id = heroes.class_id
                                     WHERE health_point > 0
                                     ORDER BY heroes.id ASC');
            $heroesAliveData = $query->fetchAll(PDO::FETCH_ASSOC);

            $heroesAlive = [];
            foreach ($heroesAliveData as $heroData) {
                $className = $heroData['nameClass'];
                $hero = new $className();
                $hero->hydrate($heroData);
                array_push($heroesAlive, $hero);
            }
            return $heroesAlive;
        }
        public function update($team){
            foreach($team as $hero){
                $query = $this->db->prepare('UPDATE heroes SET health_point = :health_point, mana = :mana WHERE id = :id');
            $query->bindValue(':health_point', $hero->getHealthPoint());
            $query->bindValue(':mana', $hero->getMana());
            $query->bindValue(':id', $hero->getId());
            $query->execute();
            }
            
        }
        public function teamMaker($array) {
            $team = [];
            foreach($array as $key => $value){
                $hero = $this->find($value);
                array_push($team, $hero);
            }
            $this->setTeam($team);
        }

        /**
         * Get the value of team
         */
        public function getTeam()
        {
                return $this->team;
        }

        /**
         * Set the value of team
         */
        public function setTeam($team): self
        {
                $this->team = $team;

                return $this;
        }
    }
?>