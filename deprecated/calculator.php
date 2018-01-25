<?php 
$input = "2+3-1*4";

$strStark  = new myStark();
$numStark  = new myStark();
for($i =0;$i<strlen($input);$i++){
    if(!isOper($input[$i])){ // not operator 
        if($i>0 &&  $isNum){
            $numStark->push($numStark->pop().$input[$i]);
        }else{
            $numStark->push($input[$i]);
        }
        $isNum = true; 
    }
    else{
        $isNum = false;
        while($strStark->isEmpty() && oper($strStark->getTop()) >= oper($input[$i])){
            $num1 = $numStark->pop();
            $num2 = $numStark->pop();
            $oper = $strStark->pop();
            $res = pay($num1,$oper,$num2);
            $numStark->push($res);
        }
        $strStark->push($input[$i]);
    }
}
while($strStark->isEmpty()){
    $num1 = $numStark->pop();
    $num2 = $numStark->pop();
    $oper = $strStark->pop();
    $res = pay($num1,$oper,$num2);
    $numStark->push($res);
}
echo $numStark->stack[$numStark->top];

class myStark{
	public $top = -1;
	public $maxStark = 5;
	public $stack = array();
	
	public function isEmpty(){
		if($this->top == -1){
			return false;
		}else{
			return true;
		}
	}
	
	public function getTop(){
		return $this->stack[$this->top];
	}
	
	public function push($val){
		if($this->top > $this->maxStark - 1){
			return false;
		}
		$this->top ++;
		$this->stack[$this->top] = $val;
	}

	public function pop(){
		if($this->top <= -1){
			return false;
		}
		$return = $this->stack[$this->top];
		$this->top -- ;
		return $return;
	}
	
	public function show(){
		for($i = $this->top;$i>-1;$i--){
			echo 'stack['.$i.']='.$this->stack[$i].'<br />';
		}
	}
}
function isOper($str){
    if(in_array($str,array('+','-','*','/','(',')','[',']','{','}'))){
        return true;
    }else{
        return false;
    }
}
function oper($str){
    switch($str){
        case '+':case '-':
            $oper = 1;
            break;
        case '*':case '/':
            $oper =  2;
            break;
    }
    return $oper;
}
function pay($x,$str,$y){
    switch($str){
        case '+':$return = $x+$y;break;
        case '-':$return = $y-$x;break;
        case '*':$return = $x*$y;break;
        case '/':$return = $y/$x;break;
    }
    return $return;
}
?>