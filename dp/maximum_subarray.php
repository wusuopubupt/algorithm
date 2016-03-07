<?php
/**
 * @author:wusuopubupt
 * @date:2013-10-16
 * @return mixed $max:the sum of miximum subarray
 * @from:CLRS 4.1 the miximum subarray problem
 * 
 * Find the miximum subarray
 * 
 * */
$arr = array(13,-3,-25,20,-3,-16,-23,18,20,-7,12,-5,-22,15,-4,7);
var_dump(max_sub_arr($arr));

function max_sub_arr($arr) {
	$len  = count($arr);
	
	$max_sum = 0;
	$max = 0;
	
	$start = 0;
	$end = 0;
	
	for($i = 0; $i < $len; $i++) {
		$max_sum = max($arr[$i]+$max_sum,0);
		if(0 == $max_sum) {
			$start = $i+1;  //start
		}
		$max = max($max,$max_sum);
		if($max_sum == $max) {
			$end = $i;  //end  
		}
		echo"i:$i arr[$i]:$arr[$i] max_sum:$max_sum max:$max";echo"<br>";
	}
	
	for($j = $start; $j <= $end; $j++) {
		var_dump($arr[$j]);
	}
	
	return $max;
}
?>
