@extends('layouts.default')
@section('content')
<h1>Login/Signup?</h1>
@if (sizeof($errors))
<div class="alert alert-danger">{{ $errors }}</div>
@endif
{{ Form::open(array('url' => 'login')) }}
		<p>
			{{ Form::label('username', 'User name') }}
			{{ Form::text('username', Input::old('username'), array('placeholder' => 'User name')) }}
		</p>
		<p>
			{{ Form::label('password', 'Password') }}
			{{ Form::password('password', array('placeholder' => 'Password')) }}
		</p>
		<p>{{ Form::submit('Submit') }}</p>
{{ Form::close() }}
	<a class="btn btn-lg btn-primary" href="{{url('login/fb')}}"><i class="icon-facebook"></i> Login with Facebook</a>
	<a class="btn btn-lg btn-danger" href="{{url('login/gp')}}"><i class="icon-google-plus"></i> Login with Google+</a>
@stop