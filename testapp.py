from unicodedata import numeric
from flask import Flask, render_template, request, redirect, url_for, session
from flask_socketio import SocketIO, emit, join_room, leave_room
import pickle
import numpy as np
import os
import sys
from serpapi import GoogleSearch
from linkedin_api import Linkedin
import MySQLdb 

from engineio.payload import Payload
Payload.max_decode_packets = 200

app = Flask(__name__)


socketio = SocketIO(app)


_users_in_room = {} # stores room wise user list
_room_of_sid = {} # stores room joined by an used
_name_of_sid = {} # stores display name of users
app = Flask(__name__)

arr=[]
arr2=[]
arr3=[]
arr4=[]

db = MySQLdb.connect("localhost", "root", "", "my_db") 
curs=db.cursor() 

# for x in reading:
#   print(x[1])


@app.route("/start-chat", methods=["GET", "POST"])
def index():
    if request.method == "POST":
        room_id = request.form['room_id']
        return redirect(url_for("entry_checkpoint", room_id=room_id))

    return render_template("startchat.html")

@app.route("/room/<string:room_id>/")
def enter_room(room_id):
    if room_id not in session:
        return redirect(url_for("entry_checkpoint", room_id=room_id))
    return render_template("chatroom.html", room_id=room_id, display_name=session[room_id]["name"], mute_audio=session[room_id]["mute_audio"], mute_video=session[room_id]["mute_video"])

@app.route("/room/<string:room_id>/checkpoint/", methods=["GET", "POST"])
def entry_checkpoint(room_id):
    if request.method == "POST":
        display_name = request.form['display_name']
        mute_audio = request.form['mute_audio']
        mute_video = request.form['mute_video']
        session[room_id] = {"name": display_name, "mute_audio":mute_audio, "mute_video":mute_video}
        return redirect(url_for("enter_room", room_id=room_id))

    return render_template("chatroom_checkpoint.html", room_id=room_id)
    


@socketio.on("connect")
def on_connect():
    sid = request.sid
    print("New socket connected ", sid)
    

@socketio.on("join-room")
def on_join_room(data):
    sid = request.sid
    room_id = data["room_id"]
    display_name = session[room_id]["name"]
    
    # register sid to the room
    join_room(room_id)
    _room_of_sid[sid] = room_id
    _name_of_sid[sid] = display_name
    
    # broadcast to others in the room
    print("[{}] New member joined: {}<{}>".format(room_id, display_name, sid))
    emit("user-connect", {"sid": sid, "name": display_name}, broadcast=True, include_self=False, room=room_id)
    
    # add to user list maintained on server
    if room_id not in _users_in_room:
        _users_in_room[room_id] = [sid]
        emit("user-list", {"my_id": sid}) # send own id only
    else:
        usrlist = {u_id:_name_of_sid[u_id] for u_id in _users_in_room[room_id]}
        emit("user-list", {"list": usrlist, "my_id": sid}) # send list of existing users to the new member
        _users_in_room[room_id].append(sid) # add new member to user list maintained on server

    print("\nusers: ", _users_in_room, "\n")


@socketio.on("disconnect")
def on_disconnect():
    sid = request.sid
    room_id = _room_of_sid[sid]
    display_name = _name_of_sid[sid]

    print("[{}] Member left: {}<{}>".format(room_id, display_name, sid))
    emit("user-disconnect", {"sid": sid}, broadcast=True, include_self=False, room=room_id)

    _users_in_room[room_id].remove(sid)
    if len(_users_in_room[room_id]) == 0:
        _users_in_room.pop(room_id)

    _room_of_sid.pop(sid)
    _name_of_sid.pop(sid)

    print("\nusers: ", _users_in_room, "\n")


@socketio.on("data")
def on_data(data):
    sender_sid = data['sender_id']
    target_sid = data['target_id']
    if sender_sid != request.sid:
        print("[Not supposed to happen!] request.sid and sender_id don't match!!!")

    if data["type"] != "new-ice-candidate":
        print('{} message from {} to {}'.format(data["type"], sender_sid, target_sid))
    socketio.emit('data', data, room=target_sid)

@app.route('/')
def career():

    return render_template("hometest.html")


@app.route('/consultancy')
def consult():
   
    curs.execute("SELECT * from expert")
    reading = curs.fetchall()
    return render_template("consult.php",reading=reading)

@app.route('/success')
def success():
   
    curs.execute("SELECT * from expert")
    reading = curs.fetchall()
    return render_template("success.html",reading=reading)

@app.route('/course',methods = ['GET','POST'])
def course():
        
        print(request.form['uname'] ) 
     
         
        params = {
        "engine": "youtube",
        "search_query": request.form['uname'],
        "api_key": "cc4ba943df81762776768d759de4429d37f0533eef3b713082f11da66d572be5"
        }
        params2 = {
            "engine": "google",
            "q": request.form['uname'],
            "api_key": "cc4ba943df81762776768d759de4429d37f0533eef3b713082f11da66d572be5"
            }

        search2 = GoogleSearch(params2)
        results2 = search2.get_dict()
        # print(results2["organic_results"])
        arr.clear()

        for link in results2['organic_results']:
            arr.append({"Title":link['title'],"Link": link['link'],"Snip":link['snippet']})

        search = GoogleSearch(params)
        results = search.get_dict()
        arr2.clear()
        for link in results['video_results']:
            arr2.append({"Title":link['title'],"Img": link['thumbnail']['static'], "Link":link['link']})
            
        # print(arr)

        params3 = {
            "engine": "google_jobs",
            "q": request.form['uname'],
            "hl": "en",
            "api_key": "cc4ba943df81762776768d759de4429d37f0533eef3b713082f11da66d572be5"
            }
        search3 = GoogleSearch(params3)
        results3 = search3.get_dict()
        # jobs_results3 = results3["jobs_results"]
        arr3.clear()
        for link in results3['jobs_results']:
           
            arr3.append({"Title":link['title'],"Company":link['company_name'],"Descp":link['description']})
            # print({"Title":link['title'],"Company":link['company_name']})

        # params4 = {
        # "engine": "google_trends",
        # "q": request.form['uname'] ,
        # "data_type": "TIMESERIES",
        # "api_key": "cc4ba943df81762776768d759de4429d37f0533eef3b713082f11da66d572be5"
        # }

        # search4 = GoogleSearch(params4)
        # results4 = search4.get_dict()
        # print(results4['interest_over_time']['timeline_data'])
        # x=results4['interest_over_time']['timeline_data']
 
        
        return render_template("courses.html",arr2=arr2,j=request.form['uname'],arr=arr,arr3=arr3)


@app.route('/predict',methods = ['POST', 'GET'])
def result():
   if request.method == 'POST':
      result = request.form
      i = 0
      print(result) 
      res = result.to_dict(flat=True)
      print("res:",res)
      arr1 = res.values()
      arr = ([value for value in arr1])

      data = np.array(arr,dtype=int)

      data = data.reshape(1,-1)
      print(data)
      loaded_model = pickle.load(open("careerlast.pkl", 'rb'))
      predictions = loaded_model.predict(data)
     # return render_template('testafter.html',a=predictions)
      
      print(predictions)
      pred = loaded_model.predict_proba(data)
      print(pred)
      #acc=accuracy_score(pred,)
      pred = pred > 0.05
      #print(predictions)
      i = 0
      j = 0
      index = 0
      res = {}
      final_res = {}
      while j < 17:
          if pred[i, j]:
              res[index] = j
              index += 1
          j += 1
      # print(j)
      #print(res)
      index = 0
      for key, values in res.items():
          if values != predictions[0]:
              final_res[index] = values
              print('final_res[index]:',final_res[index])
              index += 1
      #print(final_res)
      jobs_dict = {0:'AI ML Specialist',
                   1:'API Integration Specialist',
                   2:'Application Support Engineer',
                   3:'Business Analyst',
                   4:'Customer Service Executive',
                   5:'Cyber Security Specialist',
                   6:'Data Scientist',
                   7:'Database Administrator',
                   8:'Graphics Designer',
                   9:'Hardware Engineer',
                   10:'Helpdesk Engineer',
                   11:'Information Security Specialist',
                   12:'Networking Engineer',
                   13:'Project Manager',
                   14:'Software Developer',
                   15:'Software Tester',
                   16:'Technical Writer'}
                
      #print(jobs_dict[predictions[0]])
      job = {}
      #job[0] = jobs_dict[predictions[0]]
      index = 1
     
        
      data1=predictions[0]
      print(data1)
      return render_template("testafter.html",final_res=final_res,job_dict=jobs_dict,job0=data1)
      
if __name__ == '__main__':
   app.run(debug = True)
   app.config['SECRET_KEY'] = 'AJDJRJS24$($(#$$33--'
   socketio.run(app, debug=True)

