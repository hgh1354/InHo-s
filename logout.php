<?
	header('Content-Type: text/html; charset=utf-8');
	if(!isset($_SESSION['permit'])){
		echo '<script>alert("서비스 준비중 입니다."); history.back();</script>';
		exit;
	}
?>