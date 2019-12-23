<?
	require_once 'API/dbconn.php';
	require_once './layout.php';
	
	$layout = new layout;
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

<!-- Header Menu-->
<?$layout->menu();?>
		<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h1>운동 <span>을 처음 접하는 당신<br />
					알맞는 운동영상을 보여드립니다</span></h1>
					<ul class="actions">
						<li><a href="CustomVList.php" class="button alt">Get Started</a></li>
					</ul>
				</div>
			</section>

		<!-- Three -->
			<section id="three">
				<div class="inner">
					<article>
						<div class="content">
							<span class="icon fa-laptop"></span>
							<header>
								<h3>맞춤형 서비스</h3>
							</header>
							<p>회원이 등록한 정보에 해당하는 <br>운동영상을 추천해드립니다.</p>
						</div>
					</article>
					<article>
						<div class="content">
							<span class="icon fa-diamond"></span>
							<header>
								<h3>등록된 영상서비스</h3>
							</header>
							<p>9999만 영상 서비스<br></p>
						</div>
					</article>
					<article>
					<div class="content">
							<span class="icon fa-laptop"></span>
							<header>
								<h3>좋아요(스크랩)</h3>
							</header>
							<p>영상에 좋아요를 눌러 <br>나만의 보관함에 보관</p>
						</div>
					</article>
				</div>
			</section>

		<!-- Banner -->
			<section id="banner2">
				<div class="inner">
					<h1>관심키워드 <span>로 편하게<br />
					운동영상을 찾아보세요</span></h1>
					<ul class="actions">
						<li><a href="AllVList.php" class="button alt">Get Started</a></li>
					</ul>
				</div>
			</section>

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