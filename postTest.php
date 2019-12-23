<?
session_start();
//check 박스 다중 데이터 받기 (배열 처리)
header('Content-Type: text/html; charset=utf-8');
//$_POST["data"];
//echo $_POST["data"];
//print_r($_POST["data"]);
/*
for($cnt=1;$cnt<5;$cnt++){
	echo $_POST["data"][$cnt]."<br/>";
}
*/
/*
if(!empty($_POST['data'])){
	foreach($_POST['data'] as $data){
	echo $data."<br/>";
	}
}
*/
//라디오 박스 처리
//echo $_POST["id"]."<br/>";

echo "세션 값".$_SESSION["id"]."<br/>";


echo $_POST["data"]."<br/>";
echo $_POST["data2"]."<br/>";
echo $_POST["data3"]."<br/>";
echo $_POST["data4"]."<br/>";
echo '<input type="submit" value="PRE" onclick="history.back();">';
?>