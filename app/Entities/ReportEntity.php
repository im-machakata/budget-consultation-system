<?php

namespace App\Entities;

use App\Models\Comment;
use CodeIgniter\Entity\Entity;

class ReportEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function comments()
    {
        if (!$this->id) return [];
        return model(Comment::class)->where('report_id', $this->id)->findAll();
    }
}
