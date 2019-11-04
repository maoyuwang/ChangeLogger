# a data structure for storing software information.
class Software(object):
    def __init__(self,ID,Name,Description,Icon):
        self.ID = ID
        self.Name = Name
        self.Description = Description
        self.Icon = Icon

    def __eq__(self, other):
        return self.ID == other.ID and \
        self.Name == other.Name and \
        self.Description == other.Description and \
        self.Icon == other.Icon

    def __str__(self):
        string = "ID:\t{}\nNAME:\t{}\nIcon:\t{}".format(self.ID,self.Name,self.Icon)
        return string