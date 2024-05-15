<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;
use UserRoles;

class UsersController extends BaseController
{
    public function index()
    {
        $users = model(User::class);
        return view('users/index', [
            'users' => $users->paginate(10),
            'pager' => $users->pager
        ]);
    }
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
        return redirect()->to(env('app.baseURL') . 'dashboard');
    }

    public function register()
    {
        return view('users/register');
    }

    public function createAccount()
    {
        $validated = $this->validate(array(
            'username'         => 'required|min_length[5]|max_length[25]|is_unique[users.username]',
            'password'         => 'required|min_length[5]|max_length[50]',
            'confirm_password' => 'required|matches[password]',
            'firstname'        => 'required|min_length[5]|max_length[60]',
            'lastname'         => 'required|min_length[5]|max_length[60]',
            'email'            => 'required|min_length[5]|max_length[60]|valid_email|is_unique[users.email]',
        ));

        // if validation fails
        if (!$validated) return view('users/register', [
            'errors' => $this->validator->getErrors()
        ]);

        // get submitted form data
        $form = new UserEntity($this->request->getPost());

        // create user record
        $registered = model(User::class)->save($form);

        // if an error occurs while saving the user
        if (!$registered) return view('users/register', [
            'error' => 'Failed to save user'
        ]);

        // redirect to dashboard
        return redirect()->to(env('app.baseURL') . 'dashboard');
    }

    public function logout()
    {
        session()->remove('user');
        return redirect()->to(env('app.baseURL') . 'login');
    }
}
