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

# Note: uses global variables defined in serverConnect.py:
#       - host
#       - path
#       - secretKey

def test_sendWebserverPing(host, path, secretKey):
    ''' This function tests the sendWebserverPing() function
        using the global variables declared in the serverConnect.py
        file. It takes the same three parameters as the actual
        sendWebserverPing() function. '''

    badSecretKey = 'invalidKey'

    testCond = True

    # try to ping server with the correct key
    testCond = testCond and (sendWebserverPing(host, path, secretKey) == 1)

    # try to ping server with an incorrect key
    testCond = testCond and (sendWebserverPing(host, path, badSecretKey) == 0)

    return testCond

def test_isSuccessfulPing():
    ''' This function tests the isSuccessfulPing() function by using
        three test strings. '''

    # should yield True
    testResponse1 = '''This is a filler string that\nis formatted weirdly\tbut
                       should still\n yield a success'''

    # should yield False
    testResponse2 = '''howdy howdy howdy this is a string that\n\n\n\n\n\n
                       will not yield a success because it is a failure'''

    # should yield False
    testResponse3 = '''\t\t\n This is a string that should show that the function
                       defaults to a failure case\n'''

    testCond = True

    testCond = testCond and (isSuccessfulPing(testResponse1) == True)
    testCond = testCond and (isSuccessfulPing(testResponse2) == False)
    testCond = testCond and (isSuccessfulPing(testResponse3) == False)

    return testCond

def testAll():
    ''' This function runs all of the above tests using global variables
        defined in serverConnect.py. '''

    test_sendWebserverPing(host, path, secretKey)
    test_isSuccessfulPing()

testAll()
