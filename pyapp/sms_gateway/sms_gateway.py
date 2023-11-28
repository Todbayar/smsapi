#!/usr/bin/python
import serial	#pip install pyserial
import threading as th  
from threading import Timer  
import time
import mysql.connector


ser = serial.Serial("COM9",115200)
ser.flushInput()
rec_buff = ''
isConfig = False

mydb = mysql.connector.connect(
		host="202.131.4.21",
		user="zarchimn_99213557",
		password="m?OzHo6&&~w$",
		database="zarchimn_smsapi"
	)

def send_at(command,back,timeout):
	rec_buff = ''
	ser.write((command+'\r\n').encode())
	time.sleep(timeout)
	if ser.inWaiting():
		time.sleep(0.01 )
		rec_buff = ser.read(ser.inWaiting())
	if back not in rec_buff.decode():
		print(command + ' ERROR')
		print(command + ' back:\t' + rec_buff.decode())
		return 0
	else:
		print(rec_buff.decode())
		return 1

def SendShortMessage(phone_number,text_message):
	print("Setting SMS mode...")
	send_at("AT+CMGF=1","OK",1)
	print("Sending Short Message")
	answer = send_at("AT+CMGS=\""+phone_number+"\"",">",2)
	if 1 == answer:
		ser.write(text_message.encode())
		ser.write(b'\x1A')
		answer = send_at('','OK',5)
		if 1 == answer:
			print('send msg successfully')
			return 1
		else:
			print('error')
			return 0
	else:
		print('error%d'%answer)
		return 0

def run_sender():
	while True:
		print('Sending:' + time.strftime('%H:%M:%S'))
		mycursor = mydb.cursor()
		mycursor.execute("SELECT * FROM action AS a LEFT JOIN apikey AS k ON a.token=k.token WHERE a.state=0 AND k.credit>=1")
		myresult = mycursor.fetchall()

		for x in myresult:
			#print(x)
			print(x[2])	#phone
			print(x[3])	#msg
			print(x[5])	#token
			if SendShortMessage(x[2],x[3]) == 1:
				mycursor.execute("UPDATE apikey SET credit=credit-1 WHERE token='"+x[5]+"'")
				mydb.commit()
				mycursor.execute("UPDATE action SET state=1 WHERE id="+str(x[0]))
				mydb.commit()
			else:
				print("Sending SMS failed!")

		time.sleep(15)

	#ser.close()

def run_client():
	t = th.Thread(target=run_sender)
	t.start()

run_client()