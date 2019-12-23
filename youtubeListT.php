<?php
	header('Content-Type: text/html; charset=utf-8');
    define("MAX_RESULTS", 10);

	require_once 'API/dbconn.php';
	require_once './layout.php';
	$layout = new layout;

	if($_SESSION['per'] != 1){
		echo '<script>alert("관리자만 이용가능한 서비스입니다."); location.replace("./");</script>';
		exit;
	}

	if (isset($_POST['submit']) || isset($_POST['page']))
	{
		$keyword = $_POST['keyword'];
		$page = $_POST['page'];
   
		if (empty($keyword))
		{
			$response = array(
			  "type" => "error",
			  "message" => "Please enter the keyword."
			);
		} 
	}//다중 인설트 가능해야함 [] 사용하면 될듯? 라디오 친구랑         
?>
<!-- Top structure -->
<!DOCTYPE HTML>
<html>
	<head>
		<title>Health Tube</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" />
	</head>

	<body>
<?$layout->menu();?>

	<!-- Page Content -->
	<form id="keywordForm" method="post" action="">
		<div class="container" style="min-height: 450px;">
			<h3 class="my-4"><strong>영상 등록 youtube api</strong></h3>
			<div class="row">
				<div class="col-lg-12 mb-4">
					Search Keyword : 
					<input class="input-field" type="search" id="keyword" name="keyword"  placeholder="Enter Search Keyword" value="<?echo $keyword?>">
					<input type="submit" name="submit" value="Search">
				</div>
				<div class="col-lg-12 mb-4">
<?php								 
		if (!empty($keyword))
		{
			$apikey = 'AIzaSyBY8hm7STXxLsMvrpXNXUgzjS_H3bhssYM'; 
			$googleApiUrl = 'https://www.googleapis.com/youtube/v3/search?part=snippet&q=' . $keyword . '&maxResults=' . MAX_RESULTS . '&key=' . $apikey . '&order=viewCount&type=video'
			. '&pageToken=' . $page;

			$ch = curl_init();

			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_VERBOSE, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			$response = curl_exec($ch);

			curl_close($ch);
			$data = json_decode($response);
			$value = json_decode(json_encode($data), true);

			echo "전체 글 : ".$value['pageInfo']['totalResults']."<br/>";
			echo "페이지당 출력개수 : ".$value['pageInfo']['resultsPerPage']."<br/>";
			echo "<br/>";
			//$prev = $value['prevPageToken'];
			//$next = $value['nextPageToken'];

            for ($i = 0; $i < MAX_RESULTS; $i++) {

				$videoId = $value['items'][$i]['id']['videoId'];
				$title = $value['items'][$i]['snippet']['title'];
				$description = $value['items'][$i]['snippet']['description'];
				$channel = $value['items'][$i]['snippet']['channelTitle'];
				$channelId = $value['items'][$i]['snippet']['channelId'];
				$thumb = $value['items'][$i]['snippet']['thumbnails']['medium']['url'];

				echo "아이디 : ".$videoId."<br/>";
				echo "제목 : ".$title."<br/>";
				echo "내용 : ".$description."<br/>";
				echo "채널 이름 : ".$channel."<br/>";			
				echo "채널 아이디 : ".$channelId."<br/>";
				echo "썸네일 : ".$thumb."<br/>";
			
				echo "<br/>";
            }
		}       
?>
				</div>
				<div class="col-lg-12 mb-4" style="text-align:center">
					<?if(isset($value['prevPageToken'])){?>
						<button type="submit" name="page" value="<?echo $value['prevPageToken']?>">
						이전 페이지</button>
					<?}if(isset($value['nextPageToken'])){?>
						<button type="submit" name="page" value="<?echo $value['nextPageToken']?>">
						다음 페이지</button>
					<?}?>					
				</div>
			</div>
		</div>
	</form>
<!-- Footer -->
<?$layout->footer();?>

<!-- Scripts and Bottom structure-->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
	</body>
</html>