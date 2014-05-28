<?php

class PostController extends BaseController {

	protected $layout = 'layouts.default';

	public function showPost(Post $post)
	{
		$post = Post::find($post->id);
		$this->layout->title = $post->title;
		$this->layout->main = View::make('pages.post', compact('post'));
	}

	public function votePost(){
		$isUp = Input::get('isUp');
		$postId = Input::get('postId');
		$userId = Input::get('userId');
	}
}
