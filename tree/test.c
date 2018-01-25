
int get_tree_max_node_distance(ListNode* root) {
    if (root == NULL) {
        return 0;
    }
    return get_max_tree_depth(root->left) + get_max_tree_depth(root->right) - 1  ;
}

int get_max_tree_depth(ListNode* root) {
    if (root == NULL) {
        return 0;
    }
    int left_length , right_length = 0;
    if (root->left != NULL) {
        left_length = get_max_tree_depth(root->left) + 1;
    }
    if (root->right != NULL) {
        right_length = get_max_tree_depth(root->right) + 1;
    }
    if (root->right == NULL and root->left == NULL) {
        return 1;
    }
    return left_length > right_length : left_length ? right_length;
}
