from MySQL import *
from Software import *

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

    def addSoftware(self,s : Software):
        sql = """INSERT INTO `softwares` (`Name`, `Description`, `Icon`) VALUES ("{}","{}","{}")""".format(s.Name,s.Description,s.Icon)
        self.db.insert(sql)

    def __del__(self):
        self.db.close()



if __name__ == '__main__':
    db = DB()
    db.addSoftware(Software(1,"qqq","213","123123.png"))