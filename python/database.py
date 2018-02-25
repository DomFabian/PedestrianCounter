# File:    database.py
# Project: CSCE 315 Project 1, Spring 2018
# Author:  Ryan Garmeson
# Date:    2018-02-24
# Section: 0504
# E-mail:  ryanalexandria@tamu.edu 

#!/usr/bin/python

class DbEntry:
    # Pre-condition: n and t are reasonable data type (TODO: implement)
    # Post-condition: DbEntry exists
    def __init__(self, n, t):
        self.count = n
        self.time = t

# Truthfully I believe that this class will be unnecessary by the time our real
# code is up and running but for now we will keep it. It may become a wrapper 
# class in the future.
class DB:
    # TODO: implement
    def send(self, data):
        self.size = self.size + 1
        return True
    # TODO: implement fully
    def __init__(self):
        self.size = 0
