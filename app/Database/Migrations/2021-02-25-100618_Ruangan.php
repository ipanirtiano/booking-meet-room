<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Ruangan extends Migration
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
			'kode_room'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nama_ruangan' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'kapasitas' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'fasilitas' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
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
		$this->forge->createTable('ruangan');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('ruangan');
	}
}
