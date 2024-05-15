<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Database\Migration;

class AddReportsApprovalColumns extends Migration
{
    public function up()
    {
        $this->forge->addColumn('reports', [
            'approved' => [
                'type' => 'BOOLEAN',
                'default' => false,
                'after' => 'due_date'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('reports', ['approved']);
    }
}
