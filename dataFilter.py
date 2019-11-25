from db import *
class dataFilter(object):
    """
    Filter the data that doesn't exist in the database before.
    """
    def __init__(self,softwareID):
        self.softwareID = softwareID

    def filter(self,l):
        """
        Do filter job.
        :param l: The list of data to filter.
        :return: The list of data that doesn't exist in the database.
        """
        db = DB()
        IDs = db.getChangelogIDs(self.softwareID)
        return [changelog for changelog in l if changelog['id'] not in IDs]