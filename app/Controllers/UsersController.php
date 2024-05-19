<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\UserEntity;
use App\Models\User;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
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
    public function ban($id)
    {
        $user = model(User::class)->find($id);

        if (!$user->banned_at) {
            $user->banned_at = time();
            model(User::class)->save($user);
        }

        return redirect()->to(url('users'));
    }
    public function unban($id)
    {
        $user = model(User::class)->find($id);

        if ($user->banned_at) {
            $user->banned_at = NULL;
            model(User::class)->save($user);
        }

        return redirect()->to(url('users'));
    }
    public function edit($id)
    {
        $user = model(User::class)->find($id);
        if (!$user) throw new PageNotFoundException();

        return view('users/edit', ['user' => $user]);
    }
    public function update($id)
    {
        $roles = implode(',', [UserRoles::ADMIN, UserRoles::CITIZEN, UserRoles::EXECUTIVE]);
        $validated = $this->validate(array(
            'username'         => "required|alpha_numeric|min_length[5]|max_length[25]|is_unique[users.username,id,$id]",
            'password'         => 'permit_empty|min_length[5]|max_length[50]',
            'firstname'        => 'required|min_length[3]|max_length[60]',
            'lastname'         => 'required|min_length[3]|max_length[60]',
            'roles'            => "required|in_list[$roles]",
            'email'            => "required|min_length[5]|max_length[60]|valid_email|is_unique[users.email,id,$id]",
        ));

        // if validation fails
        if (!$validated) return view('users/edit', [
            'errors' => $this->validator->getErrors(),
            'user' => model(User::class)->find($id)
        ]);

        // get submitted form data
        $form = new UserEntity($this->request->getPost());
        $form->id = $id;

        if (!$form->password) {
            unset($form->password);
        }

        // create user record
        $registered = model(User::class)->save($form);

        // if an error occurs while saving the user
        if (!$registered) return view('users/register', [
            'error' => 'Failed to save user'
        ]);

        // redirect to dashboard
        return redirect()->to(url('users'));
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
        if (!$validated) return view('users/login', [
            'errors' => $this->validator->getErrors()
        ]);

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
        return redirect()->to(url('dashboard'));
    }

    public function register()
    {
        return view('users/register');
    }

    public function createAccount()
    {
        $validated = $this->validate(array(
            'username'         => 'required|alpha_numeric|min_length[5]|max_length[25]|is_unique[users.username]',
            'password'         => 'required|min_length[5]|max_length[50]',
            'confirm_password' => 'required|matches[password]',
            'firstname'        => 'required|min_length[3]|max_length[60]',
            'lastname'         => 'required|min_length[3]|max_length[60]',
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
        return redirect()->to(url('dashboard'));
    }
    public function reset()
    {
        return view('users/reset');
    }
    public function sendResetLink()
    {
        $validated = $this->validate([
            'email' => 'required|valid_email'
        ]);
        if (!$validated) return view('users/reset', [
            'errors' => $this->validator->getErrors(),
        ]);
        $user = model(User::class)->where('email', $this->request->getPost('email'))->first();
        if ($user) {
            Services::email()
                ->setTo($this->request->getPost('email'))
                ->setMessage(sprintf('Please use the following link to change your password. <a href="%s">Change password</a>. You can ignore this email if you did not request to change your password.', url('change-password')));
        }
        return view('users/reset', [
            'success' => 'Reset instruction sent to your email.',
        ]);
    }

    public function logout()
    {
        session()->remove('user');
        return redirect()->to(url('login'));
    }
}
