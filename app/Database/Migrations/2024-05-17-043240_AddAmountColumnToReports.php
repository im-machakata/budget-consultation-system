<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAmountColumnToReports extends Migration
{
    public function up()
    {
        $this->forge->addColumn('reports', [
            'item_price' => [
                'type' => 'REAL',
                'constraint' => '12,2',
                'after' => 'quantity',
                'default' => '10',
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('reports', 'item_price');
    }
}
