from threading import Thread
from Parsers.Common import *
class Parser(Thread):
    def __init__(self):
        """
        Initialize a Parser thread.
        """
        Thread.__init__(self)
        self.deamon = True
        self.result = None

    def run(self):
        """
        Details on thread running.
        """
        self.result = self.parse()

    def parse(self):
        """
        Specific parse method to be override.
        """
        pass

    def getResult(self):
        """
        Return the result after the Parser finnish running.
        :return:
        """
        return self.result

    def __str__(self):
        return getFormattedString(self.result)

if __name__ == '__main__':
    p = Parser()
    p.start()

    p.join()
    print(p.getResult())


