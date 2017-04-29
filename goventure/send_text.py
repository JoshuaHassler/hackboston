from twilio.rest import Client
account_sid = 'AC534ccef182c5e4b4efbbc315a44bbed3'
auth_token = 'e505be28ef55d8fa15f158e6af95774b'
client = Client(account_sid, auth_token)
message = client.messages.create(
    to="+17743137029",
    from_="+16176525131",
    body="This is an automated message"
)

print(message.sid)