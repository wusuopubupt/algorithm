<?php
/*
 * @author:wusuopubupt
 * @date:2013-09-12
 * 
 * eight queens puzzle recursive solution with php 
 */
$length = 8;
$queen = array ();
$sum = 0;

function print_queen() {
	global $length;
	global $queen;
	global $sum;
	++ $sum;
	printf("Solution %d:\t",$sum);
	for($i = 0; $i < $length; $i ++) {
		printf ( "%d\t",$queen [$i] );
	}
	printf ( "\r\n" );
}

function is_safe($n) {
	global $length;
	global $queen;
	
	for($i = 0; $i < $n; $i ++) {
		if ($queen [$i] == $queen [$n] || ($queen [$i] - $queen [$n]) == ($n - $i) 
			|| ($queen [$i] - $queen [$n] == ($i - $n))) {
			return false;
		}
	}
	return true;
}
function eight_queens($n) {
	global $length;
	global $queen;
	
	for($i = 0; $i < $length; $i ++) {
		$queen [$n] = $i;
		if (is_safe ( $n )) {
			if ($n == $length - 1) {
				print_queen ();
			} 
			else {
				eight_queens ( $n + 1 );
			}
		}
	}
}

/*
 * benchmark 
 */
$starttime = microtime ( true );
eight_queens( 0 );
$endtime = microtime ( true );
printf ( "time spend: %.4f\n", $endtime - $starttime );
printf ("total solutions: %d",$sum);
