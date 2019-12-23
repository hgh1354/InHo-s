<?
    session_start();
	header('Content-Type: text/html; charset=utf-8');
	require_once 'dbconn.php';

	$body = $_POST["data2"];
	$max = count($body);

	if($max<4){
		for($cnt=0;$cnt<$max;$cnt++){
			if($cnt == $max-1){
				$data2 .= $body[$cnt];
			}else{
				$data2 .= $body[$cnt].",";
			}
		}
	}else{
		echo '<script>alert("운동 부위는 3부위까지만 가능합니다.");history.back();</script>';
		exit;
	}

    if(isset($_SESSION['id'])){
						
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
			$conn->exec("SET NAMES 'utf8'"); //꼭 설정 해야 한글이 깨지지 않습니다.
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			//중복 검사
			$stmt = $conn->prepare("SELECT * FROM userData WHERE id =:id");
			$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
			
			$stmt->execute(); 
            
			//새로운 등록
			if($stmt->rowCount()==0){
				$stmt = $conn->prepare("INSERT INTO userData 
									    (id, vCategory1, vCategory2, vCategory3) 
									    VALUES (:id, :cate1, :cate2, :cate3)");
				
				$stmt->bindParam(':id', $id);
				$stmt->bindParam(':cate1', $cate1);
				$stmt->bindParam(':cate2', $cate2);
				$stmt->bindParam(':cate3', $cate3);

				$id = $_SESSION['id'];
				$cate1 = $_POST["data"];
				$cate2 = $data2;
				$cate3 = $_POST["data3"];

				$stmt->execute();
				
				if($stmt->rowCount()==1){echo'<script>alert("설문 조사 완료");location.replace("../CustomVList.php");</script>';
				}//else{echo'<script>alert("수정 하신 정보가 없습니다."); history.back();</script>';}

			}else{
				$stmt = $conn->prepare("UPDATE userData
					                    SET vCategory1=:cate1, vCategory2=:cate2, vCategory3=:cate3
										WHERE id=:id");

				$stmt->bindParam(':cate1', $cate1);
				$stmt->bindParam(':cate2', $cate2);
				$stmt->bindParam(':cate3', $cate3);
				$stmt->bindParam(':id', $id);

				$cate1 = $_POST["data"];
				$cate2 = $data2;
				$cate3 = $_POST["data3"];
				$id = $_SESSION['id'];

				$stmt->execute();
				
				if($stmt->rowCount()==1){echo'<script>alert("설문 수정 성공");location.replace("../CustomVList.php");</script>';
				}else{echo'<script>alert("수정 하신 정보가 없습니다."); history.back();</script>';}
			}

		}catch(PDOException $e) {
			echo '<script>alert("서버 에러");location.replace("../");</script>';
			echo "Error: " . $e->getMessage();
		}

	}else{
		echo '<script>alert("잘못된 접근입니다.");location.replace("../");</script>';
	}

?>