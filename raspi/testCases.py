'''*****************************************
** File:    testCases.py
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    03/01/18
** Section: 504
** E-mail:  dominick@tamu.edu
**
**   This file contains all of the functions that test the
** functions found in serverConnect.py.
**
***********************************************'''

from serverConnect import *

# Note: uses global variables defined in serverConnect.py

def test_sendWebserverPing(host, path, secretKey):
    ''' TODO: document and implement '''

    badSecretKey = 'invalidKey'

    testCond = True

    # try to ping server with the correct key
    testCond = testCond and (sendWebserverPing(host, path, secretKey) == 1)

    # try to ping server with an incorrect key
    testCond = testCond and (sendWebserverPing(host, path, badSecretKey) == 0)

    return testCond

def test_isSuccessfulPing():
    ''' TODO: document and implement '''

    testCond = True

    return testCond

def testAll():
    ''' This function runs all of the above tests. '''

    test_sendWebserverPing(host, path, secretKey)
    test_isSuccessfulPing()

testAll()
