#include <stdio.h>

int bsearch(int a[], int low, int high, int x) {
    int mid;
    while(low < high) {
        mid = low + (high-low)/2;  
        if(a[mid] < x) {
            low++;
        } else if(a[mid] > x){
            high--;
        } else {
            return mid;
        }
    }
    // not found
    return -1;
}

int bsearch_recursion(int a[], int low, int high, int x) {
    if(low > high) {
        return -1; 
    }
    int pos = low + (high-low)/2;
    printf("low:%d, high:%d, pos:%d, a[pos]:%d, x:%d\n", low, high, pos, a[pos], x);
    if(a[pos] == x) {
        return pos; 
    } else if(a[pos] < x) {
        return bsearch_recursion(a, low+1, high, x);
    } else{
        return bsearch_recursion(a, low, high-1, x);
    }
}

int main() {
    int a[] = {1,2,3,4,6,7,8};
    int pos = bsearch_recursion(a, 0, sizeof(a)/sizeof(int), 5);
    printf("pos is :%d\n", pos);
    return 0;
}
