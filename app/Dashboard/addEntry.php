<!DOCTYPE html>
<html>
<head>
    <title>Add Entry</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <h2>Add Entry</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="/dashboard/addEntry">
        <label for="hours">Hours:</label>
        <input type="number" id="hours" name="hours" required>
        <br>
        <label for="day">Day:</label>
        <input type="date" id="day" name="day" required>
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required></textarea>
        <br>
        <input type="submit" value="Add Entry">
    </form>
</body>
</html>
