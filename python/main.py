# File:    main.py
# Project: CSCE 315 Project 1, Spring 2018
# Author:  Ryan Garmeson
# Date:    2018-02-24
# Section: 0504
# E-mail:  ryanalexandria@tamu.edu 

#!/usr/bin/python

from database import *
from utility import *
from Arduino import *

# Precondition: uno has been instantiated
# Postcondition: returns whether uno correctly connected to the Uno
def test_connect_arduino():
    return hasattr(uno,'_handle')

# Precondition: uno has been instantiated, there is an available read stream
# Postcondition: returns whether data has been successfully sent to database
def test_send_db_entry():
    data = uno.read()
    size = dB.size
    dB.send(data)
    return size != dB.size

# Precondition: uno has been instantiated
# Postcondition: returns whether data is valid to send to database
def test_validate_data():
    data = uno.read()
    return validate_data(data)

# Precondition: uno has been instantiated, there is available read stream
# Postcondition: prints result of all test_ functions included in main.py
def test_all():
    print ("Test connect_arduino(): ", test_connect_arduino())
    print ("Test validate_data():   ", test_validate_data())
    print ("Test send_db_entry():   ", test_send_db_entry())

dB = DB()
uno = ArduinoInteract()
test_all()