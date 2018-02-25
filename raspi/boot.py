# This program is run when the nodeMCU is booted. This is
# only run one time, like the setup() function in the
# Arduino IDE.

def est_connection():
	''' Establishes a connection to Dominick's phone, which
		then forwards the data on to wherever '''

	import network

	sta_if = network.WLAN(network.STA_IF)

	if not sta_if.isconnected():
		print('Connecting to network')
		sta_if.active(True)									# turn on the interface
		sta_if.connect('Porygon2-Mobile', 'howdyhowdy')		# connect to the network

		while not sta_if.isconnected():
			pass

	print('Connection successful')
	print('Network Configuration:', sta_if.ifconfig())
