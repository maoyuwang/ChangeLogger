from MySQL import *
from Software import *

class DB(object):
    def __init__(self):
        self.db = MySQL()

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


if __name__ == '__main__':
    db = DB()
    r = db.getSoftware()
    print(r[0])