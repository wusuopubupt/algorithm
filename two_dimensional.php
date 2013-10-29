<?php
/**
 *  Given an n x n matrix A(i,j) of integers,
 *	find maximum value A(c,d) - A(a,b) 
 *	over all choices of indexes such that both c > a and d > b. 
 *	Required complexity: O(n^2)
 */

//$num = array(3,8,5,9,7,1,2,4,6);
$num = array (
	array (8,5,1),
	array (2,4,7),
	array (3,9,6) 
);
$n = count($num);

$result = $num[1][1] - $num[0][0];
$min_value = $num[0][0];

//Complexity O(n^2)
for($i = 0; $i < $n-1; $i++) {
	for($j = 0; $j < $n-1; $j++) {
		$min_value = min($min_value, $num[$i][$j]);
		$result = max($result, $num[$i+1][$j+1] - $min_value);
		printf("i:$i j:$j min_value: $min_value result:$result");
	}
}
var_dump($result);
?>
