#!/usr/bin/python
import serial	#pip install pyserial
import threading as th
import time
import mysql.connector
import os

ser = serial.Serial("COM15",115200)
ser.flushInput()
rec_buff = ''
isConfig = False

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
		try:
			print('Running:' + time.strftime('%H:%M:%S'))
			mydb = mysql.connector.connect(
				host="202.131.4.21",
				user="zarchimn_99213557",
				password="m?OzHo6&&~w$",
				database="zarchimn_smsapi"
			)
			mycursor = mydb.cursor()
			mycursor.execute("SELECT * FROM action AS a LEFT JOIN apikey AS k ON a.token=k.token WHERE a.state=0 AND k.credit>=1 ORDER BY a.id ASC")
			myresult = mycursor.fetchall()

			for x in myresult:
				#print(x)
				print(x[5])	#token
				print(x[2])	#phone
				print(x[3])	#msg
				msgState = "waiting"
				if SendShortMessage(x[2],x[3]) == 1:
					mycursor.execute("UPDATE apikey SET credit=credit-1 WHERE token='"+x[5]+"'")
					mydb.commit()
					mycursor.execute("UPDATE action SET state=1, sent=DATE_FORMAT(NOW(), '%Y-%m-%d %H:%i:%s') WHERE id="+str(x[0]))
					mydb.commit()
					msgState = "sent"
				else:
					print("Sending SMS failed!")
					mycursor.execute("UPDATE action SET state=2 WHERE id="+str(x[0]))
					mydb.commit()
					msgState = "error"
				f = open("smsapi_report.txt", "a")
				f.write(x[2]+", "+x[3]+", "+x[5]+", "+msgState+"\r\n")
				f.close()
				print("================================")

			time.sleep(10)
			os.system('cls')

		except:
			# SendShortMessage("99213557","sms_gateway.py crash")
			# f = open("smsapi_report.txt", "a")
			# f.write("sms_gateway crash\r\n")
			# f.close()
			# ser.close()
			print("sms_gateway crash")
			time.sleep(10)
			os.system('cls')

def run_client():
	t = th.Thread(target=run_sender)
	t.start()

run_client()