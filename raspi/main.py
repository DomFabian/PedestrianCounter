# This program is after the nodeMCU is booted, if it exists.
# This is only run one time, unlike the loop() function in the
# Arduino IDE. So make sure that you have a main loop here.

import socket

def pingDB():
    host = 'projects.cse.tamu.edu'
    path = 'domfabian1/testCases.php'

    addr = socket.getaddrinfo(host, 80)[0][-1]

    s = socket.socket()
    s.connect(addr)
    s.send(bytes('POST /%s HTTP/1.0\r\nHost: %s\r\n\r\n' % (path, host), 'utf8'))

    while True:
        data = s.recv(100)
        if data:
            print(str(data, 'utf8'), end='')
        else:
            break
    s.close() 

pingDB()

