@extends('layouts.default')

@section('content')
	@include('pages.singlepost', array('post' => $post))
@stop