#include <stdio.h>
#include <string.h>

typedef struct Node {
    char data;
    struct Node *left;
    struct Node *right;
} node;

// 二叉树的创建
node *create_btree() {
    node *t;
    char ch;
    scanf("%c\n", &ch);
    if(ch == '#') {
        t = NULL;     
    } else {
        t = (node *)malloc(sizeof(node));
        t->data = ch;
        t->left = create_btree();
        t->right = create_btree();
    }
    return t;
}

void print_tree(node *tree) {
    if (tree) {
        printf("%c\n", tree->data);
        if(tree->left) {
            print_tree(tree->left);
        }
        if(tree->right) {
            print_tree(tree->left);
        }
    }
}

void print_tree_by_level(node *tree, int n) {
    node **arr_tree = (node **)malloc(sizeof(node*)*n);
    // 每层的个数
    int count[n];
    int cur = 0, last = 0;
    arr_tree[cur] = tree;
    while(cur < last+1) {
        // 一层
        int i = 0;
        while (i < count[cur]){
            printf("%c\t", arr_tree[cur]->data);
            i++;
            if(arr_tree[cur]->left) {
                arr_tree[++last] = arr_tree[cur]->left; 
                count[cur+1]++;
            } 
            if(arr_tree[cur]->right) {
                arr_tree[++last] = arr_tree[cur]->right;
                count[cur+1]++;
            }
            cur++;
        }
        //putchar('\n');
    }
    free(arr_tree);
    arr_tree = NULL;
}

int main(int argc, char **argv) {
    node *t = create_btree();
    //print_tree(t);
    print_tree_by_level(t, 100);
    free(t);
    t = NULL;
    return 0;
}
