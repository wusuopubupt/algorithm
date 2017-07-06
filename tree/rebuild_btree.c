// Rebuild binary tree
//      a
//     / \
//    b   c
//   /   / \
//  d   e   f
// pre order：a b d c e f  (so we can kwnow that a is root)
// mid order：d b a e c f  (d and b are at left, c and f are at right) 
#include<stdio.h>
#include<stdlib.h>

typedef struct Tree {
    int data;
    struct Tree *left;
    struct Tree *right;
} tree;

int *preOrder, *inOrder;

void printPostOrder(tree *root);
void rebuild(int *pPreOrder, int *pInOrder, int len, tree *root);

int main() {
    int i, n;
    while (scanf("%d", &n) != EOF) {
        preOrder = (int *) malloc(sizeof(int) * n);
        inOrder = (int *) malloc(sizeof(int) * n);
        for (i = 0; i < n; i++) {
            scanf("%d", &preOrder[i]);
        }
        for (i = 0; i < n; i++) {
            scanf("%d", &inOrder[i]);
        }
    }

    tree *root = NULL;
    rebuild(preOrder, inOrder, n, root);

    if (root) {
        printPostOrder(root);
    } else {
        printf("No");
    }

    putchar('\n');

    return 0;
}

void printPostOrder(tree *root) {
    printPostOrder(root->left);
    printPostOrder(root->right);

    printf("%d ", root->data);
}

void rebuild(int *pPreOrder, int *pInOrder, int len, tree *root) {
	// check the boundary conditions  
    if (pPreOrder == NULL || pInOrder == NULL) {
        return;
    }
    root = (tree *)malloc(sizeof(tree *));
    // first element of pPreOrder is root
    root->data = *pPreOrder;
    root->left = NULL;
    root->right = NULL;

	// reaches leaf node
    if (len == 1) {
        return;
    }

    int *pOrgInOrder = pInOrder;
    int *pLeftEnd = pInOrder;
    int ntemp = 0;

	// find leaf sub tree's end
	// pre order：a b d c e f  
	// mid order：d b a e c f 
	// root->data = a
    while (*pLeftEnd != root->data) {
        if (pPreOrder == NULL || pLeftEnd == NULL) {
            return;
        }
        ntemp++;
        if (ntemp > len) {
            return;
        }
        pLeftEnd++;
    }

    int nLeftLen = 0;
    nLeftLen = pLeftEnd - pOrgInOrder;

    int nRightLen = 0;
    nRightLen = len - nLeftLen - 1;

    if (nLeftLen > 0) {
        rebuild(pPreOrder + 1, pInOrder, nLeftLen, root->left);
    }

    if (nRightLen > 0) {
        rebuild(pPreOrder+nLeftLen+1, pInOrder+nLeftLen+1, nRightLen, root->right);
    }
}
