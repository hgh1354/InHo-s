<?php 
 session_start();
 Header('Content-Type: text/html; charset=utf-8');
 require_once('dbconn.php');

$mysqli = new mysqli($servername, $username, $password, $dbname);

$id = $_POST['id'];
$password = md5($_POST['password']);

$sql="SELECT * FROM member WHERE id = '".$id."' AND password = '".$password."'";
$result = $mysqli->query($sql);
$res = $mysqli->query($sql); 
$row = $res->fetch_array(MYSQLI_ASSOC);

	if ($row != null) {
		$_SESSION['id'] = $row['id'];
		$_SESSION['per'] = $row['per'];

		echo("<script>location.href='../index.php';</script>");         
	}

	if($row == null){
		echo("<script>alert('로그인 실패(아이디나 비밀번호 확인 바립니다.)');history.back();</script>");
	}


?>

