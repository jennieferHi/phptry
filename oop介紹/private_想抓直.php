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
        $this->model = $model;
    }
}
?>

