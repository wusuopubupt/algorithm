#include <stdio.h>
#include <stdlib.h>

struct _Node {
	int data;
	struct _Node *next;//�����ýṹ
};

typedef struct _Node node_t; //typedef �� �� struct _Node ����ṹ�帳������ node_t(���ڣ�node_t��������int)

typedef struct _Linklist {
	node_t *phead;//�ṹ��Ƕ��
	node_t *ptail;
	int len;
} Linklist;

static node_t *GetNode(int i)
{
	node_t *pNode; // pNode ��ָ��ṹ��node_t��ָ��
	pNode = (node_t*) malloc(sizeof(node_t));//��node_t�ṹ�嶯̬�����ڴ棬��malloc�ɹ��󷵻�һ��node_t���͵�ָ��
	if (!pNode) {
		printf("Error,the memory is not enough!\n");
		exit(-1);
	}
	pNode->data = i; //ָ��ṹ���ָ��ͨ��-> ���ýṹ���Ա
	pNode->next = NULL;
	return pNode;
}

void init_list(Linklist *plist)
{
	node_t *p;
	p = GetNode(1); // �õ�һ���ڵ��ʼ��ѭ��������
	plist->phead = p;
	plist->ptail = p;	//����ѭ������
	p->next = plist->phead;
	plist->len = 1;
}

static void Create_List(Linklist *plist, int n)  // ������������ӵ�ѭ����������
{
	int i = 0;
	node_t *pNew;
	for (i = 2; i <= n; i++) {
		pNew = GetNode(i);
		plist->ptail->next = pNew;
		plist->ptail = pNew;
		pNew->next = plist->phead;
		plist->len ++;
	}
	printf("Finish!\n");
}

void Print_List(Linklist *plist)
{
	node_t *pCur = plist->phead;
	do {
		printf("The %d person.\n", pCur->data);
		pCur = pCur->next;
	} while (pCur != plist->phead);
	printf("The length of the List: %d\n", plist->len);
}

void joseph(Linklist *plist, int m)    //Լɪ��ػ�����ʵ��
{
	node_t *pPre = plist->ptail;
	node_t *pCur = plist->phead;
	int i;
	while (plist->len != 1) {
		i = 0;
		while (i < m - 1) {
			pPre = pPre->next;
			i++;
		}
		pCur = pPre->next;
		pPre->next = pCur->next;
		printf("%2d was killed !\n",pCur->data);//��ӡÿ�α�kill����
		free(pCur);
		plist->len--;
	}
	printf("The last one is: %d\n", pPre->data);
}
int main() {
	int m,n;
	printf("Please input the Length of the Circle list: ");
	scanf("%d", &n);
	printf("Please input the Stop point: ");
	scanf("%d", &m);
	Linklist pList;
	init_list(&pList);
	Create_List(&pList, n);
	Print_List(&pList);
	joseph(&pList, m);
	return 0;
}
