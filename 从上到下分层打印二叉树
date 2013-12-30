#include<stdio.h>
#include<string.h>
struct Tree {
    int data;
    struct Tree *left;
    struct Tree *right;
} nodes[1001];

int is_empty();
void enqueue();
struct Tree *dequeue();

struct Tree *queue[1001];
int head = 0, tail = 0, n, l, r;
char str[3];

int main() {
    while (scanf("%d", &n) != EOF) {
        memset(nodes, 0, sizeof(struct Tree) * n);
        int i;
        for (i = 0; i < n; i++) {
            scanf("%d", &nodes[i].data);
        }
        for (i = 0; i < n; i++) {
            scanf("%s", str);
            if (str[0] == 'd') {
                scanf("%d %d", &l, &r);
                nodes[i].left = &nodes[l - 1];
                nodes[i].right = &nodes[r - 1];
            } else if (str[0] == 'l') {
                scanf("%d", &l);
                nodes[i].left = &nodes[l - 1];
            } else if (str[0] == 'r') {
                scanf("%d", &r);
                nodes[i].right = &nodes[r - 1];
            }
        }

        printf("%d", nodes[0].data);
        if(nodes[0].left) enqueue(nodes[0].left);
        if(nodes[0].right) enqueue(nodes[0].right);

        //enqueue(&nodes[0]); 注意，这样写会有Presentation Error（空格导致）

        while (!is_empty()) {
            struct Tree *tmp = dequeue();
            printf(" %d", tmp->data);
            if (tmp->left) {
                enqueue(tmp->left);
            }
            if (tmp->right) {
                enqueue(tmp->right);
            }
        }
    }

    return 0;
}

int is_empty() {
    return head == tail;
}

void enqueue(struct Tree *node) {
    queue[tail++] = node;
}

struct Tree *dequeue() {
    return queue[head++];
}

/**************************************************************
    Problem: 1523
    User: wusuopuBUPT
    Language: C
    Result: Accepted
    Time:0 ms
    Memory:944 kb
****************************************************************/


