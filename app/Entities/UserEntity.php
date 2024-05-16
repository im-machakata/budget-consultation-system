<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getFullName()
    {
        if (!$this->id) return null;
        return sprintf('%s %s', $this->firstname, $this->lastname);
    }
}
