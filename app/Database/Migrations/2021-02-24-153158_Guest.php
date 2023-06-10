<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Guest extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
				'type'           => 'INT',
				'constraint'     => 11,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'kode_guest'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nama_lengkap' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'email' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'phone' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'departemen' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'created_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
			'updated_at' => [
				'type'           => 'DATETIME',
				'null'     => true
			],
		]);
		$this->forge->addKey('id', true);
		$this->forge->createTable('guest');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('guest');
	}
}
