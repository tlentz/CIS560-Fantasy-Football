import sys
import requests
import time
import csv
from bs4 import BeautifulSoup

players = []

positions = ['QB','RBWRTE','PK','DF']
for pos in positions:
    csvReader = csv.reader(open('2015/{0}.csv'.format(pos)))
    for row in csvReader:
        p = row[1]
        name = row[2]
        team = row[3]
        txt = p + " -- " + name + " -- " + team
        if (txt not in players):
            players.append(txt)
players.sort()
with open("players.txt", "w") as f:
    for p in players:
        f.write(p + '\n')
