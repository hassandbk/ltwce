<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Render the app/Views/home.php file
        return view('home');
    }
}
