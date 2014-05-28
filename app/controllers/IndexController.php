<?php

class IndexController extends BaseController {

	protected $layout = 'layouts.default';

	public function __construct(Post $post){
		$this->post = $post;
	}

	public function getIndex(){

		$posts = Post::orderBy('id', 'desc')->paginate(10);
		$posts->getEnvironment()->setViewName('pagination::simple');
		$this->layout->title = "FIFA!!";
		$this->layout->main = View::make('pages.home', compact('posts'));
		// ->nest('content','index',compact('posts'));
	}

	public function showLogin(){
		return View::make('pages.login');
	}

	public function doFbLogin(){
		$facebook = new Facebook(Config::get('facebook'));
		$params = array(
			'redirect_uri'	=>	url('/login/fb/callback'),
			'scope'			=> 'email',
		);
		return Redirect::to($facebook->getLoginUrl($params));
	}

	public function doFbLoginCallback(){
		$code = Input::get('code');
		if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

		$facebook = new Facebook(Config::get('facebook'));
		$uid = $facebook->getUser();

		if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');
 
 		$me = $facebook->api('/me');

 		$user = User::whereUsername($uid)->first();

 		if(empty($user)){
 			$user = new User;
 			$user->name = $me['first_name'].' '.$me['last_name'];
 			$user->username = $uid;
 			$user->email = $me['email'];
 			$user->photo = 'https://graph.facebook.com/'.$uid.'/picture?type=large';

 			$user->save();
 		}

 		Auth::login($user);

 		return Redirect::to('/')->with('message', "$uid");
	}

	public function doLogin(){

	}

	public function doLogout(){
		Auth::logout();
	}

	public function getPage(){
		$pageNum = Input::get('p');
		$data = $this->post->getByPage($pageNum, 10);
		$posts = Paginator::make($data->items, $data->totalItems, 10);

		return View::make('pages.pagedpost', compact('posts'), array('pageNum' => $pageNum));
	}
}
