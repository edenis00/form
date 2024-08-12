<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <h2>Join Us</h2>
        <form action="../main.php" method="post">
            <?php
            if (isset($_GET['error'])) {
                $getError = $_GET["error"];
                if ($getError == "passworddoesnotmatch") { ?>
                <p class="error_message">GGGGGG</p>
            <?php
                }
            }   ?>

            <div class="form_outline">
                <label for="uname">Username</label>
                <input type="text" name="uname" id="uname">
            </div>
            <div class="form_outline">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div class="form_outline">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="form_outline">
                <label for="con_password">Confirm Password</label>
                <input type="password" name="con_password" id="con_password">
            </div>

            <input type="submit" class="btn" value="Sign In" name="register">
            <p>Already registered? <a href="login.html">Login</a></p>
        </form>

    </div>
</body>

</html>