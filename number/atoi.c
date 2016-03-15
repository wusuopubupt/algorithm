#include<stdio.h>

int my_atoi(char *pstr) {
	int numb = 0;
	int sign = 1;
	if(pstr == NULL) {
		printf("pstr is null\n");
		return 0;
	}
	
	while(!(*pstr >= '0' && *pstr <= '9') && *pstr != '+' && *pstr != '-') {
		printf("*pstr is ' ' or ch.\n");
		pstr++;
	}

	if(*pstr == '+') {
		printf("*pstr is +\n");
		pstr++;
	}
	else if(*pstr == '-') {
		printf("*pstr is -\n");
		sign = -1;
		pstr++;
	}

	while(*pstr >= '0' && *pstr <= '9') {
		numb = numb*10 + (*pstr++ - '0');	
		printf("numb is %d\n", numb);
	}
	
	numb *= sign;
	printf("result is %d\n", numb);
	return numb;
}

int main() {
	char a[] = "a 123b";
	char b[] = "dx-32bb";
	int n_a = my_atoi(a);
	int n_b = my_atoi(b);

	printf("n_a=%d, n_b=%d\n", n_a, n_b);
	return 0;
}
