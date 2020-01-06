<?
//고객 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';


	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$conn->DBI(); //DB 접속

		$no = $_REQUEST['no'];
		
		$query = "SELECT pioUserT.name as 'user', pioWineT.name as 'wine', pioPurchaseT.date as 'date', pioPurchaseT.eventId as 'eventId', 
		                 pioPurchaseT.idx as 'idx' 
                  FROM pioPurchaseT 
                  JOIN pioUserT 
                  ON pioUserT.idx = pioPurchaseT.userIdx
                  JOIN pioWineT
                  ON pioWineT.idx = pioPurchaseT.wineIdx WHERE pioPurchaseT.idx = $no"; //조인 해야돼

		$conn->DBQ($query);	
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();
	}

	if(!isset($_REQUEST['no'])) {
		$user = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$user->DBI(); //DB 접속		
		$query = "SELECT * FROM pioUserT WHERE flag=1 ORDER BY name ASC";
		$user->DBQ($query);	
		$user->DBE(); //쿼리 실행

		$wine = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
		$wine->DBI(); //DB 접속		
		$query = "SELECT * FROM pioWineT WHERE flag=1 ORDER BY name ASC";
		$wine->DBQ($query);	
		$wine->DBE(); //쿼리 실행
	}

	$layout = new Layout;
?>
<!DOCTYPE html>
<html lang="kr">
<?$layout->CssJsFile('
<link href="css/table-responsive.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="lib/bootstrap-fileupload/bootstrap-fileupload.css" />
');?>
<?$layout->head($head);?>
<body>
	<section id="container">
		<?$layout->headerF($headerF);?>
		<?$layout->sideMenu($sideMenu);?>

		<!--main content start-->
		<section id="main-content" style="min-height:700px;">
			<section class="wrapper">
				<form action="./api/purchaseInert.php" method="post" name="product_form"><!--여기 링크 설정-->
					<h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '판매 상세보기';}else{echo '판매 등록';}?></h3>	 		

					<div class="row mt">	 
						<div class="col-lg-12" style="">
							<h4><i class="fa fa-angle-right"></i>판매 정보</h4>
<?if(isset($no)){?>
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">

									<div class="form-group ">
										<label for="idx" class="control-label col-lg-2"><font color="red">고객명</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="idx" type="text" 
											value="<?if(isset($no)){echo $result['user'];}?>" readonly>
										</div>
									</div>

									<div class="form-group ">
										<label for="idx" class="control-label col-lg-2"><font color="red">상품명</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="idx" type="text" 
											value="<?if(isset($no)){echo $result['wine'];}?>" readonly>
										</div>
									</div>

									<div class="form-group ">
										<label for="eventId" class="control-label col-lg-2"><font color="red">이벤트 아이디</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="eventId" type="text" 
											value="<?if(isset($no)){echo $result['eventId'];}?>" readonly>
										</div>
									</div>

									<div class="form-group ">
										<label for="eventId" class="control-label col-lg-2"><font color="red">판매일자</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="eventId" type="text" 
											value="<?if(isset($no)){echo $result['date'];}?>" readonly>
										</div>
									</div>

								</div>
							</div>
<?}?>
						</div>
						<!-- /col-lg-12 END -->   

<?if(!isset($no)){?>	
						<div class="col-lg-6" style="">
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">
									<div class="form-group ">
										<label for="Dry" class="control-label col-lg-2">고객명</label>
										<div class="col-lg-10">
											<select class="form-control" name="user" id="Dry" required>
												<option value="">::선택::</option>
												<?while($row = $user->DBF()) {?>
												<option value="<?=$row['idx']?>"><?echo $row['name']?></option>
												<?}?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-6" style="">
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">
									<div class="form-group ">
										<label for="Acidity" class="control-label col-lg-2">와인명</label>
										<div class="col-lg-10">
											<select class="form-control" name="wine" id="Acidity" required>
												<option value="">::선택::</option>
												<?while($row = $wine->DBF()) {?>
												<option value="<?=$row['idx']?>"><?echo $row['name']?></option>
												<?}?>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
<?}?>
					</div>
					<!-- /row -->

                    <?if(!isset($no)){?>
					<div class="row mt" style="text-align:center">
						<div class="col-lg-12" style=""> 
							<button class="btn btn-theme" type="submit">등록</button>
							<button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
						</div>
						<!-- /col-lg-12 END -->          
					</div>
					<?}?>
					<!-- /row -->

				</form>
			</section>
		</section>
		<!--main content end-->
		<?$layout->footer($footer);?>
	</section>
	<?$layout->JsFile('');?>
	<?$layout->js($js);?>
</body>
</html>