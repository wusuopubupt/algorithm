<?php
/**
 * @author:wusuopubupt
 * @date:2013-10-16
 * @from:http://ac.jobdu.com/problem.php?pid=1391
 * 
 * Print matrix in clockwise
 * */
$matrix = array
(
	array(1,2,3,4),
	array(5,6,7,8),
	array(9,10,11,12),
	array(13,14,15,16),
	array(17,18,19,20)
);

print_matrix($matrix);

function print_matrix($arr) {
	$top = 0;
	$left = 0;
	$right = count($arr[0])-1;
	$bottom  = count($arr)-1;
	
	while ($left != $right && $top != $bottom) {
		//top
		for($j = $left; $j <= $right; $j++) {
			echo $arr[$top][$j]." ";
		}
		$top++;
		
		//right
		for($i = $top; $i <= $bottom; $i++) {
			echo $arr[$i][$right]." ";
		}
		$right--;
		
		//bottom
		for($j = $right; $j >= $left; $j--) {
			echo $arr[$bottom][$j]." ";
		}
		$bottom--;
		
		//left
		for($i = $bottom; $i >= $top; $i--) {
			echo $arr[$i][$left]." ";
		}
		$left++;
	}
}