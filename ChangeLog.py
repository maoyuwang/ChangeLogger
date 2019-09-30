class ChangeLog(object):
    def __init__(self,ID,Time,Version,Detail):
        self.ID = ID
        self.Time = Time
        self.Version = Version
        self.Detail = Detail

    def __eq__(self, other):
        return self.ID == other.ID\
               and self.Time == other.Time\
               and self.Version == other.Version\
               and self.Detail == other.Detail
