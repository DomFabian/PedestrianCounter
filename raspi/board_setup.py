'''*****************************************
** File:    board_setup.py
** Project: CSCE 315 Project 1, Spring 2018
** Date:    03/31/18
** Section: 504
**
**   This file contains setup information for the Arduino and its handlers
**
***********************************************'''

import time
import sys
import signal

from constants import PORT, SENSOR1, SENSOR2

from PyMata.pymata import PyMata

board = PyMata(PORT, verbose=True)

''' This function handles the ctrl+c end application call.
        Pre-conditions: none.
        Post-conditions: program has quit
        Source: https://github.com/MrYsLab/PyMata/'''
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