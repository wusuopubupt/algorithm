<?php
define('PRECISION', 1E-6);

$number  = array(4,5,6,7);
$formula = $number;
$sentinels = array();
$sentinel = 1;

search(4);

function search($n) {
	global $number;
	global $formula;
	global $sentinels;
	global $sentinel;
		
	if(1 == $n) {
		if(abs($number[0] - 24) <= PRECISION) {
			
			$fml = escape_brackets($formula[0]);
			//$sentinel = weight($sentinel,$fml);
			
			if(check_exist($fml,$sentinels)){
				$sentinels[] = $fml;
				var_dump($fml);
				echo "<br>";
				//var_dump($sentinel);
				//$sentinel = 0;
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
				$sentinel *= 2 ;
				search($n-1);				
				$sentinel /= 2;
				
				$formula[$i] =  $formula_a.$formula_b.'-';
				$number[$i] = $a - $b;
				$sentinel *= 3;
				search($n-1);
				$sentinel /= 3;
				
				$formula[$i] = $formula_b.$formula_a.'-';
				$number[$i] = $b - $a;
				$sentinel *= 3;
				search($n-1);
				$sentinel /= 3;
				
				$formula[$i] = $formula_a.$formula_b.'*';					
				$number[$i] = $a * $b;
				$sentinel *= 5;
				search($n-1);
				$sentinel /= 5;
									
				if($b != 0){
					$formula[$i] = $formula_a.$formula_b.'/';
					$number[$i] = $a / $b;
					$sentinel *= 7;
					search($n-1);
					$sentinel /= 7;
				}
				
				if($a != 0){
					$formula[$i] = $formula_b.$formula_a.'/';
					$number[$i] = $b / $a;
					$sentinel *= 7;
					search($n-1);
					$sentinel /= 7;
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
	$ops = str_split($fml);
	for($i = 0; $i <= 7 ; $i++) {
		
	}
}

function check_exist($needle,$haystack){
	if(in_array($needle, $haystack)) {
		return false;
	}
	return true;
}

function weight($sentinel,$str) {
	//(a op b) op c) op d   or   (a op (b op c)) op d
	$pattern1 = '#\(.*\)[\+\-\*\/]\d#';
	if(preg_match($pattern1,$str,$matches)) {
		$sentinel *= 17;
		return $sentinel;
	}
		
	//a op ((b op c) op d)  or  a op (b op (c op d))
	$pattern3 = '#\d[\+\-\*\/]\(.*\)#';
	if(preg_match($pattern3, $str)) {
		$sentinel *= 23;
		return $sentinel;
	}
		
	//(a op b) op (c op d)  
	$pattern2 = '#\(*\)[\+\-\*\/]\(.*\)#';
	if(preg_match($pattern2,$str,$matches)) {
		$sentinel *= 19;
		return $sentinel;
	} 
	return $sentinel;
}
?>
