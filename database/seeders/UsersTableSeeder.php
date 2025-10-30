<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 */
	public function run(): void
	{
		$users = [
			[
				'name' => 'Admin',
				'email' => 'admin@reedcode.id',
				'role' => 'admin',
				'password' => 'admin123',
			],
			[
				'name' => 'Karyawan Satu',
				'email' => 'karyawan1@reedcode.id',
				'role' => 'karyawan',
				'password' => 'karyawan',
			],
			[
				'name' => 'Karyawan Dua',
				'email' => 'karyawan2@reedcode.id',
				'role' => 'karyawan',
				'password' => 'karyawan',
			],
			[
				'name' => 'Karyawan Tiga',
				'email' => 'karyawan3@reedcode.id',
				'role' => 'karyawan',
				'password' => 'karyawan',
			],
		];

		foreach ($users as $user) {
			User::updateOrCreate(
				['email' => $user['email']],
				[
					'name' => $user['name'],
					'role' => $user['role'],
					'password' => Hash::make($user['password']),
				]
			);
		}
	}
}
