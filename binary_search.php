<?php
/**
 * Searching a 2D Sorted Matrix 
 * 
 * @author:wusuopubupt
 * @date: 2013-10-09
 * @url : http://leetcode.com/2010/10/searching-2d-sorted-matrix.html
 * @url : http://justjavac.iteye.com/blog/1310178
 * 
 */
$matrix = array 
(
	array(1,2,8,9),
	array(2,4,9,12),
	array(4,7,10,13),
	array(6,8,11,15),
	array(7,10,13,16)
);
$row = count($matrix) - 1;
$col = count($matrix[0]) - 1;

$re = binarySearch($matrix, 15, 0, 0, $row, $col);
var_dump($re);

function binarySearch($arr,$n,$m1,$n1,$m2,$n2) {
	$start_row = $m1;
	$start_col = $n1;
	$end_row = $m2;
	$end_col = $n2;
	
	$i = intval(($m1+$m2) / 2);
	$j = intval(($n1+$n2) / 2);
	
	if(!isset($arr)) {
		return false;
	}
	if($n < $arr[$m1][$n1] || $n > $arr[$m2][$n2]) {
		return false;
	}
	elseif($n == $arr[$m1][$n1] || $n == $arr[$m2][$n2]) {
		return true;
	}
	
	while(($i != $m1 || $j != $n1) && ($i != $m2 || $j != $n2)) {
		if($n == $arr[$i][$j]) {
			return true;
		}
		elseif($n < $arr[$i][$j]) {
			$m2 = $i;
			$n2 = $j;
			$i = intval(($i+$m1)/2);
			$j = intval(($j+$n1)/2);			
		}
		else{
			$m1 = $i;
			$n1 = $j;
			$i = intval(($i+$m2)/2);
			$j = intval(($j+$n2)/2);
		}
	}
	
	//search right
	if($i < $end_row) {
		$left_result = binarySearch($arr,$n,$i+1,$start_col,$end_row,$j);
	}
	//search left
	if($j < $end_col) {
		$right_result = binarySearch($arr,$n,$start_row,$j+1,$i,$end_col);
	}
	if($left_result || $right_result) {
		return true;
	}
	else {
		return false;
	}
}
