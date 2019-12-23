<?
//입금 조회
	include 'layout/layout.php';
	include 'api/dbconn.php';
	include 'api/pageClass.php';
	include 'api/mypage_access.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$sql = "select total_price from depo_spend where de_sp_cate = '입금'";
  $conn->DBQ($sql);
  $conn->DBE();
  $depo = $conn->DBP();
  $depoCnt = $conn->resultRow();

  for($i=0; $i<$depoCnt; $i++)
  {
    $de_sum += preg_replace("/[^\d]/","",$depo[$i]['total_price']);
  }

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">

<?$layout->CssJsFile('<link href="css/table-responsive.css" rel="stylesheet">');?>
<?$layout->head($head);?>
<body>
  <section id="container">
	<?$layout->headerF($headerF);?>
	<?$layout->sideMenu($sideMenu);?>
    <!--main content start-->
      <!--main content start-->
    <section id="main-content">
      <section class="wrapper site-min-height">
        <div class="row mt">
          <div class="col-lg-12">
            <div class="row content-panel">

							<?
							$sql = "select * from Account_member where idx = '".$_SESSION['id']."'";
							$conn->DBQ($sql);
							$conn->DBE();
							$row = $conn->DBF();

							$sql = "select * from Account_entrepreneur where en_code = '".$row['en_code']."'";
							$conn->DBQ($sql);
							$conn->DBE();
							$row2 = $conn->DBF();

							$sql = "select * from wine_company";
							$conn->DBQ($sql);
							$conn->DBE();
							$count = $conn->resultRow();
							?>

              <div class="col-md-4 profile-text mt mb centered">
                <div class="right-divider hidden-sm hidden-xs">
                  <h4>회사명</h4>
                  <h6><?php echo $row2['en_com_name']; ?></h6>
                  <h4><?php echo $count; ?></h4>
                  <h6>거래처 개수 </h6>
                  <h4><?php echo number_format($de_sum); ?>￦ </h4>
                  <h6>이번달 수익</h6>
                </div>
              </div>
              <!-- /col-md-4 -->


              <div class="col-md-4 profile-text">
                <h3> <? echo $row['en_name']."님 안녕하세요!"; ?> </h3>
                <h6>마이페이지</h6>
                <p></p>
                <br>
              </div>
              <!-- /col-md-4 -->
              <div class="col-md-4 centered">
                <div class="profile-pic">
                  <p><img src="img/ui-sam.jpg" class="img-circle"></p>
                  <p>

					<button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypagef.php' " ><i class="" ></i> 회원정보수정</button>

					<button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypageP.php' " ><i class="" ></i> 비밀번호수정</button>

                    <button class="btn btn-theme02" onclick="location.href='http://ccit2.dothome.co.kr/wineAccount/mypageD.php' " ><i class="" ></i> 회원탈퇴신청</button>


                  </p>
                </div>
              </div>
              <!-- /col-md-4 -->
            </div>
            <!-- /row -->
          </div>
          <!-- /col-lg-12 -->

					<?
					$sql = "select substr(emp_auth, 1, 1) from wine_employee where emp_id = '".$_SESSION['emp_id']."'";
					$conn->DBQ($sql);
					$conn->DBE();
					$auth_1 = $conn->DBF();
					?>




			<div class="row mt">
				<div class="col-lg-12">

							<div class="col-lg-6">
								<div class="form-panel">
									<div class="cmxform form-horizontal style-form">

										<div class="form-group">
											<label for="date" class="control-label col-lg-2"><font color="red">아이디</font></label>
											<div class="col-lg-10">
												<input type="text" class="form-control" id="id" name="id" readonly="readonly" value="<? echo $row['id']; ?>">
											</div>
										</div>

									<div class="form-group">
										<label for="date" class="control-label col-lg-2"><font color="red">성함</font></label>
										<div class="col-lg-10">
											<input class="form-control" id="cmanager" type="text" readonly="readonly" name="manager"  required="" value="<?echo $row['en_name'];?>" >
										</div>
									</div>

								<div class="form-group">
									<label for="date" class="control-label col-lg-2"><font color="red">사업자 번호</font></label>
									<div class="col-lg-10">
										<input class="form-control" id="cmanager" type="text" readonly="readonly" name="manager" required="" value="<?echo $row2['en_code'];?>">
									</div>
								</div>

							<div class="form-group">
								<label for="date" class="control-label col-lg-2"><font color="red">이메일</font></label>
								<div class="col-lg-10">
									<input class="form-control" id="cmanager" type="text" readonly="readonly" name="manager" required="" value="<?echo $row['email'];?>">
								</div>
							</div>




<!-------------------------------------------------------------------------------------------------------------------------------------------------->
				</div>
				<!-- /cmxform form-horizontal style-form -->
			</div>
			<!-- /form-panel -->
		</div>
		<!-- /col-lg-6 -->
<!-------------------------------------------------------------------------------------------------------------------------------------------------->


		<div class="col-lg-6">
			<div class="form-panel">
				<div class="cmxform form-horizontal style-form">
				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사명</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="text" name="manager" readonly="readonly" required=""value="<?echo $row2['en_com_name'];?>" >
					</div>
				</div>


				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사 주소</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="text" name="manager" readonly="readonly" required="" value="<?echo $row2['address'];?>" >
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">팩스번호</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="fax" type="text" name="fax" readonly="readonly" required="" value="<?echo $row2['en_fax_num'];?>">
					</div>
				</div>

				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">회사전화</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="text" name="manager" readonly="readonly" required="" value="<?echo $row2['en_call_num'];?>" >
					</div>
				</div>


				<div class="form-group">
					<label for="date" class="control-label col-lg-2"><font color="red">업태</font></label>
					<div class="col-lg-10">
						<input class="form-control" id="cmanager" type="text" name="en_work_type" readonly="readonly" required="" value="<?echo $row2['en_work_type'];?>" >
					</div>
				</div>



			</div>

			</div>
		</div>
		<!-- /col-lg-6 -->
	</div>
	<!-- /col-lg-12 -->



      <!-- /wrapper -->
    </section>



    <!--main content end-->
    <?$layout->footer($footer);?>
  </section>
<?//$layout->JsFile();?>
  <?$layout->js($js);?>

</body>

</html>

<?
//https://bootsnipp.com/snippets/featured/advanced-dropdown-search
//http://ccit.cafe24.com/vaca/ajax/form.html
//https://zetawiki.com/wiki/JQuery_%ED%8F%BC_submit 제이쿼리 비동기 폼처리
//https://bootsnipp.com/snippets/featured/search-panel-with-filters
?>
