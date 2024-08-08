<?php

namespace App\Controllers;

use App\Core\Controller;

class MainController extends Controller {
    public function index() {
        $this->view('main/index');
    }
}
