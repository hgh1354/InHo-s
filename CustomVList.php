<?
	require_once 'API/dbconn.php';
	require_once './layout.php';
	require_once 'API/fitAPI.php';

	$layout = new layout;

	if(!isset($_SESSION['id'])){
		echo '<script>alert("로그인 해야 이용가능한 서비스입니다."); location.replace("login.php");</script>';
		exit;
	}else{
		if($userData[0]['id'] == null){
			echo '<script type="text/javascript">
					if(confirm("입력된 정보가 없습니다. \n서비스를 이용하기 위해선 정보 입력이 필요합니다.")){
						location.replace("fitLike.php");
					}else{
						history.back();
					}
				  </script>';
		}
	}
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

    <!-- Page Content -->
    <div class="container" style="min-height: 250px;">
      <!-- Related Projects Row -->
      <h3 class="my-4"><?echo $userID."님을 위한 ";?>맞춤 운동<?echo "(".$userData[0]['vCategory2'].")";?></h3>

	  <div style="text-align:left;"><a type="button" href="fitLike.php">맞춤 데이터 수정</a></div>
	  <div style="margin-bottom: 15px"></div>

      <div class="row">
<?
for($cnt=0;$cnt<$bodyNum;$cnt++){
	for($cnt2=0;$cnt2<count(${"lv1_".$cnt});$cnt2++){
		$datetime = explode(' ', ${"lv1_".$cnt}[$cnt2]['vDate']);
		$date = $datetime[0];
		$time = $datetime[1];
		if($date == Date('Y-m-d'))
			${"lv1_".$cnt}[$cnt2]['vDate'] = $time;
		else
			${"lv1_".$cnt}[$cnt2]['vDate'] = $date;
?>
        <div class="col-md-3 col-sm-6 mb-4">
			<div class="card">
				<a href="videoView.php?vno=<?php echo ${"lv1_".$cnt}[$cnt2]['vIdx']?>">
					<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo ${"lv1_".$cnt}[$cnt2]['vId']?>/0.jpg" alt="">
				</a>
				<p style="text-align:center;margin-top: 10px;margin-bottom: 0px;">
					<a href="videoView.php?vno=<?php echo ${"lv1_".$cnt}[$cnt2]['vIdx']?>">
					<?echo "[".${"lv1_".$cnt}[$cnt2]['vCategory2']."]"?>
					<?echo ${"lv1_".$cnt}[$cnt2]['vTitle']?></a>
				</p>
				<p style="text-align:center">조회수 : <?echo ${"lv1_".$cnt}[$cnt2]['vHit']?> 날짜 : <?echo ${"lv1_".$cnt}[$cnt2]['vDate']?></p>
			</div>
        </div>
<?
	}
}
?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<div style="border-top:3px solid grey;margin-bottom: 15px"></div>

    <!-- Page Content -->
    <div class="container" style="min-height: 250px;">

      <!-- Related Projects Row -->
      <h3 class="my-4">PT Scheduler <?echo "(".$D_day."일차 / ".$name.")";?></h3>

      <div class="row">
<?
for($cnt=0;$cnt<count($rout);$cnt++){
	for($cnt2=0;$cnt2<count(${"lv2_".$cnt});$cnt2++){
		$datetime = explode(' ', ${"lv2_".$cnt}[$cnt2]['vDate']);
		$date = $datetime[0];
		$time = $datetime[1];
		if($date == Date('Y-m-d'))
			${"lv2_".$cnt}[$cnt2]['vDate'] = $time;
		else
			${"lv2_".$cnt}[$cnt2]['vDate'] = $date;
?>
        <div class="col-md-3 col-sm-6 mb-4">
			<div class="card">
				<a href="videoView.php?vno=<?php echo ${"lv2_".$cnt}[$cnt2]['vIdx']?>">
					<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo ${"lv2_".$cnt}[$cnt2]['vId']?>/0.jpg" alt="">
				</a>
				<p style="text-align:center;margin-top: 10px;margin-bottom: 0px;">
					<a href="videoView.php?vno=<?php echo ${"lv2_".$cnt}[$cnt2]['vIdx']?>">
					<?echo "[".${"lv2_".$cnt}[$cnt2]['vCategory2']."]"?>
					<?echo ${"lv2_".$cnt}[$cnt2]['vTitle']?></a>
				</p>
				<p style="text-align:center">조회수 : <?echo ${"lv2_".$cnt}[$cnt2]['vHit']?> 날짜 : <?echo ${"lv2_".$cnt}[$cnt2]['vDate']?></p>
			</div>
        </div>
<?
	}
}
?>
      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

<div style="border-top:3px solid grey;margin-bottom: 15px"></div>

    <!-- Page Content -->
    <div class="container" style="min-height: 250px;">

      <!-- Related Projects Row -->
      <h3 class="my-4">이런 운동은 어떠세요?</h3>

      <div class="row">
<?
for($cnt=0;$cnt<count($lv3_0);$cnt++){
	$datetime = explode(' ', $lv3_0[$cnt]['vDate']);
	$date = $datetime[0];
	$time = $datetime[1];
	if($date == Date('Y-m-d'))
		$lv3_0[$cnt]['vDate'] = $time;
	else
		$lv3_0[$cnt]['vDate'] = $date;
?>
        <div class="col-md-3 col-sm-6 mb-4">
			<div class="card">
				<a href="videoView.php?vno=<?php echo $lv3_0[$cnt]['vIdx']?>">
					<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo $lv3_0[$cnt]['vId']?>/0.jpg" alt="">
				</a>
				<p style="text-align:center;margin-top: 10px;margin-bottom: 0px;">
					<a href="videoView.php?vno=<?php echo $lv3_0[$cnt]['vIdx']?>">
					<?echo "[".$lv3_0[$cnt]['vCategory2']."]"?>
					<?echo $lv3_0[$cnt]['vTitle']?></a>
				</p>
				<p style="text-align:center">조회수 : <?echo $lv3_0[$cnt]['vHit']?> 날짜 : <?echo $lv3_0[$cnt]['vDate']?></p>
			</div>
        </div>
<?
}
?>
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
<!--
마무리 작업으로 영상 정렬 해야됌 좋아요 순? 조회수 순? 이라던지
-->