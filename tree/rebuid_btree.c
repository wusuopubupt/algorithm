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
    if (pPreOrder == NULL || pInOrder == NULL) {
        return;
    }
    root = (tree *)malloc(sizeof(tree *));
    root->data = *pPreOrder;
    root->left = NULL;
    root->right = NULL;

    if (len == 1) {
        return;
    }

    int *pOrgInOrder = pInOrder;
    int *pLeftEnd = pInOrder;
    int ntemp = 0;

    while (*pPreOrder != *pLeftEnd) {
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

/*
   void rebuild(int *preOrder, int *inOrder, int preOrderIndex, int inOrderIndex, int len, tree *root) {
   if(preOrder == NULL || inOrder == NULL) return;
   if(len == 1) return;

   root = (tree *)malloc(sizeof(tree *));
   if(root == NULL) {
   root->data = preOrder[preOrderIndex];
   root->left = NULL;
   root->right = NULL;
   }

   int i = inOrderIndex;
   while(inOrder[inOrderIndex] != preOrder[preOrderIndex]) {
   if(inOrder[inOrderIndex] == NULL )
   i++;
   if(i > len) {
   break;
   }
   }

   int leftLen = i - inOrderIndex;
   int rightLen = len - 1 - leftLen;

   if(leftLen > 0) {
   rebuild(preOrder, inOrder, preOrderIndex+1, inOrderIndex, leftLen, root->left);
   }
   if(rightLen > 0) {
   rebuild(preOrder, inOrder, preOrderIndex+leftLen+1, inOrderIndex+leftLen+1, rightLen, root->right);
   }
   }
 */
