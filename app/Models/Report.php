<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\I18n\Time;
use App\Entities\ReportEntity;

class Report extends Model
{
    protected $table            = 'reports';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = ReportEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'user_id',
        'item',
        'quantity',
        'due_date',
        'approved',
        'amount'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'int';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [
        'fixDueDate'
    ];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function ownedBy(int $userId)
    {
        return $this->where('user_id', $userId);
    }
    public function excludeExpired()
    {
        return $this->where('due_date <', Time::create()->toDateString());
    }
    public function pending()
    {
        return $this->where('created_at = updated_at', null, false);
    }
    public function expired()
    {
        return $this->where('due_date >', Time::create()->toDateString());
    }
    protected function fixDueDate(array $data)
    {
        if (isset($data['data']['due_date'])) {
            $dueDateTimestamp = $data['data']['due_date'];
            $data['data']['due_date'] = Time::createFromTimestamp($dueDateTimestamp)->toDateString();
        }
        return $data;
    }
}
