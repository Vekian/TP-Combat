<?php
    class HeroesManager {
        private $db;

        public function setDb (PDO $db){
            return $this->db = $db;
        }
        public function __construct(PDO $db){
            $this->setDb($db);
        }

        public function add(Hero $hero) {
            $query = $this->db->prepare('INSERT INTO heroes(name, avatar) VALUES (:name, :avatar)');
            $query->bindValue(':name', $hero->getName());
            $query->bindValue(':avatar', $hero->getAvatar());
            $query->execute();
            $id = $this->db->lastInsertId();
            $hero->setId($id);
            $hero->setHealthPoint(100);
        }

        public function findAllAlive() {
            $query = $this->db->query('SELECT * FROM heroes WHERE health_point > 0');
            $heroesAlive = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Hero");
            return $heroesAlive;
        }
    }
?>