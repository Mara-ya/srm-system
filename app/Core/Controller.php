<?php

namespace App\Core;

abstract class Controller {
    protected function view($view, $data = []) {
        extract($data);
        require_once '../app/views/' . $view . '.php';
    }
}
