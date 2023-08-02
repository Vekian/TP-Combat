<?php
class Mage extends Hero {
    private $class_id;

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

    function __construct(string $name = null, $class_id = null) {
        parent::__construct($name);
        $this->class_id = $class_id;
    }
    public function hydrate ($array){
        parent::hydrate($array);
        $this->setClass($array['class_id']);
}
}
?>