<?php

namespace App\Entities;

use App\Models\Comment;
use App\Models\User;
use CodeIgniter\Entity\Entity;

class ReportEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function comments()
    {
        if (!$this->id) return [];
        return model(Comment::class)->where('report_id', $this->id)->orderBy('created_at', 'ASC')->findAll();
    }
    public function owner()
    {
        if (!$this->id) return null;
        return model(User::class)->where('user_id', $this->id)->first();
    }
}
