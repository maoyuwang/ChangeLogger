from sendgrid import SendGridAPIClient
from sendgrid.helpers.mail import Mail

from config import *


def send(toemail,subject,content):
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

