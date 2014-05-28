<?php

class Post extends Eloquent{
	public function users(){
		return $this->belongsToMany('User', 'post_links', 'post_id', 'user_id');
	}

	public function comments(){
		return $this->hasMany('Comment');
	}

	public function getByPage($page = 1, $limit = 10){
		$results = new StdClass;
		$results->page = $page;
		$results->limit = $limit;
		$results->totalItems = 0;
		$results->items = array();

		$posts = $this->orderBy('id', 'desc')->skip($limit * ($page - 1))->take($limit)->get();

		$results->totalItems = $this->count();
		$results->items = $posts->all();

		return $results;
	}
}