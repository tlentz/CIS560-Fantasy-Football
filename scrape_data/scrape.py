import sys
import requests
import time
import csv
from bs4 import BeautifulSoup

def scrape_data(year):
    positions = ['QB','RB','WR','TE','PK','DF']
    QB_stats = []
    RBWRTE_stats = []
    PK_stats = []
    DF_stats = []
    for pos in positions:
        for i in range(1, 18):
            print("{0}========={1}==============".format(i,pos))
            url = "http://thehuddle.com/stats/{0}/plays_weekly.php?week={1}&pos={2}".format(year,i,pos)
            response = requests.get(url)
            html = response.content
            soup = BeautifulSoup(html,'html.parser')
            stats = soup.find("div",{"class":"mod-table align-center nowrap"}).find("table").find("tbody")
            rows = stats.findAll("tr")
            for row in rows:
                cells = row.findAll("td")
                j = 0
                player_stats = []
                player_stats.append(i)
                player_stats.append(pos)
                for cell in cells:
                    if j < 1:
                        player_name = cell.find("a").contents[0]
                        player_stats.append(player_name)
                    else:
                        player_stats.append(cell.contents[0].strip())
                    j += 1
                if pos == "DF":
                    DF_stats.append(player_stats)
                elif pos == "PK":
                    PK_stats.append(player_stats)
                elif pos == "QB":
                    QB_stats.append(player_stats)
                else:
                    RBWRTE_stats.append(player_stats)
    with open('2015/QB.csv', 'w') as f:
        output = "";
        for stats in QB_stats:
            for s in stats:
                output = output + str(s) + ","
            output = output + "\n"
        f.write(output)
    with open('2015/RBWRTE.csv', 'w') as f:
        output = "";
        for stats in RBWRTE_stats:
            for s in stats:
                output = output + str(s) + ","
            output = output + "\n"
        f.write(output)
    with open('2015/PK.csv', 'w') as f:
        output = "";
        for stats in PK_stats:
            for s in stats:
                output = output + str(s) + ","
            output = output + "\n"
        f.write(output)
    with open('2015/DF.csv', 'w') as f:
        output = "";
        for stats in DF_stats:
            for s in stats:
                output = output + str(s) + ","
            output = output + "\n"
        f.write(output)
    print("DONE!")

'''
QB
0 - Name
1 - Team
2 - Plays
3 - FPTs
4 - Rush Att
5 - Rush Yds
6 - Rush TDs
7 - Pass Att
8 - Pass Comp
9 - Pass Yds
10 - Pass Tds
11 - Fum
12 - Int

WR / RB / TE
0 - Name
1 - Team
2 - Plays
3 - FPTs
4 - Rush Att
5 - Rush Yds
6 - Rush TDs
7 - Targets
8 - Rec
9 - Rec Yds
10 - Pass Tds
11 - Fum
12 - Int

K
0 - Name
1 - Team
2 - FPts
3 - FG
4 - FG Miss
5 - XPT
6 - XPT Miss

DEF
0 - Name
1 - Team
2 - FPts
3 - Sacks
4 - FR
5 - INT
6 - TD
7 - SFTY
8 - Ryd Allowed
9 - Pyd Allowed
10 - Total Yd Allowed
'''

def main():
    if len(sys.argv) < 2:
        print("Please provide the year")
        sys.exit(-1)
    year = sys.argv[1]
    scrape_data(year)


if __name__ == '__main__':
    main()
