<meta charset="utf-8">
<meta name="description" content="">
<meta name="author" content="CTC">

<title>FIFA 2014!</title>

<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
{{ HTML::style('css/custom.css') }}
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js') }}
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var pagenum = 1;
	$(window).scroll(function() {
   		//Scrolled to bottom
   		if($(window).scrollTop() + $(window).height() == $(document).height()) {
   			var nextPage = pagenum++;
       		$.get('/getpage', { p: pagenum }).done(function(data){
       			$('#page-' + nextPage).after(data);
       			FB.XFBML.parse();
       		});
   		}
	});
</script>