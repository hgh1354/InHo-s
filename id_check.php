<!--ID 체크 페이지 idcheck.php-->
<?
    include("dbconn.php");

    $mysqli = new mysqli($servername, $username, $password, $dbname);
    $mysqli->set_charset("utf8");

    $id=$_GET['id'];

    $sql="select * from member where id='".$id."'";
    $result = $mysqli->query($sql);
    $res = $mysqli->query($sql); 
    $row=$res->num_rows;

?>
<html>
<meta charset="utf-8">

</html>
<script type="text/javascript">
    function useid(v) {
        opener.document.all.checkid.value = 1;
        opener.document.all.id.value = v;
        window.close();
    }


    function chkid() {
        var id = document.join.id.value;
        if (id) {
            url = "id_check.php?id=" + id;
            location.href = url;
        } else {
            alert("ID를 입력하세요!");
        }
    }

    function checkid() {
        if (document.join.id.value == "") {
            alert("아이디를 입력하지 않았습니다.")
            document.join.id.focus()
            return false;
        }

        //아이디 유효성 검사 (영문소문자, 숫자만 허용)
        for (i = 0; i < document.join.id.value.length; i++) {
            ch = document.join.id.value.charAt(i)
            if (!(ch >= '0' && ch <= '9') && !(ch >= 'a' && ch <= 'z')) {
                alert("아이디는 소문자, 숫자만 입력가능합니다.")
                document.join.id.focus()
                document.join.id.select()
                return false;
            }
        }

        //아이디에 공백 사용하지 않기
        if (document.join.id.value.indexOf(" ") >= 0) {
            alert("아이디에 공백을 사용할 수 없습니다.")
            document.join.id.focus()
            document.join.id.select()
            return false;
        }

        //아이디 길이 체크 (6~12자)
        if (document.join.id.value.length < 6 || document.join.id.value.length > 12) {
            alert("아이디를 6~12자까지 입력해주세요.")
            document.join.id.focus()
            document.join.id.select()
            return false;
        }
    }
</script>
<?if($row){?>
<?=$id?>는 사용하실 수 없는 ID입니다<br />
<form>
    <input type=text name="id">
    <input type=button value="ID중복확인" onClick="chkId();">
</form>
<?}else{?>
<?=$id?>는 사용가능한 ID입니다.<br />
<a href="#" onClick="useid('<?=$id?>');">사용하기</a>
<?}?>