<?php
// filter
$data=[1,3,12,3,122,442,12,41,522];
$new=[];
//    foreach($data as $val){
//    if($val>100){
//    array_push($new,$val);
//    }
//    }
$filteredNumbers = array_filter($data, function($num) {
    return $num >= 230;
}); 
print_r($filteredNumbers);  

echo "<br/>";

    // map 
    $squaredNumbers = array_map(function($num) {
        return $num * $num;
    }, $data);

    print_r($squaredNumbers);
     
    // foreach (js-forEach)
    echo "<br/>";
// 使用 foreach 循环遍历数组并输出每个元素
foreach ($data as $num) {
    echo $num . "\n";
}
echo "<br/>";
// PHP 中的对应实现：

// 使用 array_filter() 函数来过滤数组，保留满足条件的元素。
// 使用 current() 函数获取数组中的当前元素，即第一个满足条件的元素。
$foundNumber = current(array_filter($data, function($num) {
    return $num > 25;
}));

echo $foundNumber; // 输出: 30 
echo "<br/>";

// 使用 array_reduce()+var_dump() 检查是否所有元素都大于 25
$allGreaterThan25 = array_reduce($data, function($carry, $num) {
      // $carry 是上一次回调函数的返回值，或者初始值 true
    // $num 是当前数组元素的值
    return $carry && ($num > 25);
}, true);

var_dump($allGreaterThan25); // 输出: bool(false)


// 使用 array_reduce() 求和
$sum = array_reduce($data, function($accumulator, $currentValue) {
    return $accumulator + $currentValue;
}, 0);
echo $sum . "\n"; // 输出: 15
echo "<br/>";

// js some 
$filteredNumbers = array_filter($data, function($num) {
    return $num > 25;
});

$hasNumberGreaterThan25 = !empty($filteredNumbers);

var_dump($hasNumberGreaterThan25); // 输出: bool(true)

    ?>
    