/*=============================================================================
#
#     FileName: sort.c
#         Desc: Summary of the sort algorithm
#       Author: wusuopubupt
#        Email: wdxbupt2009_at_gmail_dot_com
#
#      Created: 2014-03-30
#
=============================================================================*/
#include<stdio.h>
#include<stdlib.h>

#define MAX_HEAP_LEN 100
int heap[MAX_HEAP_LEN];
int heap_size = 0;


void swap(int *a, int *b);
void dump_arr(int *a, int n);
void selection_sort(int *arr, int n);
void insertion_sort(int *arr, int n);
void bubble_sort(int *arr, int n);
void quick_sort(int *arr, int low, int high);
void shell_sort(int *arr, int n);
void merge_sort(int *arr, int n);
void merge_array(int *a1, int a1_size, int *a2, int a2_size);
void heap_sort (int *arr, int n);

/**
 * main function
 */
int main(void) {
	int n;
	while(scanf("%d", &n) != EOF) {
		int arr[n], i;

		for(i = 0; i < n; i++) {
			scanf("%d", &arr[i]);
		}

		heap_sort(arr, n);

		//dump_arr(heap, n);
	}

	return 0;
}


/**
 * swap a and b
 */
void swap(int *a, int *b) {
	int temp = *a;
	*a = *b;
	*b = temp;
}


/*
 * dump an array
 */
void dump_arr(int *a, int n) {
	int i;
	for(i = 0; i < n; i++) {
		printf("%d ", a[i]);
	}
	putchar('\n');
}


/**
 * selection sort
 *
 * 每次从无序的n-i个数找到最小的数
 * 并和第i(0<=i<n)个数交换
 * 时间复杂度为O(n^2)
 */
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

/*
 * insertion sort
 * 将一个记录插入到已经排好序的有序表中, 从而得到一个新的,记录数增1的有序表
 */
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


/* bubble sort
 *
 *两两比较相邻记录的关键字,如果反序则交换
 */

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


/*
 * quick sort(Digging and filling)
 *
 * 快速排序不稳定
 * reference : http://blog.csdn.net/morewindows/article/details/6684558
 *
 * */
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

/*
 * shell sort
 *
 * 先将整个待排元素序列分割成若干子序列（由相隔某个“增量”的元素组成的）分别进行
 * 直接插入排序，然后依次缩减增量再进行排序，待整个序列中的元素基本有序（增量足够小,gap == 1）时，
 * 再对全体元素进行一次直接插入排序。其时间复杂度为O(n^3/2),要好于直接插入排序的O(n^2)
 *
 * */
void shell_sort(int a[], size_t n) {
	int gap;
	for(gap = n/2; gap > 0; gap /= 2) {
		int i;
		for(i = gap; i < n; i++) {
			if(a[i] < a[i-gap]) {
				int j = i - gap;
				int temp = a[i];
				while(j >= 0 && a[j] > a[i]) {
					a[j+gap] = a[j];
					j -= gap;
				}
				a[j+gap] = temp;
			}
		}
	}
}

/*
 * merge sort
 *
 * 分治、递归
 * */
void merge_sort(int *a, int n) {
	if(n > 1) {
		int *a1 = a; //注意a1和a的地址是一样的
		int a1_size = n / 2;
		int *a2 = a + n / 2;
		int a2_size = n - a1_size;

		merge_sort(a1, a1_size);
		merge_sort(a2, a2_size);

		merge_array(a1, a1_size, a2, a2_size);
	}
}

void merge_array(int *a1, int a1_size, int *a2, int a2_size) {
	int i, j, k, n;
	i = j = k = 0;
	n = a1_size + a2_size;
	int a[n];

	while(i < a1_size && j < a2_size) {
		// 把较小的那个数据放到结果数组里， 同时移动指针
		a[k++] = a1[i] < a2[j] ? a1[i++] : a2[j++];
	}

	// 如果 list1 还有元素，把剩下的数据直接放到结果数组
	while(i < a1_size) {
		a[k++] = a1[i++];
	}

	//反之， 如果 list1 还有元素，把剩下的数据直接放到结果数组
	while(j < a2_size) {
		a[k++] = a2[j++];
	}

	// 把结果数组 copy 到 list1 里
	for(i = 0; i < n; ++i) {
		a1[i] = a[i];
	}
}


/*
 * heap sort(最小堆)
 *
 * 堆的特点：
 *
 * 父节点i的左子节点在位置 (2*i+1);
 * 父节点i的右子节点在位置 (2*i+2);
 * 子节点i的父节点在位置 floor((i-1)/2);
 *
 * */
void shift_up(int i) {
	int done = 0;
	if(i == 0) {
		return; //root
	}
	while((i != 0) && (!done)) {
		if(heap[i] < heap[(i-1)/2]) {
			swap(&heap[i], &heap[(i-1)/2]);
		}
		else {
			done = 1;
		}
		i = (i-1) / 2; //parent
	}
}

void shift_down(int i) {
	int done = 0;
	//没有左子结点，即为叶节点
	if(2*i+1 > heap_size) {
		return;
	}
	while((2*i+1 < heap_size) && (!done)) {
		i = 2*i + 1; //jump to left child
		if((i+1 < heap_size) && heap[i+1] > heap[i]) {
			i++;
		}
		if(heap[(i-1)/2] > heap[i]) {
			swap(&heap[(i-1)/2], &heap[i]);
		}
		else{
			done = 1;
		}
	}
}

void delete(int i) {
	int last = heap[heap_size - 1];
	heap_size--;
	if(i == heap_size) {
		return;
	}
	heap[i] = last;
	shift_down(i);
}


int delete_min() {
	int ret = heap[0];
	delete(0);
	return ret;
}

void insert(int new_data) {
	if(heap_size >= MAX_HEAP_LEN) {
		return;
	}
	heap_size++;
	heap[heap_size - 1] = new_data;
	shift_up(heap_size - 1);
}

void heap_sort(int *a, int n) {
	int i;
	for(i = 0; i < n; i++) {
		insert(a[i]);
	}
	dump_arr(heap, n);
}

