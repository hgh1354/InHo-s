<?php
	session_start();

	Header('Content-Type: text/html; charset=utf-8');

	session_destroy();

	echo '<script>alert("로그아웃 되었습니다."); location.replace("../");</script>';
?>
