

import os
import MySQLdb
import time
import datetime

from flask import Flask, request, redirect
from twilio.twiml.messaging_response import MessagingResponse

app = Flask(__name__)

@app.route("/sms", methods=['GET', 'POST'])
def sms_reply():
    """Handle user replies to call for an uber and to
    postpone the start time of the next event."""
    body = request.values.get('Body', None)

    resp = MessagingResponse()

    if body.startswith("p") or body.startswith("P"):
        resp.message("Okay, your next event has been postponed 15 minutes.")
        add_15_minutes_to_start_time_of_next_events()
    elif body.startswith("u") or body.startswith("U"):
        resp.message("Okay, an uber is being called to your location. Buckle up!")
    else:
        resp.message("The Robots are coming! Head for the Hills!")

    return str(resp)


def add_15_minutes_to_start_time_of_next_events():
    current_time = datetime.datetime.strptime("2017-05-06 15:50:00", "%Y-%m-%d %H:%M:%S")
    db = MySQLdb.connect("localhost", "testuser", "test123", "GO_VENTR_DB")
    cursor = db.cursor()
    """For each adventure, find event with
    the earliest start time greater than the current time.
    This is the next event. Increment event start time by 15 minutes
    and set started to false."""
    active_adventure_sql = "SELECT * FROM ADVENTURES WHERE ACTIVE = 1"
    cursor.execute(active_adventure_sql)
    for active_adventure in cursor.fetchall():
        adventure_id = active_adventure[0]
        adventure_name = active_adventure[2]
        # Get list of events
        active_event_sql = "SELECT * FROM EVENTS WHERE ADVENTURE_ID = %s ORDER BY START_TIME" % (adventure_id)
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
            if total_seconds > 0: # Event hasn't started
                print active_event
                # Write to database
                add_15_min_sql = "UPDATE EVENTS SET START_TIME=START_TIME + INTERVAL 15 MINUTE WHERE ID = %s" % (event_id)
                cursor.execute(add_15_min_sql)
                db.commit()
                return



if __name__ == "__main__":
    app.run(debug=True)