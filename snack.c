//贪吃蛇
#include<curses.h>
#include<stdlib.h>
#include<unistd.h>
#include<time.h>

struct Snack {
	int x[100], y[100];
	int node;
	int life;
	int direction;
} snack;

struct Food {
	int X, Y;
	int set;
} food;

struct timespec delay;
struct timespec dummy;
time_t timer;
int TIME = 0;
long Time, Time1 = 0, Time2 = 0;
int ptime[100];
int score = 0;
int i, tem[2], k = 0;
void color();
void init();
void draw();
void start_attr();
void output();
void play();
void judge();
int pause_time(int, int *);
void d_e();

int main(int argc, char **argv) {

	init();
	draw();
	play();
	return 0;
}

void d_e() {
	int location = 18;
	int ch2 = KEY_LEFT, which = 0;
	char str[2][5] = { "Easy", "Hard" };
	while (ch2 != '\n') {

		switch (ch2) {
		case (KEY_LEFT):
			if (location != 18) {
				location -= 10;
				which = 0;
			}
			break;
		case (KEY_RIGHT):
			if (location == 18) {
				location += 10;
				which = 1;
			}
			break;
		}
		mvprintw(8, 10, "Please choose the difficulty!");
		mvprintw(10, 23, "^_^");
		mvprintw(12, 18, "Easy");
		mvprintw(12, 28, "Hard");
		attron(A_REVERSE);
		mvprintw(12, location, "%s", str[which]);
		attroff(A_REVERSE);
		refresh();
		ch2 = getch();
	}
	/*Time2=time(NULL);
	 ptime[k]=Time2-Time1;
	 k++; */
	if (location == 28)
		delay.tv_nsec = 100000000;
	else
		delay.tv_nsec = 200000000;
}

int pause_time(int k, int *PTIME) {
	int j;
	int sum = 0;
	for (j = 0; j < k; j++)
		sum = sum + ptime[j];
	return sum;
}
void judge() {
	if (snack.direction == 1)
		snack.y[0]--;
	else if (snack.direction == 2)
		snack.y[0]++;
	else if (snack.direction == 3)
		snack.x[0]--;
	else
		snack.x[0]++;
}
void color() {
	start_color();
	init_pair(1, COLOR_GREEN, COLOR_RED);
	attron(COLOR_PAIR(1));
	for (i = 0; i < 50; i++)
		mvaddch(0, i, '*');
	for (i = 0; i < 20; i++)
		mvaddch(i, 0, '*');
	for (i = 49; i >= 0; i--)
		mvaddch(19, i, '*');
	for (i = 19; i >= 0; i--)
		mvaddch(i, 49, '*'); //box(stdscr,'*','*');

	attroff(COLOR_PAIR(1));
}
void init() {
	initscr();
	raw();
	noecho();
	keypad(stdscr, TRUE);
	curs_set(0);
	nodelay(stdscr, TRUE);
}
void draw() {
	snack.x[0] = 6;
	snack.y[0] = 3;
	snack.x[1] = 5;
	snack.y[1] = 3;
	snack.x[2] = 4;
	snack.y[2] = 3;
	snack.life = 0;
	snack.node = 3;
	snack.direction = 4;
	food.set = 0;
	color();
	d_e();
	for (i = 0; i < snack.node; i++)
		mvprintw(snack.y[i], snack.x[i], "*");
	refresh();

	timer = time(NULL);
}
void output() {
	color();
	mvprintw(20, 0, "Score=%d", score);
	mvprintw(20, 43, "Node=%d", snack.node);
	mvprintw(21, 0, "Time=%ds", TIME);
	attroff(A_REVERSE);
	refresh();
}
void start_attr() {
	attron(A_REVERSE);
}

void play() {
	while (1) {
		Time = time(NULL);
		TIME = Time - timer - pause_time(k, ptime);
		clear();
		if (food.set == 0) {
			food.X = rand() % 50;
			while (food.X == 0 || food.X == 49)
				food.X = rand() % 50;
			food.Y = rand() % 20;
			while (food.Y == 0 || food.Y == 19)
				food.Y = rand() % 20;
			food.set = 1;
		}
		tem[0] = snack.y[snack.node - 1];
		tem[1] = snack.x[snack.node - 1];
		for (i = snack.node - 1; i > 0; i--) {
			snack.x[i] = snack.x[i - 1];
			snack.y[i] = snack.y[i - 1];
		}
		int ch = 0;
		ch = getch();
		switch (ch) {
		case (KEY_UP):
			if (snack.direction == 3 || snack.direction == 4) {
				snack.y[0]--;
				snack.direction = 1;
			} else if (snack.direction == 1)
				snack.y[0]--;
			else
				snack.y[0]++;
			break;
		case (KEY_DOWN):
			if (snack.direction == 3 || snack.direction == 4) {
				snack.y[0]++;
				snack.direction = 2;
			} else if (snack.direction == 1)
				snack.y[0]--;
			else
				snack.y[0]++;
			break;
		case (KEY_LEFT):
			if (snack.direction == 1 || snack.direction == 2) {
				snack.x[0]--;
				snack.direction = 3;
			} else if (snack.direction == 3)
				snack.x[0]--;
			else
				snack.x[0]++;
			break;
		case (KEY_RIGHT):
			if (snack.direction == 1 || snack.direction == 2) {
				snack.x[0]++;
				snack.direction = 4;
			} else if (snack.direction == 3)
				snack.x[0]--;
			else
				snack.x[0]++;
			break;
		case 'p':
		case 'P':
			Time1 = time(NULL);
			judge();
			for (i = 0; i < snack.node; i++)
				mvprintw(snack.y[i], snack.x[i], "*");
			mvaddch(food.Y, food.X, '*');
			start_attr();
			mvprintw(9, 10, "Pause!Press 'p' to continue!");
			output();
			while (getch() != 'p')
				;
			Time2 = time(NULL);
			ptime[k] = Time2 - Time1;
			k++;
			break;

		case 'q':
		case 'Q':
			Time1 = time(NULL);
			judge();
			for (i = 0; i < snack.node; i++)
				mvprintw(snack.y[i], snack.x[i], "*");

			mvaddch(food.Y, food.X, '*');
			start_attr();
			mvprintw(10, 22, "Quit!");
			output();
			int location = 18;
			int ch2 = KEY_LEFT, which = 0;
			char str[2][5] = { "No", "Yes" };
			while (ch2 != '\n') {

				switch (ch2) {
				case (KEY_LEFT):
					if (location != 18) {
						location -= 10;
						which = 0;
					}
					break;
				case (KEY_RIGHT):
					if (location == 18) {
						location += 10;
						which = 1;
					}
					break;
				}
				mvprintw(12, 18, "No");
				mvprintw(12, 28, "Yes");
				attron(A_REVERSE);
				mvprintw(12, location, "%s", str[which]);
				attroff(A_REVERSE);
				refresh();
				ch2 = getch();
			}
			Time2 = time(NULL);
			ptime[k] = Time2 - Time1;
			k++;
			if (location == 18)
				break;
			else {
				clear();
				endwin();
				exit(1);
			}
		default:
			judge();
			break;
		}
		for (i = 1; i < snack.node; i++)
			if ((snack.x[0] == snack.x[i] && snack.y[0] == snack.y[i])
					|| snack.x[0] == 0 || snack.y[0] == 0 || snack.x[0] == 49
					|| snack.y[0] == 19) {
				for (i = 1; i < snack.node; i++) {
					snack.x[i - 1] = snack.x[i];
					snack.y[i - 1] = snack.y[i];
				}
				snack.y[snack.node - 1] = tem[0];
				snack.x[snack.node - 1] = tem[1];
				for (i = 0; i < snack.node; i++)
					mvprintw(snack.y[i], snack.x[i], "*");
				mvaddch(food.Y, food.X, '*');
				start_attr();
				mvprintw(10, 10, "You lose!");
				mvprintw(11, 10, "Do you want again?(y/n)");
				output();
				snack.life = 1;
				//sleep(1);

				break;
			}
		if (snack.x[0] == food.X && snack.y[0] == food.Y) {
			food.set = 0;
			snack.node++;
			score += 10;
			for (i = snack.node - 1; i > 0; i--) {
				snack.x[i] = snack.x[i - 1];
				snack.y[i] = snack.y[i - 1];
			}
			judge();
		}
		if (snack.life == 0) {
			;
			for (i = 0; i < snack.node; i++)
				mvprintw(snack.y[i], snack.x[i], "*");
			//attron(A_INVIS);

			mvaddch(food.Y, food.X, '*');
			//sleep(1);

			//attroff(A_INVIS);

			start_attr();
			output();
			nanosleep(&delay, &dummy); //sleep(2);

		}

		else {
			char ch1;
			while (ch1 = getch())
				if (ch1 == 'y' || ch1 == 'Y') {
					clear();
					for (i = 0; i < snack.node; i++)
						snack.x[i] = snack.y[i] = -1;
					TIME = Time1 = Time2 = k = 0;
					score = 0;
					draw();
					snack.life = 0;
					break;
				} else if (ch1 == 'n' || ch1 == 'N') {
					endwin();
					exit(1);
				} else
					continue;
		}
	}
}
