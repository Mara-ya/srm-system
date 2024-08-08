<!DOCTYPE html>
<html>
<head>
    <title>Reset User Passwords</title>
    <link rel="stylesheet" type="text/css" href="/css/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form.reset-password-form').on('submit', function(event) {
                event.preventDefault();
                var $form = $(this);
                $.ajax({
                    type: $form.attr('method'),
                    url: $form.attr('action'),
                    data: $form.serialize(),
                    success: function(response) {
                        var jsonResponse = JSON.parse(response);
                        if (jsonResponse.success) {
                            $('#successModal .modal-body').text(jsonResponse.message);
                            $('#successModal').css('display', 'flex');
                        } else {
                            alert(jsonResponse.message);
                        }
                    }
                });
            });

            $('#successModal').on('click', function(event) {
                if (event.target === this) {
                    $(this).hide();
                }
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Reset User Passwords</h1>
            <nav>
                <a href="/dashboard">Back to Dashboard</a>
                <a href="/logout">Logout</a>
            </nav>
            <div class="clearfix"></div>
        </header>

        <h3>Users</h3>
        <table>
            <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo htmlspecialchars($user['username']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <form class="reset-password-form" method="POST" action="/dashboard/resetPassword">
                        <input type="hidden" name="user_id" value="<?php echo $user['_id']; ?>">
                        <input type="password" name="password" placeholder="New Password" required>
                        <button type="submit">Reset Password</button>
                    </form>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>

    <!-- Success Modal -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <p class="modal-body">Password reset successfully!</p>
            <button onclick="$('#successModal').hide()">Close</button>
        </div>
    </div>
</body>
</html>
