# File:    Arduino.py
# Project: CSCE 315 Project 1, Spring 2018
# Author:  Ryan Garmeson
# Date:    2018-02-24
# Section: 0504
# E-mail:  ryanalexandria@tamu.edu 

#!/usr/bin/python

from database import *

class ArduinoInteract:
    # TODO: implement
    def connect(self):
        return 12345
    # TODO: implement
    def read(self):
        return DbEntry(1,2)
    # TODO: implement
    def check_error_codes(self):
        return False
    # Pre-condition: self exists
    # Post-condition: returns current _handle member
    def get_handle(self):
        return self.handle
    # TODO: implement fully
    def __init__(self):
        self._handle = self.connect()