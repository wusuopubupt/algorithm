<?php
include('postfix2infix.php');

define('PRECISION', 1E-6);
$sentinels = array();
$commutations = array();
$number  = array(7,4,5,6);
$formula = $number;
search(4);

function search($n) {
	global $number;
	global $formula;
	global $sentinels;
	global $commutations;
		
	if(1 == $n) {
		if(abs($number[0] - 24) <= PRECISION) {
			$fml = convertRPN2Infix($formula[0]);
			
			if(check_exist($fml,$sentinels) && check_commutation($fml,$commutations)){
				$sentinels[] = $fml;
				echo $fml;
				echo "<br>";
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

function check_exist($fml,$haystack){
	if(in_array($fml, $haystack)) {
		return false;
	}
	return true;
}

function collect($fmls,$len) {
	for($i = 0; $i < $len; $i++) {
		if(! is_numeric($fmls[$i]) && $fmls[$i] != "(" && $fmls[$i] != ")") {
			$opts[] = $fmls[$i];
		}
		else {
			continue;
		}
	}
	return $opts;
}

function check_commutation($fml,&$commutations) {
	$op_level = 1;
	$fmls = str_split($fml);
	$len = count($fmls);
	$opts = collect($fmls,$len);
	if($len == 7 || $len == 9) { 
		$op_level = level($opts[0]) * level($opts[1]) * level($opts[2]);
		//echo "op_level:".$op_level."<br>";
		if(!in_array($op_level,$commutations)) {
			$commutations[] = $op_level;
			//print_r($commutations);
			return true;
		}
		else {
			return false;
		}
	}
	return true;
}


function level($op) {
	switch ($op) {
		case '+':
			return 2;
		case '-':
			return 3;
		case '*':
			return 5;
		case '/':
			return 7;
	}
}
?>
</body>
</html>
