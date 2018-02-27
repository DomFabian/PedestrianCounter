import socket

secretKey = 'ourSecretArduinoKey'
host = 'projects.cse.tamu.edu'
path = 'domfabian1/index.php'
payload = 'key=' + secretKey + '&submit=Submit+Query'

msg = ''
msg += ('POST /' + path + ' HTTP/1.1\r\n')
msg += ('Host: ' + host + '\r\n')
msg += 'Connection: close\r\n'
msg += 'Content-Type: application/x-www-form-urlencoded\r\n'
msg += ('Content-Length: ' + str(len(payload)) + '\r\n')
msg += '\r\n'
msg += payload


print(msg)
print()
print()

addr = socket.getaddrinfo(host, 80)[0][-1]

s = socket.socket()
s.connect(addr)
s.send(bytes(msg, 'utf8'))

while True:
    data = s.recv(100)
    if data:
        print(str(data, 'utf8'), end='')
    else:
        break
s.close() 
print()