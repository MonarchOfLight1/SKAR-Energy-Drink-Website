Authentication:

We are using session based authentication with php. Users visit our website and signup. 
They will have to login with the details they provided while signing up. If the details match they will be logged in. A php session is started (session_start()) and the user's ID is stored in  $_SESSION['user_id'].log out is implemented by destryoing their session. 


We are using "$hashedPassword = password_hash($password, PASSWORD_DEFAULT); " 
to hash passwords and store hashed passwords in the database. 

Password is stored in our database like:

user_id  username  email  password
1          apple         apple@gmail.com     $2y$10$/Djw1eW/ys25jKz5U1TLheakxu.icIf6vp6NeeiysTx...

SQL INJECTION PREVENTION:

We are using Prepared statements in PHP with (mysqli_prepare)

1. ENDPOINT for signing up.
    ###
    POST http://localhost/course-project-group-7/Project_Skar/api/signup.php

    With body-raw:
    {
    "username": "def",
    "email": "def@gmail.com",
    "password": "def"
    }

    This endpoint can be accessed by anyone even if they are logged in or not. This is a post endpoint that takes three user inputs and adds them in the database. making a POST request at this URL in POSTMAN returned 

    {
        "message": "Account created successfully"
    }

2. Endpoint for logging In
POST http://localhost/course-project-group-7/Project_Skar/api/login.php

This endpoint can be accessed by anyone, and If the inputs you provided validates with our database, you will be logged in. 

In POSTMAN we added
body-raw 
{
  "email": "abc@gmail.com",
  "password": "abc"
} 


POST http://localhost/course-project-group-7/Project_Skar/api/login.php


RESULT:
{
    "message": "You are logging in as \"abc\"",
    "user_id": 8
}


3. ENDPOINT for logging out

    POST http://localhost/course-project-group-7/Project_Skar/api/logout.php

    This endpoint can only be accessed if you are logged in. If you are not logged-in and if you try to reach this endpoint, it shows:

    HTTP/1.1 200 OK
    Date: Thu, 19 Mar 2026 01:36:11 GMT
    Server: Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    X-Powered-By: PHP/8.2.12
    Expires: Thu, 19 Nov 1981 08:52:00 GMT
    Cache-Control: no-store, no-cache, must-revalidate
    Pragma: no-cache
    Content-Length: 52
    Connection: close
    Content-Type: application/json

    {
    "success": false,
    "message": "You are not logged in."
    }

4. ###
    POST http://localhost/course-project-group-7/Project_Skar/api/add_to_cart.php

    This endpoint requires users to be logged in. If users are not logged in it returns:

    HTTP/1.1 401 Unauthorized
    Date: Thu, 19 Mar 2026 00:19:36 GMT
    Server: Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    X-Powered-By: PHP/8.2.12
    Expires: Thu, 19 Nov 1981 08:52:00 GMT
    Cache-Control: no-store, no-cache, must-revalidate
    Pragma: no-cache
    Content-Length: 24
    Connection: close
    Content-Type: application/json

    {
    "error": "Unauthorized"
    }



5. 
###
POST http://localhost/course-project-group-7/Project_Skar/api/clear_cart.php

    This endpoint requires users to be logged in. If you are not logged in it returns


    HTTP/1.1 401 Unauthorized
    Date: Thu, 19 Mar 2026 00:23:05 GMT
    Server: Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    X-Powered-By: PHP/8.2.12
    Expires: Thu, 19 Nov 1981 08:52:00 GMT
    Cache-Control: no-store, no-cache, must-revalidate
    Pragma: no-cache
    Content-Length: 24
    Connection: close
    Content-Type: application/json

    {
    "error": "Unauthorized"
    }


6. 
###
GET http://localhost/course-project-group-7/Project_Skar/api/get_cart_count.php

    This endpoint requires users to be logged in. If you are not logged in it returns


    HTTP/1.1 401 Unauthorized
    Date: Thu, 19 Mar 2026 00:23:25 GMT
    Server: Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    X-Powered-By: PHP/8.2.12
    Expires: Thu, 19 Nov 1981 08:52:00 GMT
    Cache-Control: no-store, no-cache, must-revalidate
    Pragma: no-cache
    Content-Length: 20
    Connection: close
    Content-Type: application/json

    [
    "unauthorized"
    ]


7.
###
POST http://localhost/course-project-group-7/Project_Skar/api/remove_item.php

    This endpoint requires users to be logged in. If you are not logged in it returns


    HTTP/1.1 401 Unauthorized
    Date: Thu, 19 Mar 2026 00:30:19 GMT
    Server: Apache/2.4.58 (Win64) OpenSSL/3.1.3 PHP/8.2.12
    X-Powered-By: PHP/8.2.12
    Expires: Thu, 19 Nov 1981 08:52:00 GMT
    Cache-Control: no-store, no-cache, must-revalidate
    Pragma: no-cache
    Content-Length: 24
    Connection: close
    Content-Type: application/json

    {
        "error": "Unauthorized"
    }


