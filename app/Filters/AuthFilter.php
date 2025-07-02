<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Runs before the controller.
     * Checks if the user is logged in; if not, redirect to login page.
     */
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (! $session->get('isLoggedIn'))
        {
            // not logged in, send to login
            return redirect()->to('/auth/login');
        }
    }

    /**
     * Runs after the controller.
     * You can leave empty if you don’t need post-controller logic.
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing for now
    }
}
