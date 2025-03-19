<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register - Rental Car Service</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/Login.js"></script>

</head>
<body class="body">
<?php require 'layout/header.php'; ?>
    <main>
        <form action="HomePage.php" method="POST">
            <fieldset>
                <legend>Login</legend>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required><br><br>
                
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required><br><br>
                
                <input type="submit" value="Login" onclick="showLogin()">
            </fieldset>
        </form>
    <br>
    <h2>OR</h2>
    <br>
        <form action="HomePage.php" method="POST">
            <fieldset>
                <legend>Register</legend>
                <label for="new-username">Username:</label>
                <input type="text" id="new-username" name="new-username" required><br><br>
                
                <label for="new-email">Email:</label>
                <input type="email" id="new-email" name="new-email" required><br><br>
                
                <label for="new-password">Password:</label>
                <input type="password" id="new-password" name="new-password" required><br><br>
                
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required><br><br>
                
                <input type="submit" value="Register" onclick="showRegister()">
            </fieldset>
        </form>
    </main>

    <?php require 'layout/footer.php'; ?>
</body>
</html>