from constants import BASELINE, ERRTOL

def checkarr(arr):
	count = 0
	for x in arr:
		if x > 0 and x < BASELINE:
			count += 1
	return count > (len(arr) * (1-ERRTOL))

def checkdata(num):
	return num > 0 and num < BASELINE