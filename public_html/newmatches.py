#!/usr/bin/env python
import os
import platform
from datetime import datetime
from ast import literal_eval
import json

modification_records = "./modification_records.txt"
finished_matches = "./recorded_matches.txt"
event_files = ['./data/events/event' + str(i) + '.json' for i in range(1,39)]

new_mod_times = []
for json_file in event_files:
    time = str(datetime.fromtimestamp(os.path.getmtime(json_file)))
    new_mod_times.append(time)

created_new_file = False
finished_matches_ids = open(finished_matches).read().split('\n')
if not os.path.isfile(modification_records):
    handle = open(modification_records,'w+')
    content = '\n'.join(new_mod_times)
    created_new_file = True

handle = open(modification_records,'r')
old_mod_times = handle.read().split('\n')
if created_new_file:
    old_mod_times = [time + "garbage" for time in new_mod_times]

for (old,new,json_file) in zip(old_mod_times,new_mod_times,event_files):
    if old == new:
        # print("no change in",json_file)
        """that is a new comment"""
    else:
        # print(json_file, "modified after last time")
        json_decode = sorted(json.load(open(json_file, 'r')), key=lambda k: k['id'])
        for match in json_decode:
            if match['id'] in finished_matches_ids:
                continue
            print(match['team_h'],match['team_a'],'<br>')










if created_new_file:
    handle.write(content)
