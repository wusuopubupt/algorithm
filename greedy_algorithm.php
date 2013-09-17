<?php
$start = array(10,9,8);
$end = array(12,10,15);

greedy_search($start,$end);

function greedy_search($start,$end) {
	$first = array();
	
	for($i = 0; $i < count($end); $i++) {
		$temp = get_first($start,$end,$first);
		$first[] = $temp;
	}
	var_dump($first);	
}

function get_first($start_time,$end_time,$ignore) {
	$flag = 24;
	$first_key = NULL;
	$len = count($ignore);
	if($len > 0)
		$last = $ignore[$len - 1];
	
	for($key = 0; $key < count($end_time); $key++) {
		if(0 == $len) {
			if($end_time[$key] < $flag) {
				$flag = $end_time[$key];
				$first_key = $key;
			}
		}
		else if(! in_array($key,$ignore)) {
			if($end_time[$key] <= $flag && $start_time[$key] >= $end_time[$last]) {
				$flag = $end_time[$key];
				$first_key = $key;
			}
		}
	}
	return $first_key;
}
