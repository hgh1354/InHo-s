<?php
//get videos from channel by YouTube Data API
$API_key = 'AIzaSyA_BqySomdiFiDXTw76-2ZMO30AcPFP8tw';
$keyword = 'health';
$maxResults = 12;

$videoList = 'https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&q='.$keyword.'&maxResults='.$maxResults.'&key='.$API_key;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $videoList);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$value = json_decode(json_encode($data), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Videos from YouTube Channel using Data API v3 and PHP by EJ</title>
	<meta charset="urf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style type="text/css">
	.container{padding: 15px;}
	.youtube-video h2{font-size: 16px;}
	</style>
</head>
<body>
<div class="container">
	<div class="row">
	<?php
	foreach((array)$videoList->items as $item){
			//Emaded video
			if(isset($item->id->videoId)){
				echo 'div class="col-lg-3 col-sm-6 col-xs-6 youtube-video">
						<iframe width="280 height="150" src="https://wwww.youtube.com/embaded/'.$item->id->videoId.'" frameborder="0" allowfullscreen></iframe>
						<he>'. $item->snippet->title .'</h2>
					</div>';
			}
	}
	?>
	</div>
</div>
</body>
</html>