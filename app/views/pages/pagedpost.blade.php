@foreach ($posts as $post)
	@include('pages.singlepost', array('post' => $post))
@endforeach
<div id="page-{{$pageNum}}" />