from MySQL import *
from Software import *
import json


class DB(object):
    def __init__(self):
        self.db = MySQL()
        self.db.connect()

    def getSoftware(self,id=None,name=None):


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
        sql = """SELECT ID FROM `data` WHERE SoftwareID = """ + str(softwareID)
        selectResults = self.db.select(sql)
        resultSet = [item[0] for item in selectResults]
        return resultSet

    def addChangelog(self,softwareID,changelog):
        id = changelog['id']
        verison = changelog['version']
        time = changelog['time']
        if time ==  None:
            time = "None"
        content = json.dumps(changelog['content'])

        sql = """INSERT INTO data (`ID`, `SoftwareID`, `Time`, `Version`, `Detail`) VALUES (%s, %s, %s, %s, %s)"""
        self.db.insert(sql,(id,softwareID,time,verison,content))

    def addChangelogs(self,softwareID,changelogs):
        params = [(changelog['id'],
                   softwareID,
                   changelog['version'],
                   changelog['time'] == None if "None" else changelog['time'],
                   json.dumps(changelog['content']))
                  for changelog in changelogs]

        sql = """INSERT INTO data (`ID`, `SoftwareID`, `Time`, `Version`, `Detail`) VALUES (%s, %s, %s, %s, %s)"""
        self.db.insertMany(sql,params)

    def __del__(self):
        self.db.close()
