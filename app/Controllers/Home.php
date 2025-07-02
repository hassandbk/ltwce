<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Home extends Controller
{
    public function index()
    {
        // Define the URL of the video to be passed to the view
        $data = [
            'title' => 'LTWCE – Home',
            'subtitle' => 'Welcome to LTWCE SACCO',
            'video_url' => base_url('assets/videos/video.mp4'), // You can dynamically add multiple video URLs
            'content' => view('home/index'),
            'styles' => [], // Optional styles
            'scripts' => ['assets/js/supportApp.js'], // Optional scripts
        ];

        // Load the main layout with the content (and modal is handled in the layout)
        load_view('layouts/main_layout', $data);
    }
}
