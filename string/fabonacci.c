#include <stdio.h>

int fabonacci(int n);

int main(int argc, char **argv) {
    int n;
    long long fab;
    while(scanf("%d", &n) != EOF) {
        fab = fabonacci(n);    
        printf("%lld\n", fab);
    }
    return 0;
}


int fabonacci(int n) {
    if(n < 1) {
        return -1;
    }
    if(1 == n || 2 == n) {
        return 1;
    }
    int i = 3, a = 1, b=1;
    long long fab = 0;
    for(i = 3; i <= n; i++) {
        fab = a + b;    
        b = a;
        a = fab;
    }

    return fab;
}
