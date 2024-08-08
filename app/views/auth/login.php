<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <div class="login-container">
        <form method="POST" action="/login">
            <h2>Login</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="/register">Register here</a></p>
    </div>
</body>
</html>
