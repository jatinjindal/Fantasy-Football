#!/usr/bin/env python
from sys import argv
from ast import literal_eval
import json
json_decode = json.load(open('./app/js/static-data.json', 'r'))
import unicodedata
def data_by_id(forward, midfield, defender, goalkeeper):
     dforward = []
     dmidfield = []
     ddefender = []
     dgoalkeeper = []
     for id in forward:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dforward.append((id, i['first_name'].encode('ascii','ignore') + " " + i['second_name'].encode('ascii','ignore'), i['event_points']))
     for id in midfield:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dmidfield.append((id, i['first_name'].encode('ascii','ignore') + " " + i['second_name'].encode('ascii','ignore'), i['event_points']))
     for id in defender:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             ddefender.append((id, i['first_name'].encode('ascii','ignore') + " " + i['second_name'].encode('ascii','ignore'), i['event_points']))
     for id in goalkeeper:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dgoalkeeper.append((id, i['first_name'].encode('ascii','ignore') + " " + i['second_name'].encode('ascii','ignore'), i['event_points']))
     return (dforward, dmidfield, ddefender, dgoalkeeper)



forw = literal_eval(argv[1]);
defe  = literal_eval(argv[2]);
mid  = literal_eval(argv[3]);
gkp  = literal_eval(argv[4]);
temp = data_by_id(forw,mid,defe,gkp);

for pos in temp:
    for score in pos:
        print 'id=',score[0],'&playername=',score[1],'&points=',score[2],'<br>'
