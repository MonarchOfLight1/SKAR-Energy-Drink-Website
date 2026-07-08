
"FOR CHECKPOINT 4 There is a different READMEcheckpoint4.md"


API Documentation

1. Create a Skar Account
    URL: /api/signup.php

    Method: POST

    Description: Registers a new SKAR user account.

    Request Body (JSON):
        {
            "email": "dog@gmail.com",
            "password": "123",
            "address": "8 Fastfood crescent",
            "city": "Brampton",
            "province": "Ontario",
            "postalcode": "ABCDEF"
        }

    Response Body (JSON):

        {
            "message": "Account created successfully"
        }

 2. Login with Existing SKAR Account

    URL: /api/login.php

    Method: POST

    Description: Authenticates a user and returns user details.

    Request Body (JSON):        
            {
                "email": "dog@gmail.com",
                "password": "123"
            }

    Response Body:
        {
            "message": "Login successful",
            "user_id": "1"
        }

3. Add a New Product

    URL: /api/product.php

    Method: POST

    Description: Adds a new product to the SKAR database inside product table.

    Request Body (JSON):

        {
            "product_name": "Mango Blaze",
            "product_price": 49.99,
            "product_quantity": 14,
            "description": "Mango Fruity Blaze"
        }
    Response body:
        {
            "message": "Product added successfully"
        }

4. Get All Products

    URL: /api/product.php

    Method: GET

    Description: Retrieves a list of all products in the database.

    Response Body (JSON):

        [
            {
                "product_id": "1",
                "product_name": "Mango Blaze",
                "product_price": "50.00",
                "product_quantity": "14",
                "description": "Mango Fruity Blaze"
            },
            {
                "product_id": "2",
                "product_name": "Red Surge",
                "product_price": "10.99",
                "product_quantity": "50",
                "description": "Refreshing red drink"
            },
            {
                "product_id": "3",
                "product_name": "Blue Ice",
                "product_price": "12.49",
                "product_quantity": "40",
                "description": "Cool blue beverage"
            },
            {
                "product_id": "4",
                "product_name": "Grape Shock",
                "product_price": "11.25",
                "product_quantity": "30",
                "description": "Sweet grape flavored drink"
            },
            {
                "product_id": "5",
                "product_name": "Citrus Burst",
                "product_price": "9.99",
                "product_quantity": "60",
                "description": "Tangy citrus drink"
            },
            {
                "product_id": "6",
                "product_name": "Green Strike",
                "product_price": "13.50",
                "product_quantity": "35",
                "description": "Energetic green drink"
            },
            {
                "product_id": "7",
                "product_name": "Grey Lime",
                "product_price": "10.99",
                "product_quantity": "50",
                "description": "Refreshing lime drink"
            },
            {
                "product_id": "8",
                "product_name": "Tangy RaspBerry",
                "product_price": "41.99",
                "product_quantity": "14",
                "description": "Raspberry Fruity Blaze"
            }
        ]

5. Post a Review

        URL: /api/review.php

        Method: POST

        Description: Adds a review for a product by a SKAR user.

        Request Body (JSON):

            {
                "skar_id": 1,
                "product_id": 1,
                "rating": 5,
                "review_text": "Love this! Super refreshing."
            }

        Response body (JSON):

            {
                "message": "Review added successfully"
            
            }

6. Get all Reviews:
        Get All Reviews

        URL: /api/review.php

        Method: GET

        Description: Retrieves all product reviews from the database.

        Response Body (JSON):
                [
                    {
                        "review_id": "1",
                        "skar_id": "1",
                        "product_id": "1",
                        "rating": "5",
                        "review_text": "Love this! Super refreshing.",
                        "created_at": "2026-02-26 23:54:21"
                    },
                    {
                        "review_id": "2",
                        "skar_id": "2",
                        "product_id": "2",
                        "rating": "4",
                        "review_text": "Nice taste, but a bit too sweet for me.",
                        "created_at": "2026-02-26 23:54:26"
                    },
                    {
                        "review_id": "3",
                        "skar_id": "2",
                        "product_id": "2",
                        "rating": "4",
                        "review_text": "Nice taste, but a bit too sweet for me.",
                        "created_at": "2026-02-26 23:54:31"
                    },
                    {
                        "review_id": "4",
                        "skar_id": "1",
                        "product_id": "3",
                        "rating": "3",
                        "review_text": "It\u2019s okay, not my favorite.",
                        "created_at": "2026-02-26 23:54:35"
                    },
                    {
                        "review_id": "5",
                        "skar_id": "2",
                        "product_id": "6",
                        "rating": "4",
                        "review_text": "Nice",
                        "created_at": "2026-02-27 00:34:51"
                    }
                ]

POSSIBLE STATUS CODES:

200 ---->	Request succeeded (used for GET and successful actions).
201 -----> Created	Resource created successfully (used for POST requests like signup or adding a product).
400 -----> Bad Request	Invalid request or missing required fields.
401 -----> Unauthorized	Authentication failed (wrong login credentials).

The Above Responses were generated by using POSTMAN and requests.rest(REST CLIENT EXTENSION) that has been pushed to github 