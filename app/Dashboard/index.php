<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
</head>
<body>
    <h2>Dashboard</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <table>
        <thead>
            <tr>
                <th>Пользователь</th>
                <th>К-во часов</th>
                <th>День</th>
                <th>Комментарий</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($entries as $entry): ?>
            <tr>
                <td><?= $entry['username'] ?></td>
                <td><?= $entry['hours'] ?></td>
                <td><?= $entry['day'] ?></td>
                <td><?= $entry['comment'] ?></td>
                <td>
                    <a href="/dashboard/editEntry/<?= $entry['_id'] ?>">Edit</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/dashboard/addEntry">Add Entry</a>
</body>
</html>
