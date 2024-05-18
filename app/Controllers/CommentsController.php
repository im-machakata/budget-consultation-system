<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Controllers\BaseController;
use App\Entities\CommentEntity;
use CodeIgniter\HTTP\ResponseInterface;

class CommentsController extends BaseController
{
    public function index()
    {
        $comments = model(Comment::class);
        return view('comments/index', [
            'comments' => $comments->paginate(10),
            'pager' => $comments->pager
        ]);
    }
}
