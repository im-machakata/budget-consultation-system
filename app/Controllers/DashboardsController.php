<?php

namespace App\Controllers;

use UserRoles;
use App\Models\User;
use App\Models\Report;
use App\Models\Comment;
use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardsController extends BaseController
{
    public function index()
    {
        $user             = session('user');
        $users            = model(User::class);
        $comments         = model(Comment::class);
        $reports          = model(Report::class);
        $dashboardReports = array();

        if ($user->roles == UserRoles::CITIZEN) {
            $dashboardReports = array(
                array(
                    'icon'    => 'fa fa-comments',
                    'comment' => 'Approved Comments',
                    'value'   => $comments->selectCount('id')->first()['id']
                ),
                array(
                    'icon'    => 'fa fa-ban',
                    'comment' => 'Banned Users',
                    'value'   => $users->banned()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-user',
                    'comment' => 'Registered Users',
                    'value'   => $users->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-newspaper',
                    'comment' => 'All Reports',
                    'value'   => $reports->selectCount('id')->first()['id']
                )
            );
        } elseif ($user->roles == UserRoles::EXECUTIVE) {
            $dashboardReports = array(
                array(
                    'icon'    => 'fa fa-comments',
                    'comment' => 'Approved Comments',
                    'value'   => $comments->selectCount('id')->first()['id']
                ),
                array(
                    'icon'    => 'fa fa-ban',
                    'comment' => 'Banned Users',
                    'value'   => $users->banned()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-user',
                    'comment' => 'Registered Users',
                    'value'   => $users->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-newspaper',
                    'comment' => 'All Reports',
                    'value'   => $reports->selectCount('id')->first()['id']
                )
            );
        } elseif ($user->roles == UserRoles::ADMIN) {
            $dashboardReports = array(
                array(
                    'icon'    => 'fa fa-comments',
                    'comment' => 'Approved Comments',
                    'value'   => $comments->selectCount('id')->first()['id']
                ),
                array(
                    'icon'    => 'fa fa-ban',
                    'comment' => 'Banned Users',
                    'value'   => $users->banned()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-user',
                    'comment' => 'Registered Users',
                    'value'   => $users->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-newspaper',
                    'comment' => 'All Reports',
                    'value'   => $reports->selectCount('id')->first()['id']
                )
            );
        }

        return view('dashboard/index', ['stats' => $dashboardReports]);
    }
}
