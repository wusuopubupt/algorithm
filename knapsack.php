<?php
/*
 * find the optimum solution
 */

$weight = array(77,22,29,50,99); //weight ascend 
$value  = array(92,22,87,46,90); //value random
$solution = array(-1,-1,-1,-1,-1); //solution vector

/*
 * n: number of items
 * content: the maximum content of the knapsack 
 */
function knapsack($n,$content) {	
	
	global $weight;
	global $value;
	global $solution;
	
	if($n == 0 || $content == 0) {
		return 0; 
	}
	else {
		for($i = $n-1; $i >= 0; $i--) {
			if($weight[$i] > $content) {
				$solution[$i] = 0;
				return knapsack($n-1,$content);
			}
			else {
				if(($value[$i] + knapsack($n-1,$content-$weight[$i])) > knapsack($n-1,$content)) {
					$solution[$i] = 1;
					return $value[$i] + knapsack($n-1,$content-$weight[$i]);
				}
				else {
					$solution[$i] = 0;
					return knapsack($n-1,$content);
				}
			}
		}
	}
}

$maxvalue = knapsack(5,100);
for($i = 0; $i < 4; $i++) {
	if(1 == $solution[$i]) {
		printf("Item %d is selected.",$i+1);
		printf("{value : %d,weight : %d}",$value[$i],$weight[$i]);
		echo "<br />";
	}
}

printf("Maximum value is: %d",$maxvalue);
