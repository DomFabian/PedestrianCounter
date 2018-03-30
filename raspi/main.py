import time
import sys
import signal

from constants import *
from board_setup import *
from util import *
from serverConnect import *

from PyMata.pymata import PyMata

s1record = [0 for i in range(RECORDSIZE)]
s2record = [0 for i in range(RECORDSIZE)]
s1data = 0
s2data = 0
idx = 0
pingloop = TIMETOL + 1

while 1:
	data = board.get_sonar_data()
	s1data = data[SENSOR1][1]
	s2data = data[SENSOR2][1]
	#print("I see : " + str(s1data) + " and " + str(s2data))
	#print("data grabbed")
	if checkdata(s1data) and checkarr(s1record):
		pingloop = 0
		#print(str(s1record))
		s1record = [0 for i in range(RECORDSIZE)]
		#print("inside first if")
	if checkdata(s2data) and checkarr(s2record):
		#print("inside second if")
		if pingloop < TIMETOL:
			#print(str(s2record))
			print("I see you!")
			sendWebserverPing(host, path, secretKey)
			s2record = [0 for i in range(RECORDSIZE)]
			pingloop += TIMETOL + 1
			time.sleep(SLEEPDELAY)
	#print("--------------------------")
	s1record[idx] = s1data
	s2record[idx] = s2data
	idx = (idx + 1) % RECORDSIZE
	pingloop += 1
	time.sleep(.001)