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
        printf("%c\t", tree->data);
        if(tree->left) {
            printf("left\n");
            print_tree(tree->left);
        }
        if(tree->right) {
            printf("right\n");
            print_tree(tree->left);
        }
    }
}

void print_tree_by_level(node *tree, int n) {
    node **arr_tree = (node **)malloc(sizeof(node*)*n);
    int cur = 0, last = 0, level = 0;
    int count[n];
    bzero(count, n);
    arr_tree[0] = tree;
    count[0] = 1;
    while(cur < last+1) {
        int i = 0;
        while (i < count[level]){
            node *nd = arr_tree[cur];
            //printf("i:%d, level:%d, count:%d \n", i, level, count[level]);
            if(nd) {
                printf("%c\t", nd->data);
            }
            i++;
            if(nd->left) {
                arr_tree[++last] = nd->left;
                count[level+1]++;
            } 
            if(arr_tree[cur]->right) {
                arr_tree[++last] = nd->right;
                count[level+1]++;
            }
            cur++;
        }
        level++;
        putchar('\n');
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
