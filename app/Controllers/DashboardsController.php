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
                    'icon'    => 'fa fa-thumbs-up',
                    'comment' => 'Approved Reports',
                    'value'   => $reports->ownedBy($user->id)->where('approved', true)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-ban',
                    'comment' => 'Banned Users',
                    'value'   => $users->banned()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-comments',
                    'comment' => 'My Comments',
                    'value'   => $comments->where('user_id', $user->id)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-user',
                    'comment' => 'Registered Users',
                    'value'   => $users->selectCount('id')->first()->id
                ),
            );
        } elseif ($user->roles == UserRoles::EXECUTIVE) {
            $dashboardReports = array(
                array(
                    'icon'    => 'fa fa-newspaper',
                    'comment' => 'All Your Reports',
                    'value'   => $reports->ownedBy($user->id)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-thumbs-up',
                    'comment' => 'Approved Reports',
                    'value'   => $reports->ownedBy($user->id)->where('approved', true)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-face-meh-blank',
                    'comment' => 'Pending Reports',
                    'value'   => $reports->ownedBy($user->id)->where('approved', false)->where('created_at <', 'updated_at', false)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa-solid fa-heart-crack',
                    'comment' => 'Rejected Reports',
                    'value'   => $reports->ownedBy($user->id)->where('approved', false)->where('created_at <', 'updated_at', false)->selectCount('id')->first()->id
                ),
            );
        } elseif ($user->roles == UserRoles::ADMIN) {
            $dashboardReports = array(
                array(
                    'icon'    => 'fa fa-ban',
                    'comment' => 'Banned Users',
                    'value'   => $users->banned()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-comments',
                    'comment' => 'Comments Submitted',
                    'value'   => $comments->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-user',
                    'comment' => 'Registered Users',
                    'value'   => $users->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-check',
                    'comment' => 'Submitted Reports',
                    'value'   => $reports->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-thumbs-up',
                    'comment' => 'Approved Reports',
                    'value'   => $reports->where('approved', true)->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-clock',
                    'comment' => 'Pending Reports',
                    // get all pending reports (that have not yet expired)
                    'value'   => $reports->whereNotExpired()->pending()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-thumbs-down',
                    'comment' => 'Rejected Reports',
                    // get all reports that have not yet expired but were rejected
                    'value'   => $reports->whereNotExpired()->rejected()->selectCount('id')->first()->id
                ),
                array(
                    'icon'    => 'fa fa-calendar-check',
                    'comment' => 'Expired Reports',
                    // get all reports that have expired whether after being approved or not
                    'value'   => $reports->whereExpired()->selectCount('id')->first()->id
                ),
            );
        }

        return view('dashboard/index', ['stats' => $dashboardReports]);
    }
}
