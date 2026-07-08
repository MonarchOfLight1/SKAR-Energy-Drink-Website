<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logging Out...</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            display: flex;
            justify-content: center; 
            align-items: center;     
            background: white;
            font-family: Arial, sans-serif;
        }

        #logoutBox {
            background: #0086C9;
            color: white;
            padding: 20px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 18px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
    </style>
</head>
<body>
    <div id="logoutBox">Logging out...</div>

    <script>
        // Call API to logout
        fetch('api/logout.php', {
            method: 'POST',
            credentials: 'same-origin' 
        })
        .then(response => response.json())
        .then(data => {
            // optional: show message from API
            console.log(data);
            // redirect after 2 seconds
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        })
        .catch(err => {
            console.error('Logout failed', err);
            
            setTimeout(() => {
                window.location.href = 'index.php';
            }, 2000);
        });
    </script>
</body>
</html>