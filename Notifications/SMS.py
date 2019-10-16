from twilio.rest import Client
from config import *

# put your own credentials here
account_sid = SMS_ACCOUNT_ID
auth_token = SMS_AUTH_TOKEN


def send(tophone, content):
	client = Client(account_sid, auth_token)

	client.messages.create(
		#the user's phone number
		to=tophone,
		from_="+12068098077",
		body=content)
		#media_url="https://climacons.herokuapp.com/clear.png")

if __name__ == '__main__':
	testing_phone_num = "+15189614472"
	content = "This is a testing message."
	send(testing_phone_num, content)