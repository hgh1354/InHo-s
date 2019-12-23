<link rel="stylesheet" href="assets/css/main.css" />
<?
	header('Content-Type: text/html; charset=utf-8');
	class layout
	{
		public function structT()
		{
			echo'
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
			';
		}
		public function menu()
		{
			echo'
			<header id="header">
				<div class="inner">
					<a href="index.php" class="logo">Health Tube</a>
					<nav id="nav">
						<a href="index.php">Home</a>
						<a href="CustomVList.php">맞춤영상</a>
						<a href="LikeVList.php">좋아요영상</a>
						<a href="AllVList.php">영상검색</a>
						<a href="login.php">로그인</a>
						<a href="regist.php">회원가입</a>
					</nav>
				</div>
			</header>
			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>
			';
		}
		public function footer()
		{
			echo'
			<section id="footer">
				<div class="inner">
					<div class="copyright">
						&copy; Untitled Design: <a href="https://templated.co/">TEMPLATED</a>. Images <a href="https://unsplash.com/">Unsplash</a>
						<p>Copyright &copy; Health Tube 2018</p>
					</div>
				</div>
			</section>
			';
		}
		public function structB()
		{
			echo'
						<script src="assets/js/jquery.min.js"></script>
						<script src="assets/js/skel.min.js"></script>
						<script src="assets/js/util.js"></script>
						<script src="assets/js/main.js"></script>

						<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>
				</body>
			</html>
			';
		}
	}
	//$conn = new layout;
	//$conn->menu();
	//$conn->footer();
?>