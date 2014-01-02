#include<stdio.h>

int search(int a[][1005], int m, int n, int key) {
	int i = 0;
	int j = n - 1;
	while (i < m && j >= 0) {
		if (a[i][j] == key)
			return 1;
		else if (a[i][j] < key)
			i++;
		else
			j--;
	}

	return 0;
}

int main() {
	int n, m;
	int a[1005][1005];
	while (scanf("%d %d", &m, &n) != EOF) {
		int key;
		scanf("%d", &key);
		int i, j;
		for (i = 0; i < m; i++){
			for (j = 0; j < n; j++) {
				scanf("%d", &a[i][j]);
			}
		}
		int flag = search(a, m, n, key);
		if(flag) {
			printf("Yes\n");
		}
		else {
			printf("No\n");
		}
	}
	return 0;
}
