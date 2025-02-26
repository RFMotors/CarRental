<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register - Rental Car Service</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="LoginCss.css">

</head>
<body>
    <header>
        <h1>User Login / Register</h1>
        <nav>
            <ul>
                <li><a href="HomePage.php">Home</a></li>
                <li><a href="ContactPage.php">Contact</a></li>
                <li><a href="LoginPage.php">Login/Register</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="login-register-form">
            <h2>Login</h2>
            <form action="login.php" method="POST">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>

                <button type="submit">Login</button>
            </form>

            <h2>Or Register</h2>
            <form action="register.php" method="POST">
                <label for="new-username">Username</label>
                <input type="text" id="new-username" name="new-username" required>

                <label for="new-email">Email</label>
                <input type="email" id="new-email" name="new-email" required>

                <label for="new-password">Password</label>
                <input type="password" id="new-password" name="new-password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>

                <button type="submit">Register</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Rental Car Service</p>
    </footer>
</body>
</html>
