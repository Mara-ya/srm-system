<!DOCTYPE html>
<html>
<head>
    <title>Edit Entry</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <h2>Edit Entry</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="post" action="/dashboard/editEntry/<?= $entry['_id'] ?>">
        <label for="hours">Hours:</label>
        <input type="number" id="hours" name="hours" value="<?= $entry['hours'] ?>" required>
        <br>
        <label for="day">Day:</label>
        <input type="date" id="day" name="day" value="<?= $entry['day'] ?>" required>
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required><?= $entry['comment'] ?></textarea>
        <br>
        <input type="submit" value="Edit Entry">
    </form>
</body>
</html>
