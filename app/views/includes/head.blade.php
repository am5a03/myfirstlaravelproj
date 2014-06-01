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

  vote = function(ref, id, isUp){
    
    var self = ref;
    var nextElemSib = self.nextElementSibling;
    var prevElemSib = self.previousElementSibling;
    // console.log(nextElemSib.getElementsByTagName('span')[1].innerHTML);
    // console.log(prevElemSib);
    $.ajax({
      type: "POST",
      url: '/vote',
      dataType: 'json',
      data: { post_id : id, is_up : isUp },
      success: function(data, status){
        if(data.up && data.down){
          if(isUp == 1){
            ref.getElementsByTagName('span')[1].innerHTML = data.up;
            nextElemSib.getElementsByTagName('span')[1].innerHTML = data.down;
          }else{
            ref.getElementsByTagName('span')[1].innerHTML = data.down;
            prevElemSib.getElementsByTagName('span')[1].innerHTML = data.up;
          }
        }
      },
    });
  }
</script>