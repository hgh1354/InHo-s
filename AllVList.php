<?
//비동기로 영상 꺼내 보자
	require_once './layout.php';
	require_once 'API/dbconn.php';
	$layout = new layout;

	$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("SET NAMES 'utf8'");

	$stmt = $conn->prepare("SELECT * FROM hVideo order by vIdx desc LIMIT 12");
	
	$stmt->execute();
	
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
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
		
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>	
		<script type="text/javascript">
			$(function() {
				//More Button
				$('.more').live("click",function() 
				{
					var ID = $(this).attr("id");
					if(ID)
					{
						$("#more"+ID).html('<img src="moreajax.gif" />');
						$.ajax({
							type: "POST",
							url: "API/ajax_Vmore.php",
							//data: "lastmsg="+ ID,
							data: {lastmsg : ID},
							cache: false,
							success: function(html){
								$("div#updates").append(html);
								$("#more"+ID).remove();
							}
						});
					}
					else
					{
						$(".morebox").html('The End');
					}
					return false;
				});
			});
		</script>

		<style>
			.morebox
			{
			font-weight:bold;
			color:#333333;
			text-align:center;
			border:solid 1px #333333;
			padding:8px;
			margin-top:8px;
			margin-bottom:8px;
			-moz-border-radius: 6px;-webkit-border-radius: 6px;
			}
			.morebox a{ color:#333333; text-decoration:none}
			.morebox a:hover{ color:#333333; text-decoration:none}
		</style>

	</head>

	<body>

<!-- Header Menu-->
<?$layout->menu();?>

<!-- fiter Form -->
<?$layout->filter('영상 검색');?>
<!-- .fiter Form -->

<div style="border-top:3px solid grey;margin-bottom: 30px"></div>

<!-- Page Content -->
<div class="container" style="min-height: 1100px;">

	<!-- Related Projects Row -->
	<div class="row" id="updates">
<?
		while($row= $stmt->fetch()) {
			$datetime = explode(' ', $row['vDate']);
			$date = $datetime[0];
			$time = $datetime[1];
			if($date == Date('Y-m-d'))
				$row['vDate'] = $time;
			else
				$row['vDate'] = $date;
?>
        <div class="col-md-3 col-sm-6 mb-4">
			<div class="card">
				<a href="videoView.php?vno=<?php echo $row['vIdx']?>">
					<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo $row['vId']?>/0.jpg" alt="">
				</a>
				<p style="text-align:center;margin-top: 10px;margin-bottom: 0px;">
					<a href="videoView.php?vno=<?php echo $row['vIdx']?>"><?echo $row['vTitle']?></a>
				</p>
				<p style="text-align:center">조회수 : <?echo $row['vHit']?> 날짜 : <?echo $row['vDate']?></p>
			</div>
        </div>
<?
			$msg_id = $row['vIdx'];
		}
		$conn = null;
?>
        <div class="col-md-12 col-sm-6 mb-4" id="more<?php echo $msg_id; ?>">
			<div class="morebox">
			<!--<div id="more<?php echo $msg_id; ?>" class="morebox">-->
				<a href="#" class="more" id="<?php echo $msg_id; ?>">더 보기</a>
			</div>
		</div>
	</div>
    <!-- .Related Projects Row -->
	
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

<!--호환성 처리 제이쿼리-->
			<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
			<script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

	</body>
</html>