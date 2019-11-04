# For SDD Interim Release Demo

from Parsers import *
from dataFilter import *
from cron import idLabler

# Sprint 1 Show Parsers Data

# parser = Nodejs10.NodeJS10()
# parser.start()
# parser.join()
# print(parser.getResult())

# Sprint 2 Only show the filtered data that doesn't exist in database.
parser = testSoftware.testSoftware()
parser.start()
parser.join()
parserResult = json.loads(parser.getResult())

print("Before Label ->\n\t",parserResult)
labledResult = idLabler(parserResult)
print("After Label ->\n\t",labledResult)

mydataFilter = dataFilter(softwareID=99)
filterResult = mydataFilter.filter(labledResult)

print("After Filter ->\n\t",filterResult)