<?
	require_once 'API/dbconn.php';
	require_once './layout.php';
	$layout = new layout;

	header('Content-Type: text/html; charset=utf-8');
	if(!isset($_SESSION['id'])){
		echo '<script>alert("잘못된 접근입니다. 로그인 해주세요"); history.back();</script>';
		exit;
	}else{
		$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
		
		$conn->exec("SET NAMES 'utf8'"); //꼭 설정 해야 한글이 깨지지 않습니다.
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		//중복 검사
		$stmt = $conn->prepare("SELECT * FROM userData WHERE id =:id");
		$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
		
		$stmt->execute(); 
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
		$row= $stmt->fetch();
		$array = explode(",", $row['vCategory2']);
	}

	function checkB($array,$value){
        $max = count($array);
		for($cnt=0;$cnt<$max;$cnt++){
			if($array[$cnt] == $value){
				return true;
			}
		}
		return 0;
	}
	        $check = checkB($array,"삼두");
			echo $check; 
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
		<script>
		function check_input()
		{
			var form = document.like;
			
			if (!form.data.value)
			{
				alert("Q1 항목을 선택하세요!");    
				return;
			}
			//체크박스 체크여부 확인 [동일 이름을 가진 체크박스 여러개일 경우]
			var isBodyChk = false;
			var cnt = 0;
			var arr_Body= document.getElementsByName("data2[]");
			for(var i=0;i<arr_Body.length;i++){
				if(arr_Body[i].checked == true) {
					isBodyChk = true;
					cnt ++;
					//break;
				}
			}
			if(cnt > 3){
				alert("최대 3부위까지 입력 가능합니다.");
				arr_Body.checked = false;
				return false;
			}		
			if(!isBodyChk){
				alert("운동 부위 한개 이상 선택해주세요.");
				return false;
			}
			if (!form.data3.value)
			{
				alert("Q3 항목을 선택하세요!");    
				return;
			}
			form.submit();
		}
	    </script>
	</head>
	<body>

<!-- Header Menu-->
<?$layout->menu();?>

<!-- Main -->
<div class="container" style="min-height: 500;">
	<form action="API/userDataIn.php" method="post" name="like">
		<h3 class="my-4" style="text-align: center;">Q1. 당신의 운동목표는 어떤 것인가요?</h3>
		
		<div style="margin-bottom: 30px"></div>

		<div class="row">

			<div class="col-md-6 col-sm-6 mb-4" style="text-align: center;">
				<label for="data[1]">
				<img class="img-responsive" src="images/diet.jpg" alt="" style="width: 300px;height: 230px;">
				</label>
				<div>
				<input type="radio" name="data" value="다이어트" id="data[1]"
				<?echo ($row['vCategory1']=="다이어트")?'checked="checked"':null?>>
				<label for="data[1]">살을 빼고 싶어요.(다이어트)</label>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 mb-4" style="text-align: center;">
				<label for="data[2]">
				<img class="img-responsive" src="images/wT.jpg" alt="" style="width: 300px;height: 230px;">
				</label>
				<div>
				<input type="radio" name="data" value="웨이트" id="data[2]" 
				<?echo ($row['vCategory1']=="웨이트")?'checked="checked"':null?>>
				<label for="data[2]">근육을 가지고 싶어요.(웨이트)</label>
				</div>
			</div>

			<!--<div class="col-md-4 col-sm-6 mb-4" style="text-align: center;">
				<label for="data[3]">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 300px;height: 230px;">
				</label>
				<div>
				<input type="radio" name="data" value="코어" id="data[3]"
				<?echo ($row['vCategory1']=="코어")?'checked="checked"':null?>>
				<label for="data[3]">벨런스 잡힌 바디(코어)</label>
				</div>
			</div>-->			

		</div>
		<!--row-->

		<div style="margin-top:50px;border: 2px solid black"></div>

		<h3 class="my-4" style="text-align: center;">Q2. 어느 부위를 주로 운동하길 원하나요?</h3>
		
		<div style="margin-bottom: 30px"></div>
		<div class="row" style="text-align: center;"> 

			<div class="col-md-3 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="a">
				<img class="img-responsive" src="images/diet.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="어깨" id="a"
				<?echo (checkB($array,'어깨')=="1")?'checked="checked"':null?>>
				<label for="a">어깨</label>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="b">
				<img class="img-responsive" src="images/wT.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="등" id="b"
				<?echo (checkB($array,'등')=="1")?'checked="checked"':null?>>
				<label for="b">등</label>
				</div>
			</div>

			<div class="col-md-3 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="c">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="가슴" id="c"
				<?echo (checkB($array,'가슴')=="1")?'checked="checked"':null?>>
				<label for="c">가슴</label>
				</div>
			</div>			

			<div class="col-md-3 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="d">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="삼두" id="d"
				<?echo (checkB($array,'삼두')=="1")?'checked="checked"':null?>>
				<label for="d">삼두</label>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="e">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="이두" id="e"
				<?echo (checkB($array,'이두')=="1	")?'checked="checked"':null?>>
				<label for="e">이두</label>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="f">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="복근" id="f"
				<?echo (checkB($array,'복근')=="1	")?'checked="checked"':null?>>
				<label for="f">복근</label>
				</div>
			</div>

			<div class="col-md-4 col-sm-6 mb-4" style="text-align: center;float: none; margin: 0 auto;">
				<label for="g">		
				<img class="img-responsive" src="images/core.jpg" alt="" style="width: 100%;height: 230px;">
				</label>
				<div>
				<input type="checkbox" name="data2[]" value="하체" id="g"
				<?echo (checkB($array,'하체')=="1	")?'checked="checked"':null?>>
				<label for="g">하체</label>
				</div>
			</div>
		</div>
		<!--row-->

		<div style="margin-top:50px;border: 2px solid black"></div>

		<h3 class="my-4" style="text-align: center;">Q3. 주로 어디서 운동하시나요?</h3>
		
		<div style="margin-bottom: 30px"></div>
		<div class="row">

			<div class="col-md-6 col-sm-6 mb-4" style="text-align: center;">
				<label for="data3[1]">
				<img class="img-responsive" src="images/diet.jpg" alt="" style="width: 300px;height: 230px;">
				</label>
				<div>
				<input type="radio" name="data3" value="헬스장" id="data3[1]"
				<?echo ($row['vCategory3']=="헬스장")?'checked="checked"':null?>>
				<label for="data3[1]">헬스장</label>
				</div>
			</div>

			<div class="col-md-6 col-sm-6 mb-4" style="text-align: center;">
				<label for="data3[2]">
				<img class="img-responsive" src="images/wT.jpg" alt="" style="width: 300px;height: 230px;">
				</label>
				<div>
				<input type="radio" name="data3" value="홈트레이닝" id="data3[2]"
				<?echo ($row['vCategory3']=="홈트레이닝")?'checked="checked"':null?>>
				<label for="data3[2]">집(홈트레이닝)</label>
				</div>
			</div>			

		</div>
		<!--row-->

		<div style="margin-bottom:50px;border: 2px solid black"></div>

		<div class="row">

			<div class="col-md-12 col-sm-6 mb-4" style="text-align: center;">
				<div style="float: left;"><button type="button" onclick="history.back()">이전</button></div>
				<div style="float: right;"><button type="button" onclick="check_input()">제출</button></div>
			</div>
        </div>

	</form>
	<!--form-->

</div>
<!--content-->

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