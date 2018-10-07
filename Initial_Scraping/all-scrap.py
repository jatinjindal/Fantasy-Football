import json
import csv

handle = open("data-initial.txt")
players = handle.read().split('},')
no_of_players = len(players)

players[0] = players[0][1:]
players[-1] = players[-1][:-3]
for i in range(no_of_players):
    players[i] += '}'
    players[i] = json.loads(players[i]) # each players[i] is a dict now

    forename = players[i]['forename']
    surname = players[i]['surname']
    name = ''
    if len(forename) == 0:
        name = surname
    elif len(surname) == 0:
        name = forename
    else:
        name = forename + " " + surname
    name.strip()
    players[i].pop('forename')
    players[i].pop('surname')
    players[i]['name'] = name

# now each player has his full name rather than just the first name and the last name

goalkeepers = []
defenders = []
midfielders = []
forwards = []

for player in players:
    pos = player['position']
    if pos == 'GK':
        goalkeepers.append(player)
    elif pos == 'DEF':
        defenders.append(player)
    elif pos == 'MID':
        midfielders.append(player)
    else:
        forwards.append(player)

keys = list(players[0].keys())
keys.pop()
keys.insert(1,'name')

goalkeepers = sorted(goalkeepers, key=lambda k: k['name'])
defenders = sorted(defenders, key=lambda k: k['name'])
midfielders = sorted(midfielders, key=lambda k: k['name'])
forwards = sorted(forwards, key=lambda k: k['name'])

player_types = [goalkeepers,defenders,midfielders,forwards]
pt_str = ['goalkeepers','defenders','midfielders','forwards']

for (type,type_str) in zip(player_types,pt_str):
    with open(type_str + '.csv', 'w+') as csvfile:
        filewriter = csv.writer(csvfile, delimiter=',', quotechar='|', quoting=csv.QUOTE_MINIMAL)

        filewriter.writerow(keys)
        for player in type:
            current = list(player.values())
            name = current.pop()
            current.insert(1,name)
            filewriter.writerow(current)
















# need space
