<?php

if (!function_exists('load_view')) {
    /**
     * Loads the full page layout including header, footer, main content, modals, and scripts.
     */
    function load_view($view, $data = [], $scripts = [])
    {
        // Ensure 'data' and 'scripts' are arrays
        $data = is_array($data) ? $data : [];
        $scripts = is_array($scripts) ? $scripts : [];

        // Load the layout (includes header, footer, dynamically injected content)
        echo view($view, ['data' => $data, 'scripts' => $scripts]);
    }
}

if (!function_exists('load_javascripts')) {
    /**
     * Loads the specified JavaScript files.
     */
    function load_javascripts($javascripts = [])
    {
        $javascripts = is_array($javascripts) ? $javascripts : [];
        
        foreach ($javascripts as $javascript) {
            echo "<script src='" . base_url($javascript) . "'></script>";
        }
    }
}
