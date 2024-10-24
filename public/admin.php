<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Quicksand' rel='stylesheet'>
    <title>ZCJ Visitor Management System</title>
    <style>
        * {
            font-family: 'Quicksand', sans-serif;
        }

        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Quicksand', sans-serif;
            background-color: #ffffff;
            height: 100%;
        }

        .container {
            text-align: center;
            margin-top: 60px;
        }

        h1 {
            font-size: 2rem;
            color: #254C79;
            margin-bottom: -150px;
        }

        .logo {
            width: 150px;
            height: auto;
            margin: 0 auto;
            border-radius: 5px;
        }

        .form-container {
            background-color: #254C79;
            border-radius: 10px;
            padding: 20px;
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-top: 230px;
        }

        h2 {
            padding-top: 20px;
            text-align: center;
            color: #254C79;
            margin-bottom: 15px;
            font-size: 30px;
        }

        h3 {
            text-align: center;
            color: white;
            margin-bottom: 20px;
            font-size: 1.5rem;
            margin-top: 5px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: none;
            box-sizing: border-box;
        }

        label {
            color: white;
            font-size: 1rem;
            display: block;
            margin-bottom: 5px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            background-color: #B26D31;
            color: white;
            border: none;
            padding: 10px;
            width: 40%;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            font-family: 'Quicksand', sans-serif;
            text-decoration: none;
            text-align: center;
        }

        .button:hover {
            background-color: #a05e2f;
        }
    </style>
</head>
<body>

    <div class="container">
        <img src="../assets/images/ZCJ-logo.png" alt="ZCJ Logo" class="logo">
        <h1>ZCJ Visitor Management System</h1>
    </div>

    <div class="form-container">
        <h3>Log In as Moderator</h3>
        <form>
            <label for="username">Username</label>
            <input type="text" id="username" name="username" placeholder="Username" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <div class="button-group">
                <a href="/mDashboard" class="button">Login</a>
            </div>
        </form>
    </div>

</body>
</html>
