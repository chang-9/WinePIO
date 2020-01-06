<?
//고객 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];
		
		$query = "SELECT * FROM pioUserT WHERE idx = $no";

		$conn->DBQ($query);	
		$conn->DBE(); //쿼리 실행
		$result = $conn->DBF();
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
				<form action="./api/userInsert.php" method="post" name="product_form"><!--여기 링크 설정-->
					<h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '고객 상세보기';}else{echo '고객 등록';}?></h3>	 		

					<div class="row mt">	 
						<div class="col-lg-12" style="">
							<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">				
									<div class="form-group ">
										<label for="name" class="control-label col-lg-2"><font color="red">고객명</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="name" name="name" minlength="2" type="text" 
											required value="<?if(isset($no)){echo $result['name'];}?>" <?if(isset($no)){?>readonly<?}?>>
										</div>
									</div>
									<?if(isset($no)){?>
									<div class="form-group ">
										<label for="idx" class="control-label col-lg-2"><font color="red">고객 코드</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="idx" type="text" 
											value="<?if(isset($no)){echo 'u'.$result['idx'];}?>" readonly>
										</div>
									</div>

									<div class="form-group ">
										<label for="eventId" class="control-label col-lg-2"><font color="red">이벤트 아이디</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="eventId" type="text" 
											value="<?if(isset($no)){echo $result['eventId'];}?>" readonly>
										</div>
									</div>
									<?}?>
								</div>
							</div>
						</div>
						<!-- /col-lg-12 END -->          
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