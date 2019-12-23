<?
	require_once './layout.php';
	$layout = new layout;
?>

<!-- Top structure -->
<?$layout->structT();?>

<!-- Header Menu-->
<?$layout->menu();?>

<!-- Main -->
<body>
<div id="wrap">
    <div id="container">
        <h1 class="title">HealthTube에 오신것을 환영합니다.</h1>
        <form name="singIn" action="./signIn.php" method="post" onsubmit="return checkSubmit()">
            <div class="line">
                <p>아이디</p>
                <div class="inputArea">
                    <input type="text" name="memberId" class="memberId" />
                </div>
            </div>
            <div class="line">
                <p>비밀번호</p>
                <div class="inputArea">
                    <input type="password" name="memberPw" class="memberPw" />
                </div>
            </div>
            <div class="line">
                <input type="submit" value="로그인" class="submit" />
            </div>
        </form>
        <h3 class="title"><a href="./regist.php">회원가입 하기</a></h3>
    </div>
</div>
</body>
<!--  -->

<!-- Footer -->
<?$layout->footer();?>

<!-- Scripts and Bottom structure-->
<?$layout->structB();?>