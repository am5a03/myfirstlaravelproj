<?php

class PostsLinkSeeder extends Seeder{
	
	public function run(){
		
		for($i = 1; $i <= 10000; $i++){
			$randPostId = rand(1, 1000);
			$randUserId = rand(1, 1000);
			$randUp = rand(0, 1);
			$post_user_link = array(
				'user_id' 	=> $randUserId,
				'post_id'	=> $randPostId,
				'is_up'		=> $randUp,
				'created_at'=> new Datetime,
				'updated_at'=> new Datetime,
			);
			DB::table('posts_link')->insert($post_user_link);
		}
		
	}
}