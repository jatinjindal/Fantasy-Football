#!/usr/bin/env python
import os
import platform
from sys import argv
from datetime import datetime
from ast import literal_eval
import json

event_files = ['./data/events/event' + str(i) + '.json' for i in range(1,39)]

finished_matches_ids = argv[1].split(',')

for json_file in event_files:
    json_decode = sorted(json.load(open(json_file, 'r')), key=lambda k: k['id'])
    for match in json_decode:
        if str(match['id']) in finished_matches_ids:
            continue
        if (match['finished'] == False):
            continue
        print(match['id'])

# print('\n'.join(new_added_matches),"klakaasn1")
# handle = open(finished_matches,'r')
# print('\n'.join(new_added_matches),"klakaasn2")
# handle.write('\n'.join(new_added_matches))
# print('\n'.join(new_added_matches),"klakaasn3")
# handle.write('\n')
# print('\n'.join(new_added_matches),"klakaasn4")
# handle.close()
# print('\n'.join(new_added_matches),"klakaasn5")
