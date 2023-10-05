

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Landing Page</title>
    <style>
        /* Reset some default styles */
        body, h1, p {
            margin: 0;
            padding: 0;
        }

        /* Define the main styles for your landing page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            color: #333;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 36px;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .cta-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .cta-button:hover {
            background-color: #555;
        }


    </style>
</head>
<body>
    <header>
        <h1>Welcome to Our Portal</h1>
        <p>We Appreciate your Intrest</p>
    </header>
    <div class="container">
        <h2>About Us</h2>
        <p>A customer portal is a website designed to give current customers access to services and information they need. It's usually private and secure, requiring log-on.</p><br>
        <h2>Contact Us</h2>
        <p>If you have any questions, feel free to <a href="mailto:contact@example.com">contact us</a>.</p><br>
        <a href="signup.php" class="cta-button">Get Started</a>
    </div>
</body>
</html>
