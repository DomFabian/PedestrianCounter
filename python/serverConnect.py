'''*****************************************
** File:    serverConnect.py
** Project: CSCE 315 Project 1, Spring 2018
** Author:  Dominick Fabian
** Date:    03/01/18
** Section: 504
** E-mail:  dominick@tamu.edu 
**
**   This file contains the definition for the Common object, with its
** functions. It is used by any and all PHP files that need to connect
** to the PHPMyAdmin database for the 315 project 1.
**
***********************************************'''

import socket
from time import sleep

host = 'projects.cse.tamu.edu'
path = 'domfabian1/index.php'
secretKey = 'ourSecretArduinoKey'

def sendWebserverPing(host, path, secretKey):
    ''' This function takes three string parameters: 'host',
        'path', and 'secretKey'. 'host' represents the base
        URL of the webserver's domain name like "example.com".
        'path' represents the path on the domain that leads to
        the webserver like "about/info/page". 'secretKey' is the 
        secret Arduino key that insulates our database from any
        old person trying to insert into our database.
        sendWebserverPing() returns an integer as a status code:
        status code 0: failed to send message to the webserver.
        status code 1: successful message sent to webserver.
        Pre-conditions: socket library imported and time.sleep()
                        function imported.
        Post-conditions: database has one more entry in it than
                         before, corresponding to the message sent.
    '''

    payload = 'key=' + secretKey + '&submit=Submit+Query'

    # construct the HTTP POST request in proper format
    msg = ''
    msg += ('POST /' + path + ' HTTP/1.1\r\n')
    msg += ('Host: ' + host + '\r\n')
    msg += 'Connection: close\r\n'
    msg += 'Content-Type: application/x-www-form-urlencoded\r\n'
    msg += ('Content-Length: ' + str(len(payload)) + '\r\n')
    msg += '\r\n'
    msg += payload

    # get the IP address of the webserver
    addr = socket.getaddrinfo(host, 80)[0][-1]

    #instantiate socket
    s = socket.socket()

    # connect to the webserver at that IP address
    s.connect(addr)

    # send our crafted packet
    s.send(bytes(msg, 'utf8'))

    # sleep for one second while the server is responding
    sleep(1)

    # 200 bytes will always be large enough for our simple HTTP message
    numBytes = 200

    # receive the server's response
    serverResponse = s.recv(numBytes)

    # decode the byte message into string
    serverResponse = serverResponse.decode('utf8')

    # close the server connection
    s.close()




