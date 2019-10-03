from config import *
import pymysql

class MySQL():
    def __init__(self):
        self.conn = None

    def connect(self):
        self.conn=pymysql.connect(host=DB_HOST, port=DB_PORT, user=DB_USER, password=DB_PASSWD,database=DB_NAME)

    def close(self):
        self.conn.close()

    def select(self,query):
        cursor = self.conn.cursor()
        cursor.execute(query)
        return cursor.fetchall()

    def insert(self,query):
        try:
            cursor = self.conn.cursor()
            cursor.execute(query)
            self.conn.commit()
        except:
            self.conn.rollback()


if __name__ == '__main__':
    db = MySQL()
    db.connect()
    ret = db.select("""SELECT * FROM softwares""")

    print(ret)
    db.close()


