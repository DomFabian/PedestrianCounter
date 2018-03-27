'''*****************************************
** File:    dump2.py
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Ryan Garmeson
** Date:    03/24/18
** Section: 504
** E-mail:  ryanalexandria@tamu.edu
**
**   This is a dump file I'm using to work on the implementation of pymata
**   logic.
** 3/24 abandoned pyfirmata due to lack of support for hc-sr04
** 3/25 abandoned pymata-aio due to confusing documentation and weird delays
** 3/26 using pymata gen 1 in hopes of being simple enough to use correctly.
** 3/26 possible concern: pymata might only support 1 sensor
**
***********************************************'''

import time
import sys
import signal

from PyMata.pymata import PyMata

# create a PyMata instance
board = PyMata("COM6", verbose=True)

# you may need to press ctrl c twice
def signal_handler(sig, frame):
	print('You pressed Ctrl+C')
	if board is not None:
		board.reset()
		board.close()
	sys.exit(0)

signal.signal(signal.SIGINT, signal_handler)

# Configure the trigger and echo pins
board.sonar_config(2, 2)

time.sleep(1)

# Create a forever loop that will print out the sonar data for the PING device

while 1:
	data = board.get_sonar_data()
	print(str(data[2]) + ' centimeters')
	time.sleep(.05)