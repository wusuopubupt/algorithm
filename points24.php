<?php
define('PRECISION', 1E-6);

$number  = array(6,6,6,6);
$formula = $number;

$sentinels = array();

search(4);

function search($n) {
	global $number;
	global $formula;
	global $sentinels;
		
	if(1 == $n) {
		if(abs($number[0] - 24) <= PRECISION) {
			
			$fml = escape_brackets($formula[0]);
			
			if(check_exist($fml,$sentinels)){
				$sentinels[] = $fml;
				
				print_formula($fml);
				var_dump($fml);	echo "<br>";
				
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return false;
		}
	}
	else {
		for($i = 0; $i < $n; $i++){
			for($j = $i+1; $j < $n; $j++) {
				
				$a = $number[$i];
				$b = $number[$j];
				
				$number[$j] = $number[$n-1];
				$formula_a = $formula[$i];
				$formula_b = $formula[$j];
				$formula[$j] = $formula[$n-1];
				
				$formula[$i] = $formula_a.$formula_b.'+';
				$number[$i] = $a + $b;
				search($n-1);				
				
				$formula[$i] =  $formula_a.$formula_b.'-';
				$number[$i] = $a - $b;
				search($n-1);
				
				$formula[$i] = $formula_b.$formula_a.'-';
				$number[$i] = $b - $a;
				search($n-1);
				
				$formula[$i] = $formula_a.$formula_b.'*';					
				$number[$i] = $a * $b;
				search($n-1);
									
				if($b != 0){
					$formula[$i] = $formula_a.$formula_b.'/';
					$number[$i] = $a / $b;
					search($n-1);
				}
				
				if($a != 0){
					$formula[$i] = $formula_b.$formula_a.'/';
					$number[$i] = $b / $a;
					search($n-1);
				}
				
				$number[$i] = $a;
				$number[$j] = $b;
				$formula[$i] = $formula_a;
				$formula[$j] = $formula_b;
			}
		}
		return false;
	}
}

function escape_brackets($str) {
	
	return $str;
}

function print_formula($fml) {
	$opts = array();
	$nums = array();
	$fmls = str_split($fml);
	$map = array();
	for($i = 0; $i < 7; $i++) {
		if( is_numeric($fmls[$i])) {
			$nums[] = $fmls[$i];
			$map[$i] = 0;//excellent!
		}
		else {
			$opts[] = $fmls[$i];
			$map[$i] = 1; //excellent!
		}
	}
	$a = $nums[0];
	$b = $nums[1];
	$c = $nums[2];
	$d = $nums[3];
	
	$op1 = $opts[0];
	$op2 = $opts[1];
	$op3 = $opts[2];
	
	// (A?B)?(C?D)
	$pattern = array(0,0,1,0,0,1,1);
	if($pattern === $map){
		if($op3 == '+') {
			$fml = $a.$op1.$b.$op3.$c.$op2.$d;
		}
		else {
			if($op2 == '*' || $op2 == '/') {
				if($op1 == '*' || $op1 == '/') {
					$fml = $a.$op1.$b.$op3.$c.$op2.$d;
				}
				else {
					$fml = "(".$a.$op1.$b.")".$op3.$c.$op2.$d;
				}
			}
			else {
				if($op1 == '*' || $op1 == '/') {
					$fml = $a.$op1.$b.$op3."(".$c.$op2.$d.")";
				}
				else {
					$fml = "(".$a.$op1.$b.")".$op3."(".$c.$op2.$d.")";
				}
			}
		}
	}
	//(A?B?C)?D
	else {
		$fml1 = search_map($map,$fmls);
		
	}
	echo $fml;
}

function search_map(&$map,&$fmls) {
	for($i = 0; $i <= 4 ; $i++) {
		if(($map[$i] == 0) && ($map[$i+1] == 0) && ($map[$i+2] == 1)) {
			$fml1 = $fmls[$i].$fmls[$i+2].$fmls[$i+1];
			$map[$i+2] = 0;
			
			return $fml1;
		}
		else 
			continue;
	}
}

function check_exist($needle,$haystack){
	if(in_array($needle, $haystack)) {
		return false;
	}
	return true;
}
?>
