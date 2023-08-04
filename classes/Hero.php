<?php
    class Hero {
        protected int $id;
        protected $name;
        protected int $health_point;
        protected $attack;
        protected $avatar;
        protected $mana;

        public function __construct($name, $health_point, $attack, $mana){
                $this->name = $name;
                $this->health_point = $health_point;
                $this->attack = $attack;
                $this->mana = $mana;
        }

        /**
         * Set the value of id
         */
        public function setId(int $id): self
        {
                $this->id = $id;

                return $this;
        }
        public function getId(): int
        {
                return $this->id;
        }

        /**
         * Get the value of name
         */
        public function getName(): string
        {
                return $this->name;
        }

        /**
         * Set the value of name
         */
        public function setName(string $name): self
        {
                $this->name = $name;

                return $this;
        }

                /**
         * Get the value of health_point
         */
        public function getHealthPoint(): int
        {
                return $this->health_point;
        }

        /**
         * Set the value of health_point
         */
        public function setHealthPoint(int $health_point): self
        {
                $this->health_point = $health_point;

                return $this;
        }

        /**
         * Get the value of avatar
         */
        public function getAvatar()
        {
                return $this->avatar;
        }
        public function setAvatar($avatar): self
        {
        $this->avatar = $avatar;

        return $this;
        }

        public function hit(Monster $monster, $specialDmg){
            $damage = (rand(0, $this->getAttack())) + $specialDmg;
            $monsterHealthPoint = $monster->getHealthPoint();
            $monster->setHealthPoint($monsterHealthPoint - $damage);
            return $damage;
        }

        public function hydrate ($array){
                $this->setId($array['id']);
                $this->setName($array['name']);
                $this->setHealthPoint($array['health_point']);
                $this->setAvatar($array['avatar']);
                $this->setAttack($array['attack']);
                $this->setMana($array['mana']);
        }


        /**
         * Get the value of attack
         */
        public function getAttack()
        {
                return $this->attack;
        }

        /**
         * Set the value of attack
         */
        public function setAttack($attack): self
        {
                $this->attack = $attack;

                return $this;
        }

        /**
         * Get the value of mana
         */
        public function getMana()
        {
                return $this->mana;
        }

        /**
         * Set the value of mana
         */
        public function setMana($mana): self
        {
                $this->mana = $mana;

                return $this;
        }
    }
