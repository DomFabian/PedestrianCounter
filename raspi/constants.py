# set to ports the sensors are plugged to.
# SENSOR1 should be the outside-most sensor
SENSOR1 = 2
SENSOR2 = 4

# BASELINE should be slightly (2-3) lower than what the sensor reports with 
# no inputs
# RECORDSIZE is to specify the band of sight and to mitigate false positives
# from hardware errors. Choose wisely.
# ERRTOL declares what % of the recent record may be an error and still count
# as a valid reading. Does not need to be low unless readings are taken in long 
# intervals. They are currently set to once per millisecond.
BASELINE = 200
RECORDSIZE = 10
ERRTOL = .25

# TIMETOL should be set to be tolerant of a person walking average speed.
# at 10mph, an object takes 34 ms to cross both sensors.
# at 1mph, an object takes 340 ms to cross both sensors.
# The average person walks at 3mph, and their legs will move faster than that.
TIMETOL = 5

# SLEEPDELAY should be long enough to not ping the same person twice and short
# enough to catch the person behind them.
SLEEPDELAY = 0.1

# PORT is the port the arduino is plugged into.
PORT = "/dev/ttyACM0"