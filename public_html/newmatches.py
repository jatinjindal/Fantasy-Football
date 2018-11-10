#!/usr/bin/env python
import os
import platform
from datetime import datetime
from ast import literal_eval
import json

finished_matches = "./recorded_matches.txt"
event_files = ['./data/events/event' + str(i) + '.json' for i in range(1,39)]

finished_matches_ids = open(finished_matches).read().split('\n')

for json_file in event_files:
    json_decode = sorted(json.load(open(json_file, 'r')), key=lambda k: k['id'])
    for match in json_decode:
        if str(match['id']) in finished_matches_ids:
            continue
        print(match['team_h'],match['team_a'],'<br>')
