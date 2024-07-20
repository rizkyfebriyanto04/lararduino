<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NodeMCU Data</title>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
</head>
<body>
    <h1>NodeMCU Data</h1>
    <div id="data"></div>

    <script>
        const socket = io('http://localhost:3000');  // Ensure this matches the server URL

        socket.on('connect', () => {
            console.log('Connected to Socket.io server');
        });

        socket.on('serialData', function (data) {
            document.getElementById('data').innerText = data;  // Update the HTML content
        });

        socket.on('disconnect', () => {
            console.log('Disconnected from Socket.io server');
        });

        socket.on('connect_error', (error) => {
            console.error('Connection Error:', error);
        });
    </script>
</body>
</html>
