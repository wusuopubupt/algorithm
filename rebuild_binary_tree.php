<?php
/**
 * defination of binary tree
 */
class BinaryTree {
    protected $node = NULL;     //  root
    protected $left = NULL;     //  left
    protected $right = NULL;    //  right
 
    /**
     * rebuild binary tree 
     *
     * @param mixed $node 
     * @param mixed $left 
     * @param mixed $right 
     */
    public function __construct( $node = NULL, $left = NULL, $right = NULL) {
        $this->node = $node;
        if ($node === NULL) {
            $this->left = NULL;
            $this->right = NULL;
        }
        elseif ($left === NULL) {
            $this->left = new BinaryTree();
            $this->right = new BinaryTree();
        }
        else {
            $this->left = $left;
            $this->right = $right;
        }
    }
 
    /**
     * destruct
     */
    public function __destruct() {
        $this->node = NULL;
        $this->left = NULL;
        $this->right = NULL;
    }
 
    /**
    * clear binary tree
    **/
    public function purge () {
        $this->node = NULL;
        $this->left = NULL;
        $this->right = NULL;
    }
 
    /**
     * judge if current is leaf
     * if node!=NULL && left==NULL && right==NULL, return ture
     * @return boolean 
     */
    public function isLeaf() {
        return !( $this->isEmpty() && $this->left->isEmpty() && $this->right->isEmpty() );
    }
 
    /**
     * judge if current is NULL
     *
     * @return boolean 
     */
    public function isEmpty() {
        return $this->node === NULL;
    }
 
    /**
     * node getter.
     *
     * @return mixed node value.
     */
    public function getNode() {
        if ($this->isEmpty()) {
            return false;
        }
        return $this->node;
    }
 
 
    /**
     * assign value to empty node
     *
     * @param mixed $object node value.
     */
    public function attachNode($obj) {
        if (!$this->isEmpty())
            return false;
        $this->node  = $obj;
        $this->left  = new BinaryTree();
        $this->right = new BinaryTree();
    }
 
    /**
     * set node to NULL.
     */
    public function detachNode() {
        if (!$this->isLeaf())
            return false;
        $result = $this->node;
        $this->node = NULL;
        $this->left = NULL;
        $this->right = NULL;
        return $result;
    }
 
    /**
     * return left
     *
     * @return object BinaryTree left.
     */
    public function getLeft() {
        if ($this->isEmpty())
            return false;
        return $this->left;
    }
 
    /**
     * attach left
     *
     * @param object BinaryTree $t 
     */
    public function attachLeft(BinaryTree $t) {
        if ($this->isEmpty() || !$this->left->isEmpty())
            return false;
        $this->left = $t;
    }
 
    /**
     * detach left
     *
     * @return object BinaryTree left.
     */
    public function detachLeft() {
        if ($this->isEmpty())
            return false;
        $result = $this->left;
        $this->left = new BinaryTree();
        return $result;
    }
 
    /**
     * return right
     *
     * @return object BinaryTree right.
     */
    public function getRight() {
        if ($this->isEmpty())
            return false;
        return $this->right;
    }
 
    /**
     * attach right
     *
     * @param object BinaryTree $t right.
     */
    public function attachRight(BinaryTree $t) {
        if ($this->isEmpty() || !$this->right->isEmpty())
            return false;
        $this->right = $t;
    }
 
    /**
     * detach right
     * @return object BinaryTree right.
     */
    public function detachRight() {
        if ($this->isEmpty ())
            return false;
        $result = $this->right;
        $this->right = new BinaryTree();
        return $result;
    }
 
    /**
     * preorder traversal
     */
    public function preorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        echo ' ', $this->getNode();
        $this->getLeft()->preorderTraversal();
        $this->getRight()->preorderTraversal();
    }
 
    /**
     * inorder taversal
     */
    public function inorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        $this->getLeft()->preorderTraversal();
        echo ' ', $this->getNode();
        $this->getRight()->preorderTraversal();
    }
 
    /**
     * postorder traversal
     */
    public function postorderTraversal() {
        if ($this->isEmpty()) {
            return ;
        }
        $this->getLeft()->preorderTraversal();
        $this->getRight()->preorderTraversal();
        echo ' ', $this->getNode();
    }
}
 
/**
 * binary search tree
 */
 
class BST extends BinaryTree {
  	/*
     * construct
     */
    public function __construct() {
        parent::__construct(NULL, NULL, NULL);
    }
 
    /**
     * destruct
     */
    public function __destruct() {
        parent::__destruct();
    }
 
    /**
     * judge if contains $obj
     * 
     * @param mixed $obj the searched value.
     * @return boolean True 
     */
    public function contains($obj) {
        if ($this->isEmpty())
            return false;
        $diff = $this->compare($obj);
        if ($diff == 0) {
            return true;
        }elseif ($diff < 0)
            return $this->getLeft()->contains($obj);
        else
            return $this->getRight()->contains($obj);
    }
 
    /**
     * find $obj
     * 
     * @param mixed $obj 
     * @return boolean True 
     */
    public function find($obj) {
        if ($this->isEmpty())
            return NULL;
        $diff = $this->compare($obj);
        if ($diff == 0)
            return $this->getNode();
        elseif ($diff < 0)
            return $this->getLeft()->find($obj);
        else
            return $this->getRight()->find($obj);
    }
 
    /**
     * @return mixed minimum
     */
    public function findMin() {
        if ($this->isEmpty ())
            return NULL;
        elseif ($this->getLeft()->isEmpty())
            return $this->getNode();
        else
            return $this->getLeft()->findMin();
    }
 
    /**
     * @return mixed maximum
     */
    public function findMax() {
        if ($this->isEmpty ())
            return NULL;
        elseif ($this->getRight()->isEmpty())
            return $this->getNode();
        else
            return $this->getRight()->findMax();
    }
 
    /**
     * insert
     * right > node > left
     * @param mixed $obj .
     * if $obj already exists, return error
     */
    public function insert($obj) {
        if ($this->isEmpty()) {
            $this->attachNode($obj);
        } 
        else {
            $diff = $this->compare($obj);
            if ($diff == 0)
                die('argument error');
            if ($diff < 0)
                $this->getLeft()->insert($obj);
            else
                $this->getRight()->insert($obj);
        }
        $this->balance();
    }
 
 
 /**
     * delete
     *
     * @param mixed $obj 
     */
    public function delete($obj) {
        if ($this->isEmpty ())
            die();
 
        $diff = $this->compare($obj);
        if ($diff == 0) {
            if (!$this->getLeft()->isEmpty()) {
                $max = $this->getLeft()->findMax();
                $this->node = $max;
                $this->getLeft()->delete($max);
            }
            elseif (!$this->getRight()->isEmpty()) {
                $min = $this->getRight()->findMin();
                $this->node = $min;
                $this->getRight()->delete($min);
            } else
                $this->detachNode();
        } else if ($diff < 0)
                $this->getLeft()->delete($obj);
            else
                $this->getRight()->delete($obj);
        $this->balance();
    }
 
    public function compare($obj) {
        return $obj - $this->getNode();
    }
 
    /**
     * Attaches the specified object as the node of this node.
     * The node must be initially empty.
     *
     * @param object IObject $obj The node to attach.
     * @exception IllegalOperationException If this node is not empty.
     */
    public function attachNode($obj) {
        if (!$this->isEmpty())
            return false;
        $this->node = $obj;
        $this->left = new BST();
        $this->right = new BST();
    }
 
    /**
     * Balances this node.
     * Does nothing in this class.
     */
    protected function balance () {}
 
 
    /**
     * Main program.
     *
     * @param array $args Command-line arguments.
     * @return integer Zero on success; non-zero on failure.
     */
    public static function main($args) {
        printf("BinarySearchTree main program.\n");
        $root = new BST();
        foreach ($args as $row) {
            $root->insert($row);
        }
        return $root;
    }
}

$b_tree = array(50, 3, 10, 5, 100,56, 78);
$root = BST::main($b_tree);
echo $root->findMax();
$root->delete(100);
printf("after delete:\n");
echo $root->findMax();