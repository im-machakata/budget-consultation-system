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
    public function delete(int $id)
    {
        $comments = model(Comment::class);
        if ($comments->find($id) !== null) {
            $comments->delete($id);
        }
        return redirect()->to(url('comments'));
    }
}
