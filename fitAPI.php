<?
	//session_start();
	//header('Content-Type: text/html; charset=UTF-8');
	//header('Content-Type: application/json');

	function D_day($t1,$t2){
		 $result = intval((strtotime($t1) - strtotime($t2))/86400); //디데이 계산 공식
		 return $result;
	}

	//$servername = "localhost";
	//$username = "ccit";
	//$password = "ccit3124";
	//$dbname = "ccit";

	$userID = $_SESSION['id'];

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn->exec("SET NAMES 'utf8'");

	//사용자 데이터 출력(취향)//
	$stmt = $conn->prepare("SELECT * FROM userData WHERE id ='$userID'"); 
	$stmt->execute(); 
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

	$userData[0] = $stmt->fetch();

    $cate1 = $userData[0]['vCategory1'];//운동 목적
    $cate2 = explode(",", $userData[0]['vCategory2']);//운동 부위
	$cate3 = $userData[0]['vCategory3'];//운동 환경
    $bodyNum = count($cate2);//운동 부위 개수	

	//사용자 데이터 출력(디데이)//
	$stmt = $conn->prepare("SELECT joindate FROM member WHERE id ='$userID'");
	$stmt->execute(); 
	$userData[1] = $stmt->fetch();

	$today = date("Y-m-d");
	$memberD = $userData[1]['joindate'];

	$D_day = D_day($today,$memberD);

	//level 1 운동 부위와 + 운동 환경//
	/*$bodyNum,$cate2[],$cate3 */

	for($cnt=0;$cnt<$bodyNum;$cnt++){
		${"lv1_".$cnt} = array();

		$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vCategory2 ='$cate2[$cnt]' AND
		                        vCategory3 ='$cate3'
								ORDER BY vIdx desc LIMIT 4");
		$stmt->execute(); 

		while($row = $stmt->fetch()) {
			array_push(${"lv1_".$cnt},
				array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
				"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
		}
	}

	//level 2 가입일을 이용한 3분할 운동 제공(개인 트레이너)//
    /*0:가슴,삼두,복근 1:등,이두 2:하체,어깨 *2 / 6:휴식(팁)
	1부터 1일차(월) , 0 (휴식 : 팁)
	$D_day, $cate3
	*/
	$case = ($D_day+1) % 7;
	//$case = (0+1) % 7;

	switch ($case) {
		case 0:
			$rout = ["운동팁"];

			$lv2_0 = array();

			$stmt = $conn->prepare("SELECT * FROM hVideo 
									WHERE vCategory1 ='$rout[0]'
									ORDER BY RAND() LIMIT 8");
			$stmt->execute(); 

			while($row = $stmt->fetch()) {
				array_push($lv2_0,
					array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
					"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
			}
			print_r($lv2_0);
			break;
		
		case 1:
		case 4:
			$rout = ["가슴","삼두","복근"];
		    $name = "가슴, 삼두, 복근";

			for($cnt=0;$cnt<3;$cnt++){
				${"lv2_".$cnt} = array();

				$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vCategory2 ='$rout[$cnt]' 
				                        AND vCategory3 ='$cate3' AND vCategory1 != '운동팁'
										ORDER BY vIdx desc LIMIT 4");
				$stmt->execute(); 

				while($row = $stmt->fetch()) {
					array_push(${"lv2_".$cnt},
						array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
				"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
				}
			}
			break;
		
		case 2:
		case 5:
			$rout = ["등","이두"];
		    $name = "등, 이두";

			for($cnt=0;$cnt<2;$cnt++){
				${"lv2_".$cnt} = array();

				$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vCategory2 ='$rout[$cnt]'
				                        AND vCategory3 ='$cate3' AND vCategory1 != '운동팁'
										ORDER BY vIdx desc LIMIT 4");
				$stmt->execute(); 

				while($row = $stmt->fetch()) {
					array_push(${"lv2_".$cnt},
						array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
				"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
				}
			}
			break;
		
		case 3:
		case 6:
			$rout = ["하체","어깨"];
		    $name = "하체, 어깨";

			for($cnt=0;$cnt<2;$cnt++){
				${"lv2_".$cnt} = array();

				$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vCategory2 ='$rout[$cnt]'
				                        AND vCategory3 ='$cate3' AND vCategory1 != '운동팁'
										ORDER BY vIdx desc LIMIT 4");
				$stmt->execute(); 

				while($row = $stmt->fetch()) {
					array_push(${"lv2_".$cnt},
						array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
				"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
				}
			}
			break;
	}    

	//level 3 이런 영상은 어때요? 목적+환경 . 기본 관심 부위 제거//
	/**/
	$lv3_0 = array();

	for($cnt=0;$cnt<$bodyNum;$cnt++){
		if($cnt == $bodyNum-1){
			$lv3C .= "'".$cate2[$cnt]."'";
		}else{
			$lv3C .= "'".$cate2[$cnt]."',";
		}
	}
	$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vCategory1 ='$cate1' AND
	                        vCategory3 ='$cate3' AND 
							vCategory2 NOT IN($lv3C)
							ORDER BY RAND() LIMIT 8");
	$stmt->execute(); 

	while($row = $stmt->fetch()) {
		array_push($lv3_0,
			array("vIdx"=>$row['vIdx'],"vTitle"=>$row['vTitle'], "vId"=>$row["vId"],
				"vDate"=>$row["vDate"],"vHit"=>$row["vHit"],"vCategory2"=>$row["vCategory2"]));
	}
?>