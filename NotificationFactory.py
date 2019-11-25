from Queue import Queue
from db import DB
import json


class NotificationFactory(object):
    """
    Create different types of notifications and append to the queue.
    """
    def __init__(self):
        self.db = DB()

        # Create two queues for storing notifications.
        self.emailQueue = Queue('email')
        self.smsQueue = Queue('sms')

    def add(self, softwareID, changelogs):
        # Add notification to both two queues.
        self.addEmailQueue(softwareID, changelogs)
        self.addSMSQueue(softwareID, changelogs)

    def addEmailQueue(self, softwareID, changeloggs):
        """
        Add notification to email queue.
        :param softwareID: The id of the software.
        :param changeloggs: The changelogs data.
        :return:
        """
        emails = self.db.getEmailSubscribers(softwareID)
        softwareName = self.db.getSoftware(id=softwareID)[0].Name
        for email in emails:
            for changelog in changeloggs:

                content = ""
                for item in changelog['content']:
                    content = content + "{}\n".format(item)
                content += "Unsubscribe: https://changelogger.org/unsubscribe.php?id={}&email={}".format(softwareID,email)

                subject = """{0} has new version {1}""".format(softwareName, changelog['version'])
                self.emailQueue.put(json.dumps({'address': str(email), 'subject': subject, 'content': content}))

    def addSMSQueue(self, softwareID, changeloggs):
        """
        Add the notification to the SMS queue.
        :param softwareID: The id of the software.
        :param changeloggs: The changelog data.
        :return:
        """
        phones = self.db.getSMSSubscribers(softwareID)
        softwareName = self.db.getSoftware(id=softwareID)[0].Name
        for phone in phones:
            for changelog in changeloggs:
                content = """{0} has updated to {1}""".format(softwareName, changelog['version'])
                self.smsQueue.put(json.dumps({'address': str(phone), 'content': content}))
