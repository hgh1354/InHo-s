<!DOCTYPE HTML>
<html>
	<head>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	
		<script>
			// this should be the Ajax Method.
			// and load the url content
			var setCurrentPage = function(url) {
				$('h2 span').html(url || "/");
				$("#menu-nav a[href='" + url + "']").fadeTo(500, 0.3);
			};

			$('#menu-nav a').click(function(e){
				e.preventDefault();
				var targetUrl = $(this).attr('href'),
					targetTitle = $(this).attr('title');
				
				$("#menu-nav a[href='" + window.location.pathname + "']").fadeTo(500, 1.0);
				
				window.history.pushState({url: "" + targetUrl + ""}, targetTitle, targetUrl);
				setCurrentPage(targetUrl);
			});

			window.onpopstate = function(e) {
				$("#menu-nav a").fadeTo('fast', 1.0);
				setCurrentPage(e.state ? e.state.url : null);
			};
		</script>
	</head>
		<style>
			body {margin:10px}
			h1 {font-size:20px}
		</style>
	<body>
		<h1>Navigation Without Refresh <span></span></h1>
		<h2>Current Page: <span>/</span></h2>
		<ul id="menu-nav">
			<li><a href="/page-1/" title="Pagina 1">Page 1</a></li>
			<li><a href="/page-2/" title="Pagina 2">Page 2</a></li>
			<li><a href="/page-3/" title="Pagina 3">Page 3</a></li>
		</ul>	
	</body>
</html>