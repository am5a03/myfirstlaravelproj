<?php

class UserTableSeeder extends Seeder{
	
	public function run(){
		DB::table('users')->delete();
		
		for($i = 1; $i <= 1000; $i++){
			$user = new User;
			$user->email = "F Yeah$i@abc$i.com";
			$user->username = "F Yeah $i";
			$user->name = "F Yeah $i";
			$user->password = Hash::make('wow');
			$user->save();
		}
	}
}