const { SerialPort } = require('serialport');
const { ReadlineParser } = require('@serialport/parser-readline');
const express = require('express');
const http = require('http');
const cors = require('cors');
const socketIo = require('socket.io');

const app = express();
const server = http.createServer(app);
const io = socketIo(server, {
  cors: {
    origin: "http://localhost:8000",  // Replace with the actual origin of your Laravel app
    methods: ["GET", "POST"],
    allowedHeaders: ["my-custom-header"],
    credentials: true
  }
});

app.use(cors({
  origin: "http://localhost:8000",  // Replace with the actual origin of your Laravel app
  methods: ["GET", "POST"],
  credentials: true
}));

const port = new SerialPort({ path: 'COM7', baudRate: 115200 });  // Adjust to your COM port
const parser = port.pipe(new ReadlineParser({ delimiter: '\n' }));

parser.on('data', data => {
  console.log(`Data received: ${data}`);
  io.emit('serialData', data);  // Send the data to connected clients
});

port.on('error', err => {
  console.log('Error: ', err.message);
});

server.listen(3000, () => {
  console.log('Socket.io server running on port 3000');
});
