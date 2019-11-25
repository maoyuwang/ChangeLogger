from sendgrid import SendGridAPIClient
from sendgrid.helpers.mail import Mail

from config import *

def send(toemail,subject,content):
    """
    Send the notification to user via email
    :param toemail: The email address to receive the notification message.
    :param subject: The subject of the email.
    :param content: The content of the message.
    :return:
    """
    message = Mail(
        from_email=FROM_EMAIL,
        to_emails=toemail,
        subject=subject,
        html_content=content)
    try:
        sg = SendGridAPIClient(EMAIL_KEY)
        response = sg.send(message)
    except Exception as e:
        print(e)

