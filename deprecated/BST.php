<?php
/**
 * @author:wusuopubupt
 * @date  :2013-10-08
 * @language: php
 * Binary Search Tree  
 */
$nums = array(6,3,9,5,1,7,2,8,4);

$node = makeNode();
buildBinaryTree($node, $nums);
print_r($node);
delete($node, 3);
print_r($node);

function buildBinaryTree(&$node,$nums) {
	foreach($nums as $num) {
		insert($node,$num);
	}
}

function makeNode($root = NULL,$left = NULL,$right = NULL) {
	$node = array();
	
	$node['root'] = $root;
	$node['left'] = $left;
	$node['right'] = $right;
	
	return $node;
}

function insert(&$node,$obj) {
	if($node['root'] == NULL) {
		$node['root'] = $obj;
	}
	else {
		$diff = compare($node['root'],$obj);
		if($diff == 0) 
			die("error argument!");
		if($diff < 0) {
			insert($node['left'],$obj);
		}
		else {
			insert($node['right'],$obj);
		}
	}
}

function compare($node_val,$obj) {
	return $obj - $node_val;
}

/**
 * judge is a node is leaf
 */
function isLeaf($node) {
	return (!isset($node['root']) || !isset($node['left']) || !isset($node['right']));
}

/**
 * find $obj
 *
 * @param mixed $obj
 * @return boolean True
 */
function find($node,$obj) {
	if (!isset($node))
		return NULL;
	$diff = compare($node['root'],$obj);
	if ($diff == 0)
		return $node['root'];
	elseif ($diff < 0)
		return find($node['left'],$obj);
	else
		return find($node['right'],$obj);
}

/**
 * @return mixed minimum
 */
function findMin($node) {
	if (!isset($node))
		return NULL;
	elseif (!isset($node['left']))
		return $node['root'];
	else
		return findMin($node['left']);
}

/**
 * @return mixed maximum
 */
function findMax($node) {
	if (!isset($node)) 
		return NULL;
	elseif (!isset($node['right']))
		return $node['root'];
	else
		return findMax($node['right']);
}

/**
 *  preOrder traversal root->left->right
 */
function preOrderTraversal($node) {
	if (!isset($node['root'])) {
		return;
	}
	else {
		echo $node['root'].",";
		if(isset($node['left'])) {
			preorderTraversal($node['left']);
		}
		if(isset($node['right'])) {
			preorderTraversal($node['right']);
		}
	}
}

/**
 *  inOrder traversal left->root->right
 */
function inOrderTraversal($node) {
	if ($node['root'] == NULL) {
		return;
	}
	else {
		if(isset($node['left'])){
			inOrderTraversal($node['left']);
		}
		echo $node['root'].",";
		if(isset($node['right'])) {
			inOrderTraversal($node['right']);
		}
	}
}

/**
 * postOrder traversal left->right->root 
 */
function postOrderTraversal($node) {
	if ($node['root'] == NULL) {
		return;
	}
	else {
		if(isset($node['left'])) {
			postOrderTraversal($node['left']);
		}
		if(isset($node['right'])) {
			postOrderTraversal($node['right']);
		}
		echo $node['root'].",";
	}
}

/**
 * delete
 *
 * @param mixed $obj
 */
function delete(&$node,$obj) {
	if (!isset($node))
		die();
	$diff = compare($node['root'],$obj);
	echo $diff;
	if ($diff == 0) {
		if (isset($node['left'])) {
			$max = findMax($node['left']);
			$node['root'] = $max;
			delete($node['left'],$max);
		}
		elseif (isset($node['right'])) {
			$min = findMin($node['right']);
			$node['root'] = $min;
			delete($node['right'],$min);
		}
		else
			unset($node);
	} 
	else if ($diff < 0)
		delete($node['left'],$obj);
	else
		delete($node['right'],$obj);
}

