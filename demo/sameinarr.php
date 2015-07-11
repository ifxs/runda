<?php 
// function asdfdf($array) { 
//     // 获取去掉重复数据的数组 
//     $unique_arr = array_unique ( $array ); 
//     // 获取重复数据的数组 
//     $repeat_arr = array_diff_assoc ( $array, $unique_arr ); 
//     return $repeat_arr; 
// } 

// 测试用例 
$array = array ( 
        'apple', 
        'iphone', 
        'miui', 
        'apple', 
        'orange', 
        'orange'  
); 
// $repeat_arr = asdfdf( $array ); 
$arr = array_unique ( $array ); 
print_r ($arr); 
?> 