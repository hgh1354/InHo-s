<?
	require_once 'API/dbconn.php';
	require_once './layout.php';
	$layout = new layout;

	$vno = $_GET['vno'];
	//$page = $_GET['page'];

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$conn->exec("SET NAMES 'utf8'");

		$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vIdx=$vno");
		
		$stmt->execute();
		
		$stmt->setFetchMode(PDO::FETCH_ASSOC);

		$row= $stmt->fetch();

		//echo $row['vId'];
	}	
	catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
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
	<div class="container">

		<div style="margin-bottom: 30px"></div>

		<!-- Content Row -->
		<div class="row">

			<!-- Embedded youtube -->
			<div class="col-lg-9 mb-4">
				
				<iframe width="100%" height="400px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.youtube.com/embed/<?echo $row['vId'];?>?controls=1&amp;rel=0&amp;autohide=1"
				allowfullscreen>
				</iframe>
			   
				<div style="margin-bottom: 20px"></div>

				<div class="col-lg-120 mb-40" style="font-size: 20px;color: black;">
					<font size="2" color="red">
						<strong>#<?echo $row['vCategory1'];?>, #<?echo $row['vCategory2'];?>, 
						#<?echo $row['vCategory3'];?>, #<?echo $row['vCategory4'];?></strong>
					</font>
					</br>
					<?echo $row['vTitle'];?>
					<a href="#" style="text-align: center;">
						<font size="3">좋아요(<?echo $row['vLike'];?>)</font>
					</a>

					<a href="videoW.php?bno=<?echo $vno;?>" style="text-align: center;">
						<font size="3">수정하기</font>
					</a>
					<div style="border-top:1px solid grey;margin-top: 15px"></div>			
				</div>
				
				<div class="col-lg-120 mb-40">
					<?echo $row['vContent'];?>
				</div>
			
			</div>
			<!-- .Embedded youtube -->

			<!-- Relative Videos -->
			<div class="col-md-3 col-sm-6 mb-4">
				<h6><strong>관련 영상</strong></h6>
<?
	$sql ="SELECT * FROM hVideo WHERE vCategory1='".$row['vCategory1']."'AND
	                                  vCategory2='".$row['vCategory2']."'AND 
									  vCategory3='".$row['vCategory3']."'AND
									  vCategory4='".$row['vCategory4']."'AND
									  vIdx!=$vno ORDER BY RAND() LIMIT 4";
	$stmt = $conn->prepare($sql);
		
	$stmt->execute();
		
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	while($row= $stmt->fetch()) {
?>
				<div class="card">
					<a href="videoView.php?vno=<?php echo $row['vIdx']?>">
						<img class="img-fluid" src="https://i.ytimg.com/vi/<?echo $row['vId']?>/0.jpg" alt="">
						<div style="text-align: center;"><?echo $row['vTitle'];?></div>
					</a>
				</div>
				<div style="margin-bottom: 10px;"></div>
<?}?>
			</div>
			<!-- /. Relative Videos -->
      
		</div>
		<!-- /.row -->
	  
	</div>
	<!-- /.Page Content -->
<!--  -->

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