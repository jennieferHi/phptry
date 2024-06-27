<?php
class Person {
    protected $name;
    protected $age;
    public static $count = 0;

    public function __construct($name, $age) {
        $this->name = $name;
        $this->age = $age;
        self::$count++;
    }
      // 解構子
      public function __destruct() { 
        Person::getMsg("hi");
        echo "{$this->name} is destroyed.<br/>";
    }
    public function getData(){
        return "Hello, my name is {$this->name} and I am {$this->age} years old.<br/>";
    }
    // 靜態方法可以過建立物件而進行存取操作
     static function getMsg($msg){
      
        return $msg."<br/>";
    }

}
class Student extends Person {
    protected $studentId;
    protected $grade;

    public function __construct($name, $age,$studentId, $grade) {
        parent::__construct($name, $age);
        $this->studentId = $studentId;
        $this->grade = $grade;
    }
    public function getData(){
        return "Hello, my name is {$this->name} and I am {$this->age} years old. and my id is {$this->studentId} and mygrad is {$this->grade}<br/> ";
    }
    
}
class Teacher extends Person {
    protected $teacherId;
    protected $title;

    public function __construct($name, $age,$teacherId, $title) {
        parent::__construct($name, $age);
        $this->teacherId = $teacherId;
        $this->title = $title;
    }
    public function getData(){
        return "Hello, my name is {$this->name} and I am {$this->age} years old. and my id is {$this->teacherId} and mytitle is {$this->title}<br/> ";
    }
    
}
echo Person::getMsg("hi");
echo Person::getMsg("窩不需要建立就可以使用，超可愛喔");
$person1=new Person("marrie",20); 
// echo $student1->name; 
echo $person1->getData();
echo $person1->getData();
$person2=new Student("marrie",20,1,100); 
echo $person2->getData();
$person2=new Teacher("teacher",30,13,"so pretty"); 
echo $person2->getData();
echo Person::$count; // 输出 
