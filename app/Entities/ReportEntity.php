<?php

namespace App\Entities;

use App\Models\Comment;
use App\Models\User;
use CodeIgniter\Entity\Entity;

class ReportEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at', 'due_date'];
    protected $casts   = [
        'due_date' => 'date'
    ];
    private $cache     = [];

    public function comments()
    {
        if (!$this->id) return [];
        return model(Comment::class)->where('report_id', $this->id)->orderBy('created_at', 'ASC')->findAll();
    }
    public function addComment(CommentEntity $comment)
    {
        if (!$this->id) return false;
        return model(Comment::class)->save($comment);
    }
    public function owner()
    {
        if (!$this->id) return null;
        $cacheKey = sprintf('user_%s', $this->user_id);
        if (!isset($this->cache[$cacheKey])) {
            $this->cache[$cacheKey] = model(User::class)
                ->where('id', $this->user_id)
                ->first();
        }
        return $this->cache[$cacheKey];
    }
}
