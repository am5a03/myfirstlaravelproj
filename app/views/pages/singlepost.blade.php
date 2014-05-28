	<article class="post">
			<header class="post-header">
				<h1 class="post-title"><a href='/post/{{$post->id}}'>{{$post->title}}</a></h1>
			</header>
			<div class="post-votes">
				<span class="vote">+</span><span class="vote-up vote">{{$post->up}}</span>
				<span class="vote">-</span><span class="vote-down vote">{{$post->down}}</span>
			</div>
			<div class="fb-share-button" data-href='/post/{{$post->id}}' data-type="button_count"></div>

			<div class="post-content">
				<img style='display:block width:400px; height:400px;' id='{{$post->id}}' src='data:image/jpeg;base64,{{$post->contents}}'/>
			</div>
		</article>