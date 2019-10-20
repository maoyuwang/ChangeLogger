from Queue import Queue
from Notifications import SMS
from Notifications import Email
def emailQueue():
    q = Queue("email")
    while(len(q)!=0):
        (address,subject,content) = q.pop()
        # Email.send(address,subject,content)
        print((address,subject,content))

def smsQueue():
    q = Queue("sms")
    while (len(q) != 0):
        (address, content) = q.pop()
        # SMS.send(address,content)
        print((address,content))

if __name__ == '__main__':
    emailQueue()
    smsQueue()