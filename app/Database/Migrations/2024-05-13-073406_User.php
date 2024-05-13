<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;
use UserRoles;

class User extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id',
            'username' => [
                'type'       => 'VARCHAR',
                'unique'     => true,
                'constraint' => 255,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'roles' => [
                'type' => 'ENUM',
                'constraint' => [
                    UserRoles::ADMIN,
                    UserRoles::CITIZEN,
                    UserRoles::EXECUTIVE
                ],
                'default' => UserRoles::CITIZEN
            ],
            'reset_code' => [
                'type'       => 'VARCHAR',
                'null'       => true,
                'constraint' => 10,
            ],
            'reset_expiry' => [
                'type'       => 'INT',
                'null'       => true,
                'constraint' => 8,
            ],
            'created_at' => [
                'type'       => 'INT',
                'default'    => new RawSql('CURRENT_TIMESTAMP()'),
                'constraint' => 8,
            ],
            'updated_at' => [
                'type'       => 'INT',
                'null'       => true,
                'constraint' => 8,
            ],
            'banned_at' => [
                'type'       => 'INT',
                'null'       => true,
                'constraint' => 8,
            ],
            'deleted_at' => [
                'type'       => 'INT',
                'null'       => true,
                'constraint' => 8,
            ],
        ])->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
