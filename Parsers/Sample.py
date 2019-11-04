#!/usr/bin/python
# -*- coding: utf-8 -*-
from Parsers.Parser import *
# Copy this example to start a new parser.
class Sample(Parser):
    def parse(self):
        # The detailed instructs for parsing a web page.
        return getJSONStr([{'version':"0.0.1",'time':"2019-09-09",'content':["Create project Changelogger."]}])

if __name__ == '__main__':
    # For testing usage.
    testSample = Sample()
    testSample.start()
    testSample.join()
    print(testSample)
