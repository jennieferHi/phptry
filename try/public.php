<?php
class Person {
    public $name; // 公共属性

    public function greet() { // 公共方法
        return "Hello, my name is {$this->name}.";
    }
}

$person = new Person();
$person->name = "Alice";
echo $person->greet(); // 输出: Hello, my name is Alice.
