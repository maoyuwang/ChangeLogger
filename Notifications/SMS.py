from twilio.rest import Client
from config import *


def send(tophone, content):
	client = Client(SMS_ACCOUNT_ID, SMS_AUTH_TOKEN)
	tophone = "+1" + tophone
	client.messages.create(
		to=tophone,
		from_="+12068098077",
		body=content)

if __name__ == '__main__':
	testing_phone_num = "+1123123123213"
	content = "This is a testing message."
	send(testing_phone_num, content)