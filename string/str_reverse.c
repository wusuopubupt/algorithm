#include <stdio.h>
#include <ctype.h>


void str_reverse(char *s, int i, int j);

int main(int argc, char **argv) {
    //while(fgets(a, 1000, stdin)) {
        char a[] = "hello world";
        int n = sizeof(a)/sizeof(a[0]) - 2; 
        str_reverse(a, 0, n); // "dlrow olleh"
        int i = 0, j = 0;
        while(a[i] != '\0') {
            // 找到空格处或者终点
            while(a[j] != ' ') {
                j++;
                if(a[j] == '\0') {
                    break;
                }
            }
            str_reverse(a, i, j-1);
            i = ++j;
        }
    //}
    printf("%s", a);
    return 0;
}

void str_reverse(char *a, int i, int j) {
    //printf("func called! i:%d, j:%d\n", i, j);
    while(i < j) {
        char temp = a[j];
        a[j] = a[i];
        a[i] = temp;
        i++;
        j--;
    }
}
