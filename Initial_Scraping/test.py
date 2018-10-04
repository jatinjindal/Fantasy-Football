handle = open("players.csv")
players = handle.read().split('\n')


for player in players:
    if len(player) == 0:
        continue
    p = player.split(',')
    print(p[0])
    print(p[0].encode('utf-8').decode('utf-8'))
    print()

end = '\u00d6mer Toprak'
print(end.encode('utf-8').decode('utf-8'))
