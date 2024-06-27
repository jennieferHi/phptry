<?php
class Person {
    private $salary; // 私有属性

    private function getSalary() { // 私有方法
        return $this->salary;
    }
}

$person = new Person();
// $person->salary = 5000; // 无法直接访问私有属性
// echo $person->getSalary(); // 无法直接调用私有方法
