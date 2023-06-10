<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Cabang extends Migration
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
			'kode_cabang'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'nama_cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'kota_cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'alamat_cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'telpon_cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 15
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
		$this->forge->createTable('cabang');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('cabang');
	}
}
