#!/bin/bash

#$1 = 'bhavishyagopesh@gmail.com'
#$2 = 'itmaynotbeknown'

ruby get.rb $1 $2 "../app/js/static-data.json" "../app/js/dynamic-data.json"
