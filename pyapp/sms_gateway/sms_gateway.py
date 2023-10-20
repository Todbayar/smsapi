#!/usr/bin/python

import serial
import time
import sys
import socket

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
		else:
			print('error')
	else:
		print('error%d'%answer)

def run_server():
	server = socket.socket(socket.AF_INET, socket.SOCK_STREAM)
	server_ip = "127.0.0.1"
	port = 1987
	server.bind((server_ip, port))
	server.listen(0)
	print(f"SMS gateway listening on {server_ip}:{port}")
	
	# waiting for a client
	client_socket, client_address = server.accept()
	print(f"Accepted connection from {client_address[0]}:{client_address[1]}")
	
	while True:
		request = client_socket.recv(1024)
		request = request.decode("utf-8") # convert bytes to string
		if request.lower() == "close":
			client_socket.send("closed".encode("utf-8"))
			break
		
		
		print(f"Received: {request}")	#here must be AT command
		
		response = "accepted".encode("utf-8")
		client_socket.send(response)

	client_socket.close()
	print("Connection to client closed")
	server.close()

run_server()

# try:
	# SendShortMessage("99213557","hello world, this is from py.")

# except :
#     ser.close()