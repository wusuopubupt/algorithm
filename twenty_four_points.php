<?php
/*
 * 1.位置固定
 * 2.没有去重
 */
calculate24(6,7,7,10);

function calculate24($a,$b,$c,$d){
	define("DELTA", 0.00000001);
	
	print_formula1($a, $b, $c, $d);
	print_formula2($a, $b, $c, $d);
	print_formula3($a, $b, $c, $d);
	print_formula4($a, $b, $c, $d);
	print_formula5($a, $b, $c, $d);
	
}

// formula1: (a op b) op c) op d 
function print_formula1($a,$b,$c,$d) {
	//echo DELTA;exit;
	for($opt1 = 1; $opt1 <= 4; $opt1++) {
		$result_ab = 0;
		$result_ab = operate($a, $b, $opt1);
		for($opt2 = 1; $opt2 <= 4; $opt2++) {
			$result_abc = 0;
			$result_abc = operate($result_ab,$c,$opt2);
			for($opt3 = 1; $opt3 <= 4; $opt3++){
				$result_abcd = 0;
				$result_abcd = operate($result_abc, $d, $opt3);
				if( abs($result_abcd - 24) < DELTA) {
					printf("((%d %s %d) %s %d) %s %d = 24\n",$a,symbolize($opt1),$b,symbolize($opt2),$c,symbolize($opt3),$d);
					echo "<br />";
				}
			}
		}
	}
}

// formula2: (a op b) op (c op d)
function print_formula2($a,$b,$c,$d) {
	for($opt1 = 1; $opt1 <= 4; $opt1++) {
		$result_ab = 0;
		$result_ab = operate($a, $b, $opt1);
		for($opt3 = 1; $opt3 <= 4; $opt3++) {
			$result_cd = 0;
			$result_cd = operate($c,$d,$opt3);
			for($opt2 = 1; $opt2 <= 4; $opt2++){
				$result_abcd = 0;
				$result_abcd = operate($result_ab, $result_cd, $opt2);
				if( abs($result_abcd - 24) < DELTA) {
					printf("(%d %s %d) %s (%d %s %d) = 24\n",$a,symbolize($opt1),$b,symbolize($opt2),$c,symbolize($opt3),$d);
					echo "<br />";
				}
			}
		}
	}
}

// formula3: (a op (b op c)) op d  
function print_formula3($a,$b,$c,$d) {
	for($opt2 = 1; $opt2 <= 4; $opt2++) {
		$result_bc = 0;
		$result_bc = operate($b, $c, $opt2);
		for($opt1 = 1; $opt1 <= 4; $opt1++) {
			$result_abc = 0;
			$result_abc = operate($a,$result_bc,$opt1);
			for($opt3 = 1; $opt3 <= 4; $opt3++){
				$result_abcd = 0;
				$result_abcd = operate($result_abc, $d, $opt3);
				if( abs($result_abcd - 24) < DELTA) {
					printf("(%d %s (%d %s %d)) %s %d = 24\n",$a,symbolize($opt1),$b,symbolize($opt2),$c,symbolize($opt3),$d);
					echo "<br />";
				}
			}
		}
	}
}

// formula4: a op ((b op c) op d) 
function print_formula4($a,$b,$c,$d) {
	for($opt2 = 1; $opt2 <= 4; $opt2++) {
		$result_bc = 0;
		$result_bc = operate($b, $c, $opt2);
		for($opt3 = 1; $opt3 <= 4; $opt3++) {
			$result_bcd= 0;
			$result_bcd = operate($result_bc,$d,$opt3);
			for($opt1 = 1; $opt1 <= 4; $opt1++){
				$result_abcd = 0;
				$result_abcd = operate($a, $result_bcd, $opt1);
				if( abs($result_abcd - 24) < DELTA) {
					printf("%d %s ((%d %s %d) %s %d) = 24\n",$a,symbolize($opt1),$b,symbolize($opt2),$c,symbolize($opt3),$d);
					echo "<br />";
				}
			}
		}
	}
}


// formula5: a op (b op (c op d)) 
function print_formula5($a,$b,$c,$d) {
	for($opt3 = 1; $opt3 <= 4; $opt3++) {
		$result_cd = 0;
		$result_cd = operate($c, $d, $opt3);
		for($opt2 = 1; $opt2 <= 4; $opt2++) {
			$result_bcd = 0;
			$result_bcd = operate($b,$result_cd,$opt2);
			for($opt1 = 1; $opt1 <= 4; $opt1++){
				$result_abcd = 0;
				$result_abcd = operate($a, $result_bcd, $opt1);
				if( abs($result_abcd - 24) < DELTA) {
					printf("%d %s (%d %s (%d %s %d)) = 24\n",$a,symbolize($opt1),$b,symbolize($opt2),$c,symbolize($opt3),$d);
					echo "<br />";
				}
			}
		}
	}
}

function operate($a,$b,$opt) {
	switch($opt) {
		case 1:
			return $a + $b;
		case 2:
			return $a - $b;
		case 3:
			return $a * $b;
		case 4:
			if(0 == $b){
				break;
			}
			return $a / $b;
	}
}

function symbolize($opt) {
	switch($opt) {
		case 1 :
			return "+";
		case 2 :
			return "-";
		case 3 :
			return "*";
		case 4 :
			return "/";
	}
}















