<?php

trait Movement {
    public function topSpeed() {
        $this->speed = 100;
        echo "Running at 100 %!" . PHP_EOL;
    }
    public function getSpeed() {
        echo "Current speed $this->speed" . PHP_EOL;
    }
    public function stop() {
        $this->speed = 0;
        echo "Stopped moving!" . PHP_EOL;
    }
}

trait Speak {
    public function makeSound(){
        echo $this->sound . PHP_EOL; 
    }
}

class Dog {
    use Movement, Speak;  // теперь у класса Dog есть функционал из этих типажей
    protected $sound;
    
    function __construct() {
        $this->sound = 'bark';
    }
}

$dog = new Dog();
$dog->topSpeed();  // из типажа Movement
$dog->getSpeed();
$dog->stop();      // из типажа Movement
$dog->makeSound(); // из типажа Speak