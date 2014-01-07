#include<stdio.h>
int a[1000005];
int main() {
    int i, n, k;
    while(scanf("%d %d", &n, &k) != EOF) {
        for(i = 0; i < n; i++) {
            scanf("%d", &a[i]);
        }
        int start = 0, end = n-1;
        while(a[end/2] > k) {
            end /= 2;
        }
        while(start < end) {
            int sum = a[start] + a[end];
            if(sum == k) {
                break;
            }
            else if (sum > k) {
                end--;
            }
            else {
                start++;
            }
        }
        if(start < end) {
            printf("%d %d\n", a[start], a[end]);
        }
        else {
            printf("-1 -1\n");
        }
    }
    return 0;
}
 
/**************************************************************
    Problem: 1352
    User: wusuopuBUPT
    Language: C
    Result: Accepted
    Time:1490 ms
    Memory:4820 kb
****************************************************************/
