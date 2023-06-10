<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Booking extends Migration
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
			'kode_booking'       => [
				'type'           => 'VARCHAR',
				'constraint'     => 10,
			],
			'kode_cabang' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'kode_room' => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'topik' => [
				'type'           => 'VARCHAR',
				'constraint'     => 255
			],
			'tanggal_meeting' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'jam_mulai' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'jam_akhir' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'pemesan' => [
				'type'           => 'VARCHAR',
				'constraint'     => 50
			],
			'status' => [
				'type'           => 'VARCHAR',
				'constraint'     => 20
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
		$this->forge->createTable('booking');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('booking');
	}
}
