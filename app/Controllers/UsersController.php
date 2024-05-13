<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UsersController extends BaseController
{
    public function logout()
    {
        session()->remove('user');
        return redirect('/login');
    }
}
