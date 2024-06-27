<?php
class Car {
    private $model;
    public $color;

    public function __construct($model, $color) {
        $this->model = $model;
        $this->color = $color;
    }

    // Getter 方法获取私有属性 $model 的值
    public function getModel() {
        return $this->model;
    }

    // Setter 方法设置私有属性 $model 的值
    public function setModel($model) {
        // 在这里可以添加验证逻辑
        if (is_string($model) && strlen($model) > 0) {
            $this->model = $model;
        } else {
            throw new Exception('Invalid model name');
        }
    }
}

// 创建一个 Car 对象
$myCar = new Car("Toyota", "Red");

// 输出属性值
echo "Car Model: " . $myCar->getModel() . "\n";
echo "Car Color: " . $myCar->color . "\n";

// 尝试使用 setter 方法设置新的 model 值
try {
    $myCar->setModel("Honda");
    echo "New Car Model: " . $myCar->getModel() . "\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
