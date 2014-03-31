/*=============================================================================
#
#     FileName: sort.c
#         Desc: Summary of the sort algorithm
#       Author: wusuopubupt
#        Email: wdxbupt2009_at_gmail_dot_com
#
#      Created: 2013-05-06
#
=============================================================================*/
#include<stdio.h>

void swap(int *a, int *b);

void selection_sort(int *arr, int n);
void insertion_sort(int *arr, int n);
void bubble_sort(int *arr, int n);
void quick_sort(int *arr, int low, int high);
void shell_sort(int *arr, int n);
void merge_sort(int *arr, int n);
void heap_sort (int *arr, int n);

//
// main function
//
int main(void) {
	int n;
	while(scanf("%d", &n) != EOF) {
		int arr[n], i;

		for(i = 0; i < n; i++) {
			scanf("%d", &arr[i]);
		}
		quick_sort(arr, 0, n-1);

		for(i = 0; i < n; i++) {
			printf("%d ", arr[i]);
		}
		putchar('\n');
	}

	return 0;
}


//
// swap a and b
//
void swap(int *a, int *b) {
	int temp = *a;
	*a = *b;
	*b = temp;
}

//
// selection sort
//
void selection_sort(int *a, int n) {
	int i, j, min, min_index;
	for(i = 0; i < n; i++) {
		min = a[i];
		min_index = i;
		for(j = i+1; j < n; j++) {
			if(a[j] < min) {
				min = a[j];
				min_index = j;
			}
		}
		swap(&a[i], &a[min_index]);
	}
}

//
//insertion sort
//
void insertion_sort(int *a, int n) {
	int i, j, temp;
	for(i = 1; i < n; i++) {
		temp = a[i];
		j = i - 1;
		while(j >= 0 && temp < a[j]) {
			a[j+1] = a[j];
			j--;
		}
		a[j+1] = temp;
	}
}

//
//bubble sort
//reference:http://www.cnblogs.com/cj723/archive/2011/04/15/2016689.html
//
void bubble_sort(int *a, int n) {
	int i, j;
	for(i = n-1; i >= 0; i--) {
		for(j = 0; j < i; j++) {
			if(a[j+1] < a[j]) {
				swap(&a[j+1], &a[j]);
			}
		}
	}
}

//
// quick sort
// reference : http://blog.csdn.net/morewindows/article/details/6684558
//
void quick_sort(int *a, int low, int high) {
	int mid = (low + high) / 2;
	int i = low, j = high;
	int pivot = a[mid];

	while(i < j) {
		while(i <= mid && a[i] < pivot) {
			i++;
		}
		if(i < mid) {
			a[mid] = a[i];
			mid = i;
		}

		while(j >= mid && a[j] > pivot) {
			j--;
		}
		if(j > mid) {
			a[mid] = a[j];
			mid = j;
		}
	}

	a[mid] = pivot;

	//recursive
	if(mid > low) {
		quick_sort(a, low, mid-1);
	}
	if(mid < high) {
		quick_sort(a, mid+1, high);
	}
}

//
//shell sort
//
void shell_sort(int *a, int n) {

}


//
//merge sort
//
void merge_sort(int *a, int n) {

}


//
//heap sort
//
void heap_sort(int *a, int n) {

}
