#!/usr/bin/python

import serial
import time
import socket
from threading import Thread
import json

ser = serial.Serial("COM8",115200)
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
			print('send successfully')
			return 1
		else:
			print('error')
			return 0
	else:
		print('error%d'%answer)
		return 0

def on_new_client(c_socket, c_addr):
	while True:
		request = c_socket.recv(1024)
		request = request.decode("utf-8") # convert bytes to string

		if request.lower() == "close":
			c_socket.send("closed".encode("utf-8"))
			break
		
		#AT command
		print(f"Received: {request}")
		reqObj = json.loads(request)
		if reqObj["action"] == "sms":
			if SendShortMessage(reqObj["phone"],reqObj["msg"]) == 1:
				response = "success".encode("utf-8")
				c_socket.send(response)
			else:
				response = "fail".encode("utf-8")
				c_socket.send(response)

	c_socket.close()
	print(f"Connection to client closed:{c_addr[0]}:{c_addr[1]}")

def run_server():
	server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	server_ip = "localhost"
	port = 1987
	server.bind((server_ip, port))
	server.listen(0)
	print(f"SMS gateway listening on {server_ip}:{port}")
	
	# waiting for a client
	while True:
		client_socket, client_address = server.accept()
		print(f"Connection from {client_address[0]}:{client_address[1]}")
		# on_new_client(client_socket, client_address)
		thread = Thread(target=on_new_client, args=(client_socket, client_address))
		thread.start()

	server.close()
	ser.close()

run_server()