#include <stdio.h>
#include <stdlib.h>
#include <string.h>

int main() {
	int a[200] = {0}, b[200] = {0}, sum[202] = {0};
	char x[200], y[200];
	fgets(x, sizeof(x), stdin);
	fgets(y, sizeof(y), stdin);

	int len_i = strlen(x) - 1;
	int len_j = strlen(y) - 1;

	int i, j;
	for(i = 0; i < len_i; i++) {
		a[len_i-1-i] = x[i] - 48; //reverse
	}
	for(j = 0; j < len_j; j++) {
		b[len_j-1-j] = y[j] - 48;
	}

	int n;
	n = len_i >= len_j ? len_i : len_j;

	i = 0;
	int temp_c = 0;
	for(; i < n; i++) {
		int temp_s = a[i] + b[i] + temp_c;
		sum[i] = temp_s % 10;
		temp_c = temp_s / 10;
		//printf("a=%d,b=%d,sum[i]=%d,temp_c=%d\n", a[i], b[i],sum[i],temp_c);
	}
	if(temp_c != 0) {
		sum[n] = temp_c;
		n++;
	}
	for (i = n-1; i >= 0; i--) {
		printf("%d", sum[i]);
	}
	putchar('\n');

	return 0;
}
