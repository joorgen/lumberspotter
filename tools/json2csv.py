#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys,json

if len(sys.argv) > 1:
	filename = sys.argv[1]

	with open(filename) as data_file:    
		data = json.load(data_file)
		
	print( (','.join('"' + key + '"' for key in data[0].keys())) )

	for item in data:
		print( (','.join('"' + str(prop) + '"' for key,prop in item.items())) )