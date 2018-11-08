#!/usr/bin/env python
from sys import argv
from ast import literal_eval
import json 
import tables
json_decode = json.load(open('./app/js/static-data.json', 'r'))

def data_by_id(forward, midfield, defender, goalkeeper):
     dforward = []
     dmidfield = []
     ddefender = []
     dgoalkeeper = []
     for id in forward:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dforward.append((id, i['first_name'], i['second_name'],i['total_points']))	
     for id in midfield:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dmidfield.append((id, i['first_name'], i['second_name'],i['total_points']))
     for id in defender:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             ddefender.append((id, i['first_name'], i['second_name'],i['total_points']))
     for id in goalkeeper:
             for i in json_decode['elements']:
                     if i['id'] == id:
                             dgoalkeeper.append((id, i['first_name'], i['second_name'],i['total_points']))
     return (dforward, dmidfield, ddefender, dgoalkeeper)

print(data_by_id(forw, mid,defe,gkp))

forw = literal_eval(argv[1]);
defe  = literal_eval(argv[2]);
mid  = literal_eval(argv[3]);
gkp  = literal_eval(argv[4]);

