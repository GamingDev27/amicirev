<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;
use Illuminate\Support\Str;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		/*
        DB::table('users')->truncate();
		
		DB::table('users')->insert([
			'name' => 'bry',
			'email' => 'admin@admin.com',
			'role' => 'admin',
			'password' => Hash::make('its0lutions'),
		]);
		
		DB::table('users')->insert([
			'name' => 'student',
			'email' => 'student@student.com',
			'role' => 'student',
			'password' => Hash::make('its0lutions'),
		]);
		*/

		$sexes = ['M','F'];
		$faker = Faker::create();
		foreach(range(1, 500) as $index) {

			$user = new User;
			$user->name ='';
			$user->email = $faker->email;
			$user->role = 'student';
			$user->password = Hash::make('password');
			$user->email_verified_at = date('Y-m-d H:i:s');
			$user->verified = 1;
			$user->verified_by = 2;
			$user->verified_datetime = date('Y-m-d H:i:s');
			if($user->save()){
				$student = DB::table('students')->insert([
					'first_name' => $faker->firstName,
					'last_name' => $faker->lastName,
					'middle_name' => $faker->regexify('[A-Z]'),
					'auth_user_id' => $user->id,
					'status' => 1,
					'birthdate' => $faker->dateTimeBetween('1990-01-01', '2012-12-31'),
					'sex' => $sexes[rand(0,1)],
					'date_registered' => date('Y-m-d H:i:s'),
					'school_id' => rand (1,1000),
					'mobile' => '091'.rand(10000000,99999999)
					
				]);
			}
		}
		
    }
}
