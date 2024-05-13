<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use UserRoles;

class UsersController extends BaseController
{
    public function login()
    {
        return view('users/login');
    }

    public function createSession()
    {
        $validated = $this->validate(array(
            'username' => 'required|min_length[5]|max_length[255]',
            'password' => 'required|min_length[5]|max_length[255]',
        ));

        // if validation fails
        if (!$validated) {
            return view('users/login', [
                'errors' => $this->validator->getErrors()
            ]);
        }

        // get submitted form data
        $form = new UserEntity($this->request->getPost());

        // get user from database
        $user = model(User::class)->where('username', $form->username)->first();

        // check account or verify password
        if (!$user || !password_verify($form->password, $user->password)) {
            return view('users/login', [
                'errors' => [
                    'password' => 'Username or password is incorrect!'
                ]
            ]);
        }

        // store user to session if password matches
        session()->set('user', $user);

        // redirect to dashboard
        return redirect('/dashboard');
    }

    public function logout()
    {
        session()->remove('user');
        return redirect('/login');
    }
}
