<?
	header('Content-Type: text/html; charset=utf-8');
	require_once 'dbconn.php';

	if(isset($_REQUEST['lastmsg']))
	{
		$lastmsg = $_REQUEST['lastmsg'];

		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("SET NAMES 'utf8'");
			$stmt = $conn->prepare("SELECT * FROM hVideo where vIdx<'$lastmsg' order by vIdx desc LIMIT 8"); 
			$stmt->execute(); 
			$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		
			while($row= $stmt->fetch()) {
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
			}//.while
		}//.try
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
?>

<div class="col-md-12 col-sm-6 mb-4" id="more<?php echo $msg_id; ?>">
	<div class="morebox">
	<!--<div id="more<?php echo $msg_id; ?>" class="morebox">-->
		<a href="#" class="more" id="<?php echo $msg_id; ?>">더 보기</a>
	</div>
</div>

<?
	}
?>