<?php
/*
 * from : czxttkl
 * url  : https://mail.google.com/mail/u/0/#inbox/14128abd0fcee658
 * Dynamic Programming
 * 
 */
function T($n) {
	if(1 == $n)
		return $n;
	else {
		$max = 0;
		for($k = 1; $k < $n; $k++) {
			$max += T($k)*T($n-$k);
		}
		return $max;
	}
}

$re = T(4);
echo $re;