<?php
/*
 * @url: http://poj.org/showmessage?message_id=118838
 * DP(i,j) = max( DP(i,j-1), DP(i,j+1), DP(i-1,j), DP(i+1,j) ) + 1;
 */

$row = 4;
$col = 5;

$route = array
(
	array(1,2,3,4,5),
	array(14,15,16,17,6),
	array(13,20,19,18,7),
	array(12,11,10,9,8)
);

function skiing($i,$j) {
	$max = 0;
	$max_len_route = array();
	
	global $row,$col;
	global $route;

	if(isset($max_len_route[$i][$j]) && $max_len_route[$i][$j] > 0) {
		return $max_len_route[$i][$j];
	}
	//up
	if($i > 0 && $route[$i][$j] > $route[$i-1][$j] && $max < skiing($i-1,$j)) {
		$max = skiing($i-1,$j);
	}
	//down
	if($i < ($row-1) && $route[$i][$j] > $route[$i+1][$j] && $max < skiing($i+1,$j)) {
		$max = skiing($i+1,$j);
	}
	//left
	if($j > 0 && $route[$i][$j] > $route[$i][$j-1] && $max < skiing($i,$j-1)) {
		$max = skiing($i,$j-1);
	}
	//right
	if($j < ($col-1) && $route[$i][$j] > $route[$i][$j+1] && $max < skiing($i,$j+1)) {
		$max = skiing($i,$j+1);
	}
	
	$max_len_route[$i][$j] = $max + 1;
	return $max_len_route[$i][$j];
}

$maxlen = 0;

for($i = 0; $i < $row; $i++){
	for($j = 0; $j < $col; $j++) {
		$temp = skiing($i,$j);
		var_dump($temp);
		if($temp > $maxlen) {
			$maxlen = $temp;
		}
	}
}

printf("The max length route is: %d",$maxlen);
?>

