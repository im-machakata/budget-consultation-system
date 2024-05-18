<?php

namespace App\Entities;

use App\Models\Report;
use App\Models\User;
use CodeIgniter\Entity\Entity;

class CommentEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];
    private $cache     = [];

    public function getAuthor()
    {
        if (!$this->user_id) return null;
        $cacheKey = sprintf('user_%s', $this->user_id);
        if (!isset($this->cache[$cacheKey])) {
            $cache[$cacheKey] = model(User::class)->find($this->user_id);
        }
        $user = $cache[$cacheKey];
        return sprintf('%s %s', $user->firstname, $user->lastname);
    }
    public function getReport()
    {
        if (!$this->report_id) return null;
        $cacheKey = sprintf('report_%s', $this->report_id);
        if (!isset($this->cache[$cacheKey])) {
            $cache[$cacheKey] = model(Report::class)->find($this->report_id);
        }
        return $cache[$cacheKey];
    }
}
