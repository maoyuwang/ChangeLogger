from config import *
import pymysql
from pymysql.err import MySQLError

class MySQL():
    """
    The abstraction of operations to MySQL database.
    """
    def __init__(self):
        self.conn = None

    def connect(self):
        """
        Connect to the database.
        """
        self.conn=pymysql.connect(host=DB_HOST, port=DB_PORT, user=DB_USER, password=DB_PASSWD,database=DB_NAME)

    def close(self):
        """
        Close the connection.
        """
        self.conn.close()

    def select(self,query):
        """
        Do SELECT query.
        :param query: The SQL query to execute.
        :return: The result of executing the query.
        """
        cursor = self.conn.cursor()
        cursor.execute(query)
        return cursor.fetchall()

    def insert(self,query,data : tuple):
        """
        Deal with the INSERT/UPDATE/DELETE query.
        :param query: The query to execute.
        :param data: The data to include in the query.
        """
        try:
            cursor = self.conn.cursor()
            cursor.execute(query,data)
            self.conn.commit()
        except MySQLError as e:
            print(e)
            self.conn.rollback()

    def insertMany(self,query,data):
        """
        Insert a list of data to the database.
        :param query: The query command.
        :param data: The data to include in the query.
        """
        try:
            cursor = self.conn.cursor()
            cursor.executemany(query,data)
            self.conn.commit()
        except MySQLError as e:
            print(e)
            self.conn.rollback()


if __name__ == '__main__':
    db = MySQL()
    db.connect()
    ret = db.select("""SELECT * FROM softwares""")

    print(ret)
    db.close()


