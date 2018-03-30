'''*****************************************
** File:    util.py
** Project: CSCE 315 Project 1, Spring 2018
** Date:    03/31/18
** Section: 504
**
**   This file contains functions used in data validation for the HC-SR04 
**   hardware output signals returned by FirmataPlus firmata.
**
***********************************************'''

from constants import BASELINE, ERRTOL

''' This function handles ensuring data is valid.
        Pre-conditions: arr is an array, BASELINE is set appropriately.
        Post-conditions: returns boolean of whether or not data is valid'''
def checkarr(arr):
    count = 0
    for x in arr:
        if x > 0 and x < BASELINE:
            count += 1
    return count > (len(arr) * (1-ERRTOL))

''' This function handles deciding if data indicates a person is present.
        Pre-conditions: none
        Post-conditions: 
            returns boolean of if data indicates a person is present'''
def checkdata(num):
    return num > 0 and num < BASELINE