#include <stdio.h>
#include <string.h>

int main() {
    char s[] = "xyz";
    //printf("%d\n", strlen(s)); 
    printf("%d\n", sizeof(s)/sizeof(s[0])); 
}
