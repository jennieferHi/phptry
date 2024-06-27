<!-- 

ChatGPT
PHP 的多載（overloading）指的是在同一個類別中可以定義多個同名的方法，但這些方法的參數數量或類型不同。這樣做可以根據不同的參數來執行不同的邏輯，從而增加代碼的靈活性和重用性。

在 PHP 中，主要有兩種類型的多載：

1. 方法重載（Method Overloading）
方法重載指的是在同一個類別中定義多個同名的方法，但它們的參數數量或類型不同。在 PHP 中，由於沒有像其他語言（如 Java）那樣直接支持方法重載，因此我們通常使用函數的默認參數值來達到類似的 
-->
<?php 
class Example {
    public function test($a, $b = null) {
        if ($b === null) {
            // Logic when only $a is provided
        } else {
            // Logic when both $a and $b are provided
        }
    }
}


// 定義一個車子類別
class Car {
    private $data = [];

    // 屬性設置的魔術方法
    // 當你嘗試設置一個未聲明的屬性時，這個方法會被自動調用。
    public function __set($name, $value) {
        // 將屬性名稱轉換為小寫，以統一處理
        $name = strtolower($name);
        // 將值設置到內部的 $data 陣列中
        $this->data[$name] = $value;
    }

    // 屬性訪問的魔術方法
    // 當你嘗試訪問一個未聲明的屬性時，這個方法會被自動調用。
    public function __get($name) {
        // 將屬性名稱轉換為小寫，以統一處理
        $name = strtolower($name);
        // 如果屬性存在於 $data 陣列中，返回對應的值；否則返回 null
        return $this->data[$name] ?? null;
    }
}

// 創建一個車子對象
$myCar = new Car();

// 使用屬性重載來動態設置車子的屬性
$myCar->Brand = "Toyota";
$myCar->Model = "Camry";
$myCar->Year = 2022;

// 使用屬性重載來動態訪問車子的屬性並輸出
echo "My car is a {$myCar->Brand} {$myCar->Model} made in {$myCar->Year}.";
