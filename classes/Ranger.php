<?php
class Ranger extends Hero {
    private $class_id;
    private $dodge = 15;
    private $special = 70;

    /**
     * Get the value of class_id
     */
    public function getClass()
    {
        return $this->class_id;
    }

    /**
     * Set the value of class_id
     */
    public function setClass($class_id): self
    {
        $this->class_id = $class_id;

        return $this;
    }
    public function getClassName(): string {
        return get_class($this);
    }

    function __construct(string $name = null, $class_id = null, $health_point = 100, $mana = 20, $attack = 50) {
        parent::__construct($name, $health_point, $mana, $attack);
        $this->class_id = $class_id;
    }
    public function hydrate ($array){
        parent::hydrate($array);
        $this->setClass($array['class_id']);
}
    public function specialHit(Monster $monster) {
        $damage = 0;
        if (($this->getSpecial() >= rand(0, 100)) && ($this->getMana() >= 20)) {
            $damage = 20;
            $this->setMana($this->getMana() - 20);
            return $damage;
        }
        else return $damage;
    }

    /**
     * Get the value of dodge
     */
    public function getDodge()
    {
        return $this->dodge;
    }

    /**
     * Set the value of dodge
     */
    public function setDodge($dodge): self
    {
        $this->dodge = $dodge;

        return $this;
    }

    /**
     * Get the value of special
     */
    public function getSpecial()
    {
        return $this->special;
    }

    /**
     * Set the value of special
     */
    public function setSpecial($special): self
    {
        $this->special = $special;

        return $this;
    }
}

?>