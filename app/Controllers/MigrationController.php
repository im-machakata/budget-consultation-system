<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class MigrationController extends BaseController
{
    public function index()
    {
        $update = $this->request->getGet('update') ?? false;

        if (!$update) {
            // rollback db
            command('migrate:rollback');
        }

        // run new migrations
        command('migrate');

        // seed admins
        command('db:seed AdminSeeder');

        // say hello world or something
        return 'It is done!';
    }
}
