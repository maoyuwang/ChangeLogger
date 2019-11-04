from Queue import Queue
from Notifications import SMS
from Notifications import Email
import json
def emailQueue():
    # Process email notification queue.
    q = Queue("email")
    while(len(q)!=0):
        msg = json.loads(q.get())
        address = msg['address']
        subject = msg['subject']
        content = msg['content']
        Email.send(address,subject,content)
        print((address,subject,content))

def smsQueue():
    # Process SMS notification queue.
    q = Queue("sms")
    while (len(q) != 0):
        msg = json.loads(q.get())
        address = msg['address']
        content = msg['content']
        SMS.send(address,content)
        print((address,content))

if __name__ == '__main__':
    emailQueue()
    smsQueue()