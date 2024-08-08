<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class AuthController extends Controller {
    public function login() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $user = User::find(['username' => $username]);

            if ($user && password_verify($password, $user->password)) {
                $_SESSION['user_id'] = (string)$user->_id;
                $_SESSION['role'] = $user->role;
                header('Location: /dashboard');
                exit;
            } else {
                $this->view('auth/login', ['error' => 'Invalid username or password']);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
        session_start();
        if (isset($_SESSION['user_id'])) {
            header('Location: /dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $existingUser = User::find(['username' => $username]);
            if ($existingUser) {
                $this->view('auth/register', ['error' => 'Username already exists']);
                return;
            }

            $user = new User();
            $user->name = $_POST['name'];
            $user->username = $username;
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $user->role = $_POST['role'];
            if ($user->save()) {
                header('Location: /login');
                exit;
            } else {
                $this->view('auth/register', ['error' => 'Failed to register user']);
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /login');
        exit;
    }
}
