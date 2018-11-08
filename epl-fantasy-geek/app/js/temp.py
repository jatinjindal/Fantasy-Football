#!/usr/bin/env python
import json 
json_decode = json.load(open('static-data.json', 'r'))

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

print(data_by_id([1,2,4], [2,7], [11,12,13,14],[77]))
