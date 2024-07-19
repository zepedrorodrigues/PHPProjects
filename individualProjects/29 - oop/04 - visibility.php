<?php
header('Content-Type: text/plain');

class Animal {
    public function __construct(private int $weight) {}
    public function move() {
        echo "Animal::move() has been called\n";
    }
    public function eat() {
        echo "Animal::eat() has been called ({$this->weight})\n";
    }
}
class Dog extends Animal {
    private int $weight;
    public function __construct(public string $breed, $weight) {
        $this->weight = 500;
        echo "A new dog is born\n";
        parent::__construct($weight);
    }
    public function bark() {
        echo "Dog::bark() has been called (breed: {$this->breed}, weight: {$this->weight})\n";
    }
    public function move() {
        echo "Dog::move() has been called\n";
    }
}
$dog = new Dog('Golden Retriever', 30);
var_dump($dog);
$dog->move();
$dog->bark();
$dog->eat();