from MySQL import *
from Software import *
import json


class DB(object):
    def __init__(self):
        # Init Database Connection.
        self.db = MySQL()
        self.db.connect()

    def getSoftware(self,id=None,name=None):
        # Function for getting information for a specific software.

        if id != None:
            sql = """SELECT * FROM `softwares` WHERE ID = {}""".format(id)

        elif name!= None:
            sql = """SELECT * FROM `softwares` WHERE Name = {}""".format(name)
        else:
            sql = """SELECT * FROM `softwares`"""

        result = self.db.select(sql)
        resultSet = [Software(item[0],item[1],item[2],item[3]) for item in result]

        return resultSet

    def getChangelogIDs(self,softwareID):
        # Get all ids for a single software.
        sql = """SELECT ID FROM `data` WHERE SoftwareID = """ + str(softwareID)
        selectResults = self.db.select(sql)
        resultSet = [item[0] for item in selectResults]
        return resultSet

    def addChangelog(self,softwareID,changelog):
        # add a piece of changelog to database.
        id = changelog['id']
        verison = changelog['version']
        time = changelog['time']
        content = json.dumps(changelog['content'])

        sql = """INSERT INTO data (`ID`, `SoftwareID`, `Time`, `Version`, `Detail`) VALUES (%s, %s, %s, %s, %s)"""
        self.db.insert(sql,(id,softwareID,time,verison,content))

    def getSMSSubscribers(self,softwareID):
        # Get the list of all SMS subscribers for specific software.
        sql = """SELECT phone FROM `phone` WHERE softwareID =""" + str(softwareID)
        selectResults = self.db.select(sql)
        resultSet = [item[0] for item in selectResults]
        return resultSet

    def getEmailSubscribers(self,softwareID):
        # Get the list of all Email subscribers for specific software.
        sql = """SELECT email FROM `email` WHERE softwareID =""" + str(softwareID)
        selectResults = self.db.select(sql)
        resultSet = [item[0] for item in selectResults]
        return resultSet

    def addChangelogs(self,softwareID,changelogs):
        # Add a list of changelogs to the database.
        params = [(changelog['id'],
                   softwareID,
                   changelog['time'],
                   changelog['version'],
                   json.dumps(changelog['content']))
                  for changelog in changelogs]

        sql = """INSERT INTO data (`ID`, `SoftwareID`, `Time`, `Version`, `Detail`) VALUES (%s, %s, %s, %s, %s)"""
        self.db.insertMany(sql,params)

    def __del__(self):
        self.db.close()

if __name__ == '__main__':
    db = DB()
    print(db.getSMSSubscribers(5))