<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Entry;
use App\Models\User;

class DashboardController extends Controller {
    public function index($data = []) {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /login');
            exit;
        }

        $entries = [];
        if ($_SESSION['role'] === 'admin') {
            $entries = Entry::find();
        } else {
            $userId = $_SESSION['user_id'];
            $entries = Entry::find(['user_id' => $userId]);
        }

        $users = User::findAll();
        $userMap = [];
        foreach ($users as $user) {
            $userMap[(string)$user['_id']] = $user['username'];
        }

        $this->view('dashboard/index', array_merge($data, ['entries' => $entries, 'userMap' => $userMap]));
    }

    public function addEntry() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $day = $_POST['day'];
            $existingEntry = Entry::find(['user_id' => $_SESSION['user_id'], 'day' => $day]);

            if ($existingEntry) {
                $this->index(['error' => 'You cannot add more than one entry per day']);
                return;
            }

            $entry = new Entry();
            $entry->user_id = $_SESSION['user_id'];
            $entry->hours = $_POST['hours'];
            $entry->day = $_POST['day'];
            $entry->comment = $_POST['comment'];

            if ($entry->save()) {
                header('Location: /dashboard');
                exit;
            } else {
                $this->index(['error' => 'Failed to add entry']);
            }
        }
    }

    public function editEntry() {
        session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $entry = Entry::findById($id);
            if ($_SESSION['role'] !== 'admin' && $entry->user_id != $_SESSION['user_id']) {
                $this->index(['error' => 'You do not have permission to edit this entry']);
                return;
            }

            $data = [
                'hours' => $_POST['hours'],
                'day' => $_POST['day'],
                'comment' => $_POST['comment'],
            ];

            if ((new Entry())->update($id, $data)) {
                header('Location: /dashboard');
                exit;
            } else {
                $this->index(['error' => 'Failed to edit entry']);
            }
        }
    }

    public function resetPassword() {
        session_start();
        if ($_SESSION['role'] !== 'admin' || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
            exit;
        }

        $userId = $_POST['user_id'];
        $newPassword = $_POST['password'];

        $user = User::findById($userId);

        if ($user) {
            $updateData = ['password' => password_hash($newPassword, PASSWORD_BCRYPT)];
            $result = (new User())->update($userId, $updateData);

            if ($result->getModifiedCount() === 1) {
                echo json_encode(['success' => true, 'message' => 'Password reset successfully']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to reset password']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'User not found']);
        }
        exit;
    }



    public function showResetPasswordPage() {
        session_start();
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: /login');
            exit;
        }

        $users = User::findAll();
        $this->view('dashboard/reset_password', ['users' => $users]);
    }
}
