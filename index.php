<?php
// BST - Binnary Search Tree 
// ========================== 
class Node {               // Node of a tree
    public $value;         // data of the tree
    public $left;          // left child tree
    public $right;         // right clind tree 
     
    public function __construct($val)  // constructor
    {
        $this->value  = $val;
        $this->left   = null;
        $this->right  = null;
    }
}
class BST {
    private $root;
    public function __construct($n = null) {
        $this->root = ($n == null ? null : new Node($n));
    }
    public function insert($n, $parent=null){
        if($parent == null){
            if($this->root == null){
                $this->root = new Node($n);
                return;
            }
        $parent = $this->root;
        }
        if($n < $parent->value){
            if($parent->left != null)
                $this->insert($n, $parent->left);
            else
                $parent->left = new Node($n);
        }
        else{
            if($parent->right !=null)
                $this->insert($n, $parent->right);
            else
                $parent->right = new Node($n);
        }
    }//end method insert
    public function getRoot(){
        return $this->root;
    }
    /*
    PreOrder Algorithm
    ==================
        1. display the data part of the root element (or current element)
        2. traverse the left subtree by recursivelly calling the pre-order function
        3. traverse the right subtree by recursivelly calling the pre-order function
    */
    public function preOrder($node){
        if($node==null)
            return;
        
        printf("%d ",$node->value); // visit the node and display the info
        $this->preOrder($node->left); 
        $this->preOrder($node->right);
    } 
    /* 
    InOrder Algorithm
    ==================
        1. traverse the left subtree by recursivelly calling the in-order function
        2. display the data part of the root element (or current element)        
        3. traverse the right subtree by recursivelly calling the in-order function
    */    
    public function inOrder($node){
        if($node == null)
            return;
        $this->inOrder($node->left);
        printf("%d ",$node->value);
        $this->inOrder($node->right);
    }
    /*
    PostOrder Algorithm
    ====================
        1. Traverse the left subtree by recursively calling the post-order function.
        2. Traverse the right subtree by recursively calling the post-order function.
        3. Display the data part of root element (or current element).
    */
    public function postOrder($node){
        if($node == null)
            return;
        $this->postOrder($node->left);        
        $this->postOrder($node->right);
        printf("%d ",$node->value);
    }
    /*
    Print the n-th elements from BST with Depth Search - InOrder traversal of tree
    ==============================================================================    
    */
    public function printWithDSF($node, $max, &$actual=0){
        if($node == null) return;
        $this->printWithDSF($node->left, $max, $actual);
        if($actual++ < $max){
            printf("%d ", $node->value);
            $this->printWithDSF($node->right, $max, $actual);
        }
    }
    /*
    Print keys in the given range from BTS - ( k1 <= x <= k2 )
    ===========================================================
        1. if value of the root's key is greather than k1 then recursivelly call the left subtree
        2. if value of root's key is in range then print the root's key
        3. if value of root's key is smaller than k2 then recursivelly call the right subtree
    */
    public function printInRange($node, $k1, $k2){
        if($node == null) return;
        if($k1 < $node->value)
            $this->printInRange($node->left, $k1, $k2);
        // if root's data lies in range, then prints root's data 
        if ( $k1 <= $node->value && $k2 >= $node->value )
            printf("%d ", $node->value );
        if ( $k2 > $node->value )
            $this->printInRange($node->right, $k1, $k2);
    }
    /*
    Lowest Common Ancestor(LCA) of a Binary Search Tree
    =====================================================  
    given values of two nodes in a Binary Search Tree find the Lowest Common Ancestor(LCA)
    definition of LCA :
        Let T be a rooted tree. The lowest common ancestor between two nodes n1 and n2 
        is defined as the lowest node in T that has both n1 and n2 as descendants 
        (where we allow a node to be a descendant of itself).              
    */
    public function recursiveLCA($node, $n1, $n2){
        if($node == null) return;
        
        // if root's data lies in range, then prints root's data 
        if ( $n1 <= $node->value && $n2 >= $node->value )
            printf("%d ", $node->value );
        // if both n1 and n2 are smaller than root, then LCA lies in left        
        if ( $node->value > $n1 && $node->value > $n2 )
            $this->recursiveLCA($node->left, $n1, $n2);
        // if both n1 and n2 are greater than root, then LCA lies in right
        if ( $node->value < $n1 && $node->value < $n2 )
            $this->recursiveLCA($node->right, $n1, $n2);
    }
    public function iterativeLCA($node, $n1, $n2){
        if($node == null) return null;
        while ($node != null) {
            
            // if both n1 and n2 are smaller than root, then LCA lies in left 
            if ( $node->value > $n1 && $node->value > $n2 )
                $node = $node->left;
            // if both n1 and n2 are greater than root, then LCA lies in right
            if ( $node->value < $n1 && $node->value < $n2 )
                $node = $node->right;
            else break;
        }
        printf("%d ", $node->value);
    }
}// end class BT 
 
function CreateTree() {
	$bst = new BST(); 
    $bst->insert(70);
    $bst->insert(49);
    $bst->insert(84);
    $bst->insert(37);
    $bst->insert(54);
    $bst->insert(78);
    $bst->insert(85);
    $bst->insert(22);
    $bst->insert(40);
    $bst->insert(51);
    $bst->insert(76);
    $bst->insert(80);
  
    //print_r($bst);
    echo "PreOrder Traversal : \n";
    $bst->preOrder($bst->getRoot()); // display Tree in PreOrder
    echo "\n";
}
if($_POST['CreateTree']==1){
	CreateTree();
}
?>