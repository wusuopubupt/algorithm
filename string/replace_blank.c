/**
 * @brief 实现一个函数，将一个字符串中的空格替换成“%20”
 *        例如，当字符串为We Are Happy.则经过替换之后的字符串为We%20Are%20Happy
 * @author wusuopubupt
 * @date   2014-01-17
 * @refer  http://blog.csdn.net/wusuopubupt/article/details/18401017
 */
#include <stdio.h>

void replace(char *a, char *b);

int main(int argc, char **argv) {
    char a[1000], b[1000];
    while(fgets(a, 1000, stdin)) {
        replace(a, b);
        printf("%s", b);
    }   
    return 0;
}

// O(n)时间复杂度
void replace(char *a, char *b) {
    while(*a) {
        if(*a != ' ') {
            *b++ = *a++;
        } else {
            *b++ = '%';
            *b++ = '2';
            *b++ = '0';
            a++;
        }
        *b = '\0';
    }
}

