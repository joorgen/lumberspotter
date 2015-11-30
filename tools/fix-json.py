#!/usr/bin/python
# -*- coding: utf-8 -*-

import sys,re

lines = sys.stdin.readlines()

for i in range( len(lines) ):
	lines[i] = re.sub( r'(:\d+),(\d+,)', r'\1.\2', lines[i] )
	lines[i] = re.sub( r'( \([а-яА-Я]+\))',r'',lines[i] )
	sys.stdout.write(lines[i])