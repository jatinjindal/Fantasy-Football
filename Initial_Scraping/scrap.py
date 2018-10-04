import re
import csv

handle = open("data-initial.txt")
players = handle.read().split('},')
count = 0
names = []

for player in players:
    pattern = re.compile(r"surname\":\".*?\"")
    surname = pattern.search(player)

    pattern = re.compile(r"forename\":\".*?\"")
    forename = pattern.search(player)

    pattern = re.compile(r"value\":\".*?\"")
    value = pattern.search(player).group()[8:-1]

    pattern = re.compile(r"teamname\":\".*?\"")
    team = pattern.search(player).group()[11:-1]

    if len(forename.group()) == 12:
        names.append((surname.group()[10:-1],team,value))
        count += 1
    elif len(surname.group()) == 11:
        names.append((forename.group()[11:-1],team,value))
        count += 1
    else:
        names.append((forename.group()[11:-1] + " " + surname.group()[10:-1],team,value))
        count += 1

names.sort()
with open('players.csv', 'w+') as csvfile:
    filewriter = csv.writer(csvfile, delimiter=',', quotechar='|', quoting=csv.QUOTE_MINIMAL)

    filewriter.writerow(['Name', 'Team', 'Value (in Millions)'])
    for name in names:
        filewriter.writerow([name[0], name[1], name[2]])


print(count)
