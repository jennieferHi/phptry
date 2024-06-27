<?php
class Person {
    public $name_public;
    protected $name_protected;
    private $name_private;

    public function __construct($name) {
        $this->name_public = $name;
        $this->name_protected = $name;
        $this->name_private = $name;
    } 
    public function getNamePublic() {
        return $this->name_protected;
    }    
     protected function getNameProtected() {
        return $this->name_protected;
    } 
    private function getNamePrivate() {
        return $this->name_private;
    }
}

class Student extends Person {
    public function getNameFromParent() {
        return $this->name_protected; // 可以访问受保护属性
    }
    public function getNameFromParent2() {
        return $this->name_public; // 可以访问受保护属性
    }
}

$person = new Person("Alice");

echo $person->name_public . "\n"; // 可以访问公共属性
// echo $person->name_protected . "\n"; // 无法直接访问受保护属性
// echo $person->name_private . "\n"; // 无法直接访问私有属性

echo $person->getNamePublic() . "\n"; // 可以通过公共方法访问公共属性的值
// echo $person->getNameProtected() . "\n"; // 无法直接调用受保护方法
// echo $person->getNamePrivate() . "\n"; // 无法直接调用私有方法

$student = new Student("Bob");
echo $student->getNameFromParent() . "\n"; // 可以访问从父类继承的受保护属性
echo $student->getNameFromParent2() . "\n"; //  public
