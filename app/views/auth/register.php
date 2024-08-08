<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <div class="register-container">
        <form method="POST" action="/register">
            <h2>Register</h2>
            <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>
            <label>Name</label>
            <input type="text" name="name" required>
            <label>Username</label>
            <input type="text" name="username" required>
            <label>Password</label>
            <input type="password" name="password" required>
            <label>Role</label>
            <select name="role" required>
                <option value="operator">Operator</option>
                <option value="admin">Administrator</option>
            </select>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="/login">Login here</a></p>
    </div>
</body>
</html>
