<html>
   <meta charset="utf-8">

<?php
	require_once('dbconn.php');
 
	$mysqli = new mysqli($servername, $username, $password, $dbname);
	$mysqli->set_charset("utf8");

	$id=$_POST['id'];
	$password=md5($_POST['password']);
	$name=$_POST['name'];
	$email=$_POST['email'];
	$sex=$_POST['sex'];
	$today = date("Y-m-d");

	// (입력받음)insert into 테이블명 (column-list)
	$sql = "insert into member (id, password, name, email, sex, joindate)";            
	// calues(column-list에 넣을 value-list)
	$sql = $sql. "values('$id','$password','$name','$email','$sex','$today')";
	
	if($mysqli->query($sql)){                                                              
		//echo '회원가입을 축하합니다! <p/>';                                
		//echo $name.'님 가입 되셨습니다.<p/>';                                  
		echo'<script>alert("'.$name.' 회원님 가입 되었습니다.");location.replace("../login.php");</script>';
	}else{                                                                               
		echo 'fail to insert sql';                                          
	}
	mysqli_close($mysqli);
	
?>

<!--<input type="button" value="로그인하러가기" onclick="location='../login.php'">
<form name="board_form" method="post" action="<?php echo htmlspecialchars('API/regist.php');?>">-->

</html>



