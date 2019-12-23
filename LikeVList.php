<?
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

<!-- fiter Form -->
<?$layout->filter('좋아요 영상');?>
<!-- .fiter Form -->

<div style="border-top:3px solid grey;margin-bottom: 30px"></div>

	<!-- Page Content -->
    <div class="container" style="min-height: 1100px;">

      <!-- Related Projects Row -->
      <div class="row">

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="videoView.php">
            <img class="img-fluid" src="https://i.ytimg.com/vi/whQ3W95u10s/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&amp;rs=AOn4CLDBhLb0GVd4dSP8N7FsHJ4WY35kCw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="videoView.php">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/QqWNFT6UGcg/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCuOEP9mB_S6xsfrHLoNGBzSC3fdw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/oqFK2WKmO0w/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCBIL_Wo6RmM-Tkg04EG5GmjebVcw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/f4Z4KD-uHvk/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCJM9Xsy8BrimIQNzfGZeDecjXmtg" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>
 
      <!-- line1 -->

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="videoView.php">
            <img class="img-fluid" src="https://i.ytimg.com/vi/whQ3W95u10s/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&amp;rs=AOn4CLDBhLb0GVd4dSP8N7FsHJ4WY35kCw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="videoView.php">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/QqWNFT6UGcg/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCuOEP9mB_S6xsfrHLoNGBzSC3fdw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/oqFK2WKmO0w/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCBIL_Wo6RmM-Tkg04EG5GmjebVcw" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>

        <div class="col-md-3 col-sm-6 mb-4">
          <a href="#">
            <img class="img-fluid" src="https://i.ytimg.com/vi/f4Z4KD-uHvk/hqdefault.jpg?sqp=-oaymwEZCNACELwBSFXyq4qpAwsIARUAAIhCGAFwAQ==&rs=AOn4CLCJM9Xsy8BrimIQNzfGZeDecjXmtg" alt="">
          </a>
			<p style="text-align:center;margin-top: 15px">
				<a href="#">비오는 날 듣기 좋은 15곡</a>
			</p>
        </div>
 
	  </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

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