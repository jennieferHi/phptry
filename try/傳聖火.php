<?php
//  在物件導向程式設計中，如果類別 C 繼承自類別 B，而類別 B 又繼承自類別 A，那麼類別 C 是可以使用類別 A 中定義的屬性和方法的。
// Class A
class A {
    public function methodA() {
        return "Method A from class A";
    }
}

// Class B extends A
class B extends A {
    public function methodB() {
        return "Method B from class B";
    }
}

// Class C extends B
class C extends B {
    public function methodC() {
        return "Method C from class C";
    }
}

// Create an object of class C
$c = new C();

// Using methods from classes A, B, and C
echo $c->methodA() . "<br>"; // Output: Method A from class A
echo $c->methodB() . "<br>"; // Output: Method B from class B
echo $c->methodC() . "<br>"; // Output: Method C from class C
?>
