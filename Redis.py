from redis import *
from config import *
from rq import Queue

class redis(object):
    def __init__(self):
        self.connect()

    def llen(self,key):
        return self.r.llen(key)

    def rpushx(self,key,value):
        return self.r.rpushx(key,value)

    def lpop(self,key):
        return self.r.lpop(key)

    def disconnect(self):
        self.r.close()


    def connect(self):
        try:
            self.r = Redis(host=REDIS_HOST, port=REDIS_PORT, db=REDIS_DB, password=REDIS_PASSWORD, charset='utf-8')
        except:
            print("Failed to connect to REDIS")

    def  __del__(self):
        self.r.close()




