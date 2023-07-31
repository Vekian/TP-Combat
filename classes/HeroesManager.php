<?php
    class HeroesManager {
        private $db;

        public function setDb (PDO $db){
            return $this->db = $db;
        }
        public function __construct(PDO $db){
            $this->setDb($db);
        }
    }
?>