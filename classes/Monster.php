<?php
    class Monster {
        private $id;
        private $name;
        private $healthPoint;
        private $avatar;
        private $class_id;
        private $poison = false;



        /**
         * Get the value of name
         */
        public function getName()
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName($name): self
        {
                $this->name = $name;

                return $this;
        }

        /**
         * Get the value of healthPoint
         */
        public function getHealthPoint()
        {
                return $this->healthPoint;
        }

        /**
         * Set the value of healthPoint
         */
        public function setHealthPoint($healthPoint): self
        {
                $this->healthPoint = $healthPoint;

                return $this;
        }

        public function __construct($name=null, $healthPoint = 100) {
            $this->setName($name);
            $this->setHealthPoint($healthPoint);
        }

        public function hit(Hero $hero){
                $damage = (rand(0, 50));
                if($this->advantage($hero)){
            $damage *= 2;
                }
            $heroHealthPoint = $hero->getHealthPoint();
            $hero->setHealthPoint($heroHealthPoint - $damage);
            return $damage;
        }

        public function advantage(Hero $hero){
                $idClass = $hero->getClass();
                $arrayHero = [1, 2, 3, 4];
                $arrayMonster = [6, 8, 7, 5];
                $index = array_search($idClass, $arrayHero);
                if ($this->getClassId() === $arrayMonster[$index]){
                        return true;
                }
                else return false;
        }

        /**
         * Get the value of id
         */
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         */
        public function setId($id): self
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of avatar
         */
        public function getAvatar()
        {
                return $this->avatar;
        }

        /**
         * Set the value of avatar
         */
        public function setAvatar($avatar): self
        {
                $this->avatar = $avatar;

                return $this;
        }

        /**
         * Get the value of class_id
         */
        public function getClassId()
        {
                return $this->class_id;
        }

        /**
         * Set the value of class_id
         */
        public function setClassId($class_id): self
        {
                $this->class_id = $class_id;

                return $this;
        }
        public function hydrate ($array){
            $this->setId($array['id']);
            $this->setName($array['name']);
            $this->setHealthPoint($array['health_point']);
            $this->setAvatar($array['avatar']);
            $this->setClassId($array['class_id']);
        }
    }  
?>