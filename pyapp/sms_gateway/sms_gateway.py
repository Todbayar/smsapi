#!/usr/bin/python
import serial	#pip install pyserial
import time
from threading import Thread
import json
import mysql.connector

ser = serial.Serial("COM9",115200)
ser.flushInput()
rec_buff = ''

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

def run_client():
	mydb = mysql.connector.connect(
		host="202.131.4.21",
		user="zarchimn_99213557",
		password="m?OzHo6&&~w$",
		database="zarchimn_smsapi"
	)

	mycursor = mydb.cursor()

	mycursor.execute("SELECT * FROM action WHERE state=0")

	myresult = mycursor.fetchall()

	for x in myresult:
		print(x[3])

	# send_at("AT","OK",1)
	#SendShortMessage("99213557","ene bol test msg...")
	# ser.close()

run_client()