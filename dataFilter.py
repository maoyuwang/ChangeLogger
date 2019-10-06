from db import *
class dataFilter(object):
    def __init__(self,softwareID):
        self.softwareID = softwareID
    def filter(self,l):
        db = DB()
        IDs = db.getChangelogIDs(self.softwareID)
        return [changelog for changelog in l if changelog['id'] not in IDs]