<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Role implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->has('isLoggedIn')) {
            return redirect()->to(site_url('login'));
        }

        $role = session()->get('role');

        if ($role === 'guest') {
            return;
        }

        if ($role === 'admin') {
            return redirect()->to(site_url('/'));
        }

        return redirect()->to(site_url('/'));
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}