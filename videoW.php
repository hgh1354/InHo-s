<?
	require_once 'API/dbconn.php';
	require_once './layout.php';
	$layout = new layout;

	if($_SESSION['per'] != 1){
		echo '<script>alert("관리자만 이용가능한 서비스입니다."); location.replace("./");</script>';
		exit;
	}

	if(isset($_GET['bno'])){
		$bno = $_GET['bno']; //수정 시 활용
		try {
			$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=UTF8", $username, $password);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$conn->exec("SET NAMES 'utf8'");

			$stmt = $conn->prepare("SELECT * FROM hVideo WHERE vIdx=$bno");
			
			$stmt->execute();
			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);

			$row= $stmt->fetch();

		}	
		catch(PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
		}
	}

	$page = $_GET['page'];//페이지 이동 시 활용
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
				var f = document.board_form;
			    oEditors[0].exec("UPDATE_CONTENTS_FIELD", []);

				if (!f.vid.value || $.trim(f.vid.value) =="")
			    {
					alert("영상 아이디를 입력하세요!");    
				    f.vid.focus();
				    return;
			    }

				if(!f.range.value)
				{
				  alert("공개범위를 선택하세요");
				  f.range.focus();
				  return;
				}				
				if(!f.cate1.value)
				{
				  alert("운동목적 태그를 선택하세요");
				  f.cate1.focus();
				  return;
				}
				if(!f.cate2.value)
				{
				  alert("운동부위 태그를 선택하세요");
				  f.cate2.focus();
				  return;
				}
				if(!f.cate3.value)
				{
				  alert("운동장소 태그를 선택하세요");
				  f.cate3.focus();
				  return;
				}
				if(!f.cate4.value)
				{
				  alert("운동기구 태그를 선택하세요");
				  f.cate4.focus();
				  return;
				}

				if (!f.title.value || $.trim(f.title.value) =="")
			    {
					alert("제목을 입력하세요!");    
				    f.title.focus();
				    return;
			    } 

			    if (f.content.value == "" || f.content.value == "<p><br></p>" || f.content.value == "&nbsp;")
			    {
					alert("내용을 입력하세요!");
				    oEditors[0].exec("FOCUS");
				    return;
			    }
				f.submit();
		   }
		</script>
	</head>
	
	<body>

<!-- Header Menu-->
<?$layout->menu();?>

<!-- Form -->
<form name="board_form" method="post" action="<?php echo htmlspecialchars('API/videoInsert.php');?>">
<?php
	if(isset($bno)) {
		echo '<input type="hidden" name="no" value="' . $bno . '">';
	}
?>
	<!-- Page Content -->	
	<div class="container">
		<h3 class="my-4"><strong>영상 등록</strong></h3>

		<!-- Content Row -->
		<div class="row">

			<!-- video ID & Open range -->
		
			<div class="col-md-6 col-sm-6 mb-4">
				<input type="text" name="vid" id="vid" value="<?php echo isset($row['vId'])?$row['vId']:null?>" 
				placeholder="영상 아이디를 입력해 주세요" style="width:100%";>
			</div>

			<div class="col-md-6 col-sm-6 mb-4">
				<select name="range">
				  <option value="">공개설정</option>
				  <option value="0" <?echo ($row['vLange']==0)?'selected="selected"':null?>>전체공개</option>
				  <option value="1" <?echo ($row['vLange']==1)?'selected="selected"':null?>>비공개</option>
				</select>
			</div>

			<!-- video Category -->
			<div class="col-md-3 col-sm-6 mb-4">
				<select name="cate1">
					<option value="">운동목적 태그</option>
					<option value="다이어트" <?echo ($row['vCategory1']=="다이어트")?'selected="selected"':null?>>
					다이어트</option>
					<option value="웨이트"<?echo ($row['vCategory1']=="웨이트")?'selected="selected"':null?>>
					웨이트</option>
					<!--<option value="코어" <?echo ($row['vCategory1']=="코어")?'selected="selected"':null?>>
					코어</option>-->
					<option value="운동팁"<?echo ($row['vCategory1']=="운동팁")?'selected="selected"':null?>>
					운동팁</option>
				</select>
			</div>
			
			<div class="col-md-3 col-sm-6 mb-4">
				<select name="cate2">
					<option value="">운동부위 태그</option>
						<option value="어깨" <?echo ($row['vCategory2']=="어깨")?'selected="selected"':null?>>어깨</option>						
						<option value="등" <?echo ($row['vCategory2']=="등")?'selected="selected"':null?>>등</option>
						<option value="가슴" <?echo ($row['vCategory2']=="가슴")?'selected="selected"':null?>>가슴</option>
						<option value="삼두" <?echo ($row['vCategory2']=="삼두")?'selected="selected"':null?>>삼두</option>
						<option value="이두" <?echo ($row['vCategory2']=="이두")?'selected="selected"':null?>>이두</option>		
						<option value="복근" <?echo ($row['vCategory2']=="복근")?'selected="selected"':null?>>복근</option>		
						<option value="하체" <?echo ($row['vCategory2']=="하체")?'selected="selected"':null?>>하체</option>
				</select>
			</div>
		
			<div class="col-md-3 col-sm-6 mb-4">
				<select name="cate3">
					<option value="">운동장소 태그</option>
					<option value="헬스장" <?echo ($row['vCategory3']=="헬스장")?'selected="selected"':null?>>
					헬스장</option>
					<option value="홈트레이닝" <?echo ($row['vCategory3']=="홈트레이닝")?'selected="selected"':null?>>
					홈트레이닝</option>
				</select>
			</div>
			
			<div class="col-md-3 col-sm-6 mb-4">
				<select name="cate4">
					<option value="" selected="selected">운동기구 태그</option>
						<option value="머신" <?echo ($row['vCategory4']=="머신")?'selected="selected"':null?>>
						머신</option>
						<option value="아령" <?echo ($row['vCategory4']=="아령")?'selected="selected"':null?>>
						아령</option>
						<option value="치닝디핑" <?echo ($row['vCategory4']=="치닝디핑")?'selected="selected"':null?>>치닝디핑</option>
						<option value="밴드" <?echo ($row['vCategory4']=="밴드")?'selected="selected"':null?>>
						밴드</option>
						<option value="맨몸" <?echo ($row['vCategory4']=="맨몸")?'selected="selected"':null?>>
						맨몸</option>
				</select>
			</div>

			<!-- video Title $ Content-->
			<div class="col-md-12 col-sm-6 mb-4">		
				<div>
					<input type="text" name="title" id="title" value="<?php echo isset($row['vTitle'])?$row['vTitle']:null?>" 
					placeholder="제목을 입력해 주세요" style="width:100%";>
				</div>
				<div style="margin-bottom:10px;"></div>
				<div class="col2">
					<textarea rows="19" id="content" name="content" 
					style="resize: none;width:100%;height:100;min-width:260px;"><?php echo isset($row['vContent'])?$row['vContent']:null?></textarea>
				</div>

				<div style="margin-bottom:30px;"></div>								

				<div style="text-align:center;">
					<a href="javascript:" class="button" onclick="check_input()">확인</a>
					<a href="javascript:history.back()" class="button">취소</a>
					<div style="margin-bottom:10px;"></div>
				</div>
			</div>

		</div>
		<!-- .Content Row -->	
		
	</div>
    <!-- .Page Content -->

</form>
<!-- .Form -->

<!-- Footer -->
<?$layout->footer();?>

<!-- Scripts and Bottom structure-->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

			<script src="assets/bootstrap/js/bootstrap.bundle.min.js"></script>

			<script type="text/javascript" src="smartEditor/js/service/HuskyEZCreator.js" charset="utf-8">
			</script>
			<script type="text/javascript">
			var oEditors = [];

			nhn.husky.EZCreator.createInIFrame({

				oAppRef: oEditors,

				elPlaceHolder: "content",

				sSkinURI: "./smartEditor/SmartEditor2Skin.html",

				fCreator: "createSEditor2"

			});
			</script>
	</body>
</html>