"""Copyright David Donahue 2017. When run, checks to see if user is ready for next event; texts user asking if they are ready for next event.
Extends duration of current event if user texts back implying they are not finished, or marks the current event as complete if user is finished. Basically, keeps track
of user progress through adventure. As user progresses, texts may include helpful guidance as to address of next event, or start time of next event, etc."""
import MySQLdb
import datetime
import time

from twilio.rest import Client
#
# print(message.sid)
account_sid = 'AC534ccef182c5e4b4efbbc315a44bbed3'
auth_token = 'e505be28ef55d8fa15f158e6af95774b'
client = Client(account_sid, auth_token)


def send_user_reminder_of_next_events_if_necessary(cursor):
    current_time = datetime.datetime.now() # .strftime("%Y-%m-%d %H:%M:%S")
    current_time = datetime.datetime.strptime("2017-05-06 15:50:00", "%Y-%m-%d %H:%M:%S")
    print current_time
    # Find current adventure
    active_adventure_sql = "SELECT * FROM ADVENTURES WHERE ACTIVE = 1"
    cursor.execute(active_adventure_sql)
    for active_adventure in cursor.fetchall():
        adventure_id = active_adventure[0]
        adventure_name = active_adventure[2]
        # Get list of events
        active_event_sql = "SELECT * FROM EVENTS WHERE ADVENTURE_ID = %s AND STARTED = 0" % (adventure_id)
        cursor.execute(active_event_sql)
        active_events = cursor.fetchall()
        # Determine if next non-started event is within 15 minutes away,
        # if so, shoot the user a reminder text with details of the event
        for active_event in active_events:
            event_time = active_event[2]
            event_id = active_event[0]
            time_to_event = event_time - current_time;
            print time_to_event
            total_seconds = time_to_event.total_seconds()
            if abs(total_seconds) < 15 * 60:
                print event_id
                print "The next event is 15 minutes away!"
                print active_event[6]
                message = client.messages.create(
                    to="+19788669891",
                    from_="+16176525131",
                    body="%s: The next event is 15 minutes away!" % adventure_name
                )
                event_started_sql = "UPDATE EVENTS SET STARTED=1 WHERE ID = %s" % (event_id)
                print event_started_sql
                cursor.execute(event_started_sql)
                db.commit()


db = MySQLdb.connect("localhost", "testuser", "test123", "GO_VENTR_DB")
cursor = db.cursor()

send_user_reminder_of_next_events_if_necessary(cursor)