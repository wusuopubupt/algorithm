<?php 
//node type is number
function makeNumberNode($number) {
	$node = array();
	
	$node['kind'] = "number";
	$node['value']= $number;
	
	return $node;
};

//node type is operator
function makeOpNode($op, $left, $right) {
    $precedence = 1;
    if (($op === "*") || ($op === "/")) {
        $precedence = 2;
    }
    
    $node = array();
    
    $node['kind'] = "operator";
    $node['operator'] = $op;
    $node['precedence'] = $precedence;
    $node['left'] = $left;
    $node['right'] = $right;
	
    return $node;
}

//convert RPN(Reverve Polish Notation) to binary tree
function convertRPN2Tree($rpnExpr) {
    $stack = array();
    $rpnExpr = str_split($rpnExpr);    
    for ($i = 0; $i < count($rpnExpr); $i++) {
        $ch = $rpnExpr[$i];
        if (($ch >= "0") && ($ch <= "9")) {
            //$stack.push(makeNumberNode($ch));
        	array_push($stack, makeNumberNode($ch));
        }
        else {
            //$rhs = $stack.pop();
            //$lhs = $stack.pop();
            //$stack.push(makeOpNode($ch, $lhs, $rhs));
            $rhs = array_pop($stack);
            $lhs = array_pop($stack);
            array_push($stack,makeOpNode($ch, $lhs, $rhs));
        }
    }        

    //return $stack.pop();
    return array_pop($stack);
};
    
function needParensOnLeft($node) {
    return (($node['left']['kind'] === "operator") &&
            ($node['left']['precedence'] < $node['precedence']));
};
    
function needParensOnRight($node) {
    if ($node['right']['kind'] === "number") {
        return false;
    }
    if (($node['operator'] === "+") || ($node['operator'] === "*")) {
        return ($node['right']['precedence'] < $node['precedence']);
    }
    return ($node['right']['precedence'] <= $node['precedence']);
};
    
function visit($node) {
    if ($node['kind'] === "number") {
        return $node['value'];
    }
        
    $lhs = visit($node['left']);
    if (needParensOnLeft($node)) {
        $lhs = '(' . $lhs . ')';
    }
       
    $rhs = visit($node['right']);
    if (needParensOnRight($node)) {
        $rhs = '(' . $rhs . ')';
    }
        
    return $lhs . $node['operator'] . $rhs;
};
  
function convertRPN2Infix($rpnExpr) {
    $tree = convertRPN2Tree($rpnExpr);
    //var_dump($tree);
    $infixExpr = visit($tree);
    return $infixExpr;
};
    
//convertRPN2Infix("456-7+*");
?>