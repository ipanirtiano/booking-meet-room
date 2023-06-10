<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
	public function run()
	{
		//generet kode Admin 3 digit pertama
		$angka_kode1 = range(0, 9);
		shuffle($angka_kode1);
		$ambilKode1 = array_rand($angka_kode1, 3);
		$generetKode1 = implode('', $ambilKode1);
		// generate kode Admin random 3 digit kedua
		$angka_kode2 = range(0, 9);
		shuffle($angka_kode2);
		$ambilKode2 = array_rand($angka_kode2, 3);
		$generetKode2 = implode('', $ambilKode2);
		// kode guru yang sudah di random
		$kode_admin = 'USR-' . $generetKode1 . $generetKode2;


		$password = "password123";


		// Insert data admin
		$faker = \Faker\Factory::create('id_ID');

		// faker email 
		$email =  $faker->email;
		$data_admin = [
			'kode_guest' => $kode_admin,
			'nama_lengkap' => $faker->name,
			'email' => $email,
			'phone' => $faker->phoneNumber,
			'departemen' => '',
			'created_at' => Time::now(),
			'updated_at' => Time::now()
		];
		// Insert data guru menggunakan query builder
		$this->db->table('guest')->insert($data_admin);


		// hashing paswword sebelum insert database
		$password_hash = password_hash($password, PASSWORD_DEFAULT);
		// insert data user
		$data_users = [
			'id_users' => $kode_admin,
			'username' => $email,
			'password' => $password_hash,
			'level' => 'admin',
			'created_at' => Time::now(),
			'updated_at' => Time::now()
		];

		$this->db->table('users')->insert($data_users);
	}
}
