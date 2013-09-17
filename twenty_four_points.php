<?php
$delta = 1E-6;
$tatol = 4;
$value = 24;
$flag  = false;
$count = 0;
$formula = array();
$number  = array(8,8,3,3);


function search($n) {
	global $delta;
	global $value;
	global $number;
	global $formula;
	global $flag;
	global $count;
	
	if(1 == $n) {
		if(abs($number[0] - $value) <= $delta) {
			echo $formula[0];
			echo "<br />";
			$flag = true;
			$count++;
		}
	}
	else {
		for($i=0; $i<$n; $i++){
			for($j=$i+1; $j<$n; $j++) {
				$a = $number[$i];
				$b = $number[$j];
				$formula_a = $formula[$i];
				$formula_b = $formula[$j];
				$formula[$j] = $formula[$n-1];
				
				$formula[$i] = '('.$a.'+'.$formula_b.')';
				$number[$i] = $a + $b;
				search($n-1);
				
				$formula[$i] = '('.$a.'+'.$b.')';
				$number[$i] = $a - $b;
				search($n-1);
				
				$formula[$i] = '('.$a.'-'.$b.')';					
				$number[$i] = $b - $a;
				search($n-1);
				
				$formula[$i] = '('.$b.'*'.$a.')';					
				$number[$i] = $a * $b;
				search($n-1);
									
				if($b != 0){
					$formula[$i] = '('.$a.'/'.$b.')';
					$number[$i] = $a / $b;
					search($n-1);
				}
				
				if($a != 0){
					$formula[$i] = '('.$b.'/'.$a.')';
					$number[$i] = $b / $a;
					search($n-1);
				}
				
				$number[$i] = $a;
				$number[$j] = $b;
				$formula[$i] = $formula_a;
				$formula[$j] = $formula_b;
			}
		}
	}
	//return $count;
}

search(4);
