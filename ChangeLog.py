import hashlib
class ChangeLog(object):
    def __init__(self,Time,Version,Detail):
        self.Time = Time
        self.Version = Version
        self.Detail = Detail
        self.getID()

    def getID(self):
        m = hashlib.md5()
        m.update((self.Time+self.Version+self.Detail).encode('UTF-8'))
        self.id = m.hexdigest()
        return m.hexdigest()

    def __eq__(self, other):
        return self.getID() == other.getID()


if __name__ == '__main__':
    a = ChangeLog("2019-04-01","0.0.1","No")
    b = ChangeLog("2019-04-01","0.0.1","No")

    print(a==b)