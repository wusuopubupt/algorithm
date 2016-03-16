#include <stdio.h>
#include <stdlib.h>

typedef struct node {
    int data;
    struct node *next;
} linklist;


// 迭代
linklist * reverse_list(linklist *head) {
    linklist *pre, *cur, *next;
    if(head == NULL) {
        return NULL;
    }
    pre = NULL;
    cur = head->next;
    while(cur) {
        next = cur->next;
        if(next == NULL) {
            head = cur; 
        }
        cur->next = pre;
        pre = cur;
        cur = next;
    }
    return head;

}

// 递归
linklist *reverse_list_recursive(linklist *head) {
    linklist *pre  = head;
    if(head == NULL || head->next == NULL){
        return head;    
    } else {
        linklist *new_head = reverse_list_recursive(head->next);
        head->next->next = head;
        head->next = NULL;
        return new_head;
    }
}

void print_list(linklist *head) {
    // 有头节点的情况
    //linklist *p = head->next;            
    linklist *p = head;
    while(p){
        printf("%d\t", p->data);
        p = p->next;
    }
    putchar('\n');
}

void free_list(linklist *list) {
    if(list->next) {
        free_list(list->next); 
    }
    free(list);
    list = NULL;
}

int main() {
    int i = 0, n = 5;
    // 带有头结点的链表
    linklist *head = (linklist*)malloc(sizeof(linklist));
    linklist *tail = head;
    head->next = NULL;
    for(i = 0; i < n; i++) {
        linklist *p = (linklist*)malloc(sizeof(linklist));
        p->data = i;
        p->next = NULL;
        tail->next = p;
        tail = p;
    }
    print_list(head->next);
    linklist *l = reverse_list(head);
    print_list(l);
    free_list(l);
    l = NULL;
    free(head);
    head = NULL;
    return 0;
}
