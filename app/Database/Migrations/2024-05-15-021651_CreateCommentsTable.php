<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class CreateCommentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id',
            'user_id' => [
                'type' => 'INT',
                'constraint' => 8
            ],
            'comment' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'created_at' => [
                'type' => 'INT',
                'constraint' => 8,
                'default' => new RawSql('CURRENT_TIMESTAMP()')
            ],
            'updated_at' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'INT',
                'constraint' => 8,
                'null' => true
            ],
        ]);
        $this->forge->addForeignKey('user_id', 'users', 'id');
        $this->forge->createTable('comments');
    }

    public function down()
    {
        $this->forge->dropTable('comments');
    }
}
