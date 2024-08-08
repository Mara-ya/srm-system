<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script>
        function openEditModal(entry) {
            document.getElementById('editEntryId').value = entry._id['$oid']; // Correctly access ObjectId
            document.getElementById('editHours').value = entry.hours;
            document.getElementById('editDay').value = entry.day;
            document.getElementById('editComment').value = entry.comment;
            document.getElementById('editModal').style.display = 'flex';
        }

        function closeEditModal(event) {
            if (event.target === event.currentTarget) {
                document.getElementById('editModal').style.display = 'none';
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Dashboard</h1>
            <nav>
                <?php if ($_SESSION['role'] === 'admin') { ?>
                <a href="/dashboard/showResetPasswordPage">Reset User Passwords</a>
                <?php } ?>
                <a href="/logout">Logout</a>
            </nav>
            <div class="clearfix"></div>
        </header>

        <?php if (isset($error)) { echo "<p class='error'>$error</p>"; } ?>

        <h3>Add Entry</h3>
        <form method="POST" action="/dashboard/addEntry">
            <label>Hours</label>
            <input type="number" name="hours" required>
            <label>Day</label>
            <input type="date" name="day" required>
            <label>Comment</label>
            <input type="text" name="comment" required>
            <button type="submit">Add</button>
        </form>

        <h3>Entries</h3>
        <table>
            <tr>
                <th>User</th>
                <th>Hours</th>
                <th>Day</th>
                <th>Comment</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($entries as $entry) { ?>
            <tr>
                <td><?php echo htmlspecialchars($userMap[(string)$entry['user_id']]); ?></td>
                <td><?php echo htmlspecialchars($entry['hours']); ?></td>
                <td><?php echo htmlspecialchars($entry['day']); ?></td>
                <td><?php echo htmlspecialchars($entry['comment']); ?></td>
                <td>
                    <button onclick="openEditModal(<?php echo htmlspecialchars(json_encode($entry)); ?>)">Edit</button>
                </td>
            </tr>
            <?php } ?>
        </table>

        <div id="editModal" onclick="closeEditModal(event)">
            <form method="POST" action="/dashboard/editEntry">
                <input type="hidden" id="editEntryId" name="id">
                <label>Hours</label>
                <input type="number" id="editHours" name="hours" required>
                <label>Day</label>
                <input type="date" id="editDay" name="day" required>
                <label>Comment</label>
                <input type="text" id="editComment" name="comment" required>
                <button type="submit">Save</button>
                <button type="button" onclick="closeEditModal(event)">Cancel</button>
            </form>
        </div>
    </div>
</body>
</html>
