<?php
class Person {
    protected $age; // 受保护属性

    protected function getAge() { // 受保护方法
        return $this->age;
    }
}

class Student extends Person {
    public function displayAge() {
        return "Age: " . $this->getAge();
    }
}

$student = new Student();
// $student->age = 20; // 无法直接访问受保护属性
echo $student->displayAge(); // 输出: Age: 20