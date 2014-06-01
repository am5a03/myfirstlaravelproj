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

 		return Redirect::to('/')->with('messages', "Welcome back, $uid");
	}

	public function doLogin(){
		$rules = array(
			'username'	=> 'required',
			'password'	=> 'required'
		);

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails()){
			return Redirect::to('login')->withErrors($validator)->withInput(Input::except('password'));
		}else{

			$userdata = array(
				'username'	=>	Input::get('username'),
				'password'	=>	Input::get('password')
			);

			if(Auth::attempt($userdata)){
				return Redirect::to('/')->with('messages', 'Welcome back, '.Input::get('username'));
			}else{
				$user = new User;
				$user->username = Input::get('username');
				$user->password = Hash::make(Input::get('password'));
				$user->save();
				return Redirect::to('/')->with('messages', 'Welcome new user, '.$user->username);
			}
		}
	}

	public function doLogout(){
		Auth::logout();
		return Redirect::to('/');
	}

	public function vote(){
		$message = array( 'messages' => 'Voting error', 'success' => 'false');

		if(Auth::check()){
			$postId = Input::get('post_id');
			$isUp = Input::get('is_up');
			// $postId = $json['post_id'];
			// $isUp = $json['is_up'];
			$userId = Auth::user()->id;

			$voted = DB::select('select 1 from posts_link where post_id = ? and user_id = ?', array($postId, $userId));

			if(sizeof($voted) != 0){
				$message = array('messages' => "You've voted!", 'success' => 'false');
				return $message;
			}

			DB::transaction(function() use ($postId, $isUp, $userId)
			{
				$post_user_link = array(
					'user_id' 	=> $userId,
					'post_id'	=> $postId,
					'is_up'		=> $isUp,
					'created_at'=> date('Y-m-d G:i:s'),
					'updated_at'=> date('Y-m-d G:i:s')
				);
				$post = Post::find($postId);
				if($isUp == 1){
					$post->up = $post->up + 1;
				}else{
					$post->down = $post->down + 1;
				}
				$post->push();
			    DB::table('posts_link')->insert($post_user_link);
			});

			$updated_post = Post::find($postId);
			$up = $updated_post->up;
			$down = $updated_post->down;

			$message = array(
				'messages' 	=> 'Voted',
				'success' 	=> 'true',
				'post_id'	=> $postId,
				'is_up'		=> $isUp,
				'up'		=> $up,
				'down'		=> $down
			);

		}else{
			$message = array(
				'messages'	=> 'Please login first',
				'success' => 'false',
			);
		}

		return json_encode($message);
	}

	public function getPage(){
		$pageNum = Input::get('p');
		$data = $this->post->getByPage($pageNum, 10);
		$posts = Paginator::make($data->items, $data->totalItems, 10);

		return View::make('pages.pagedpost', compact('posts'), array('pageNum' => $pageNum));
	}
}
