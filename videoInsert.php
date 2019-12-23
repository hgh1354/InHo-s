<?
	header('Content-Type: text/html; charset=utf-8');
	require_once 'dbconn.php';

    //잘못 된 접근 제어
	/*if(!isset($_SESSION['permit']) && $_SESSION['permit']!=1){
		echo '<script>alert("잘못된 접근입니다."); location.replace("../index.php");</script>';
		exit;
	}*/

	//$id = $_SESSION['idNo'];
	//$permit = $_SESSION['permit']; //관리자 체크

    //글 번호 이용해서 글 번호 존재 시 수정 , 없을 시 등록 //폼에 히든 처리로 넣어주자 일단은 리퀘스트로 받기
	if(isset($_REQUEST['no'])) {
		$no = $_REQUEST['no'];
	}
	
	if(!isset($no)){//글 등록 케이스 (동일 영상 아이디 존재 시 등록 불가)
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
			$conn->exec("SET NAMES 'utf8'"); //꼭 설정 해야 한글이 깨지지 않습니다.
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//중복 검사
			$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vId =:vid");
			$stmt->bindParam(':vid', $_POST['vid'], PDO::PARAM_STR);
			
			$stmt->execute(); 
            
			//글 등록
			if($stmt->rowCount()>0){
				echo'<script>alert("해당 영상은 존재합니다.");history.back();</script>';
			}else{
				$stmt = $conn->prepare("INSERT INTO hVideo (vId, vLange, vCategory1, vCategory2, vCategory3,
				                                            vCategory4, vTitle, vContent, vDate, vPost) 
									    VALUES (:vid, :range, :cate1, :cate2, :cate3, :cate4, :title, 
										        :content, :date, :id)");
				$stmt->bindParam(':vid', $vid);
				$stmt->bindParam(':range', $range);
				$stmt->bindParam(':cate1', $cate1);
				$stmt->bindParam(':cate2', $cate2);
				$stmt->bindParam(':cate3', $cate3);
				$stmt->bindParam(':cate4', $cate4);
				$stmt->bindParam(':title', $title);
				$stmt->bindParam(':content', $content);
				$stmt->bindParam(':date', $date);
				$stmt->bindParam(':id', $id);
				
				$vid = trim($_POST['vid']);
				$range = $_POST['range'];
				$cate1 = $_POST['cate1'];
				$cate2 = $_POST['cate2'];
				$cate3 = $_POST['cate3'];
				$cate4 = $_POST['cate4'];
				$title = trim($_POST['title']);
				$content = trim($_POST['content']);
				$date = date('Y-m-d H:i:s');
				$id = "test";

				$stmt->execute();

				echo'<script>alert("영상 등록 성공");location.replace("../videoW.php");</script>';
			}
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}		
	}else{//글 수정 케이스(잘못된 게시물 번호로 접근시 제어를 해야될까?)
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		
			$conn->exec("SET NAMES 'utf8'");

			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = "UPDATE hVideo 
					SET vId=:vid, vLange=:range, vCategory1=:cate1, vCategory2=:cate2, vCategory3=:cate3,
						vCategory4=:cate4, vTitle=:title, vContent=:content WHERE vIdx=:no";
			
			// Prepare statement
			$stmt = $conn->prepare($sql);

			$stmt->bindParam(':vid', $vid);
			$stmt->bindParam(':range', $range);
			$stmt->bindParam(':cate1', $cate1);
			$stmt->bindParam(':cate2', $cate2);
			$stmt->bindParam(':cate3', $cate3);
			$stmt->bindParam(':cate4', $cate4);
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':content', $content);
			$stmt->bindParam(':no', $vno);

			$vid = trim($_REQUEST['vid']);
			$range = $_REQUEST['range'];
			$cate1 = $_REQUEST['cate1'];
			$cate2 = $_REQUEST['cate2'];
			$cate3 = $_REQUEST['cate3'];
			$cate4 = $_REQUEST['cate4'];
			$title = trim($_REQUEST['title']);
			$content = trim($_REQUEST['content']);
			$vno = $no;
			// execute the query
			$stmt->execute();

			// echo a message to say the UPDATE succeeded
		    if($stmt->rowCount()==1){
				echo'<script>alert("영상 수정 성공");location.replace("../videoW.php");</script>';//로케이션 수정해야
				}
			}
		catch(PDOException $e)
			{
			echo $sql . "<br>" . $e->getMessage();
			}	
	}
	$conn = null;
?>