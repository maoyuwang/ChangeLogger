from Redis import redis

class Queue(object):
    def __init__(self,queueName):
        self.queueName = queueName
        self.db = redis()

    def __len__(self):
        return self.db.llen(self.queueName)

    def push(self,value):
        return self.db.rpushx(self.queueName,value)

    def pop(self):
        return self.db.lpop(self.queueName)

    
