import time
import sys
import signal

from constants import PORT, SENSOR1, SENSOR2

from PyMata.pymata import PyMata

board = PyMata(PORT, verbose=True)

# you may need to press ctrl c twice
def signal_handler(sig, frame):
	print('You pressed Ctrl+C')
	if board is not None:
		board.reset()
		board.close()
	sys.exit(0)

signal.signal(signal.SIGINT, signal_handler)

# Configure the trigger and echo pins
board.sonar_config(SENSOR1, SENSOR1)
board.sonar_config(SENSOR2, SENSOR2)

time.sleep(1)