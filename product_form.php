<?
//고객 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];
		
		$query = "SELECT * FROM pioWineT WHERE idx = $no";

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
				<form action="./api/wineInsert.php" method="post" name="product_form"><!--여기 링크 설정-->
					<h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '와인 상세보기';}else{echo '와인 등록';}?></h3>	 		

					<div class="row mt">	 
						<div class="col-lg-12" style="">
							<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">				
									<div class="form-group ">
										<label for="name" class="control-label col-lg-2"><font color="red">상품명</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="name" name="name" minlength="2" type="text" 
											required value="<?if(isset($no)){echo $result['name'];}?>" <?if(isset($no)){?>readonly<?}?>>
										</div>
									</div>

									<?if(isset($no)){?>
									<div class="form-group ">
										<label for="idx" class="control-label col-lg-2"><font color="red">상품 코드</font></label>
										<div class="col-lg-10">
											<input class=" form-control" id="idx" type="text" 
											value="<?if(isset($no)){echo 'I'.$result['idx'];}?>" readonly>
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
	
						<div class="col-lg-6" style="">
							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">
									<div class="form-group ">
										<label for="Dry" class="control-label col-lg-2">Dry</label>
										<div class="col-lg-10">
											<select class="form-control" name="catagories[]" id="Dry" required>
												<option value="" <?if(isset($no)){echo "disabled='disabled'";}?>>::선택::</option>
												<option value="d1" <?if(isset($no)){if($result['Dry']!=1){echo "disabled='disabled'";}}?>>
												1</option>
												<option value="d2" <?if(isset($no)){if($result['Dry']!=2){echo "disabled='disabled'";}}?>>
												2</option>
												<option value="d3" <?if(isset($no)){if($result['Dry']!=3){echo "disabled='disabled'";}}?>>
												3</option>
												<option value="d4" <?if(isset($no)){if($result['Dry']!=4){echo "disabled='disabled'";}}?>>
												4</option>
											</select>
										</div>
									</div>

									<div class="form-group ">
										<label for="Tannin" class="control-label col-lg-2">Tannin</label>
										<div class="col-lg-10">
											<select class="form-control" name="catagories[]" id="Tannin" required>
												<option value="" <?if(isset($no)){echo "disabled='disabled'";}?>>::선택::</option>
												<option value="t1" <?if(isset($no)){if($result['Tannin']!=1){echo "disabled='disabled'";}}?>>
												1</option>
												<option value="t2" <?if(isset($no)){if($result['Tannin']!=2){echo "disabled='disabled'";}}?>>
												2</option>
												<option value="t3" <?if(isset($no)){if($result['Tannin']!=3){echo "disabled='disabled'";}}?>>
												3</option>
												<option value="t4" <?if(isset($no)){if($result['Tannin']!=4){echo "disabled='disabled'";}}?>>
												4</option>
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
										<label for="Acidity" class="control-label col-lg-2">Acidity</label>
										<div class="col-lg-10">
											<select class="form-control" name="catagories[]" id="Acidity" required>
												<option value="" <?if(isset($no)){echo "disabled='disabled'";}?>>::선택::</option>
												<option value="a1" <?if(isset($no)){if($result['Acidity']!=1){echo "disabled='disabled'";}}?>>
												1</option>
												<option value="a2" <?if(isset($no)){if($result['Acidity']!=2){echo "disabled='disabled'";}}?>>
												2</option>
												<option value="a3" <?if(isset($no)){if($result['Acidity']!=3){echo "disabled='disabled'";}}?>>
												3</option>
												<option value="a4" <?if(isset($no)){if($result['Acidity']!=4){echo "disabled='disabled'";}}?>>
												4</option>
											</select>
										</div>
									</div>

									<div class="form-group ">
										<label for="Body" class="control-label col-lg-2">Body</label>
										<div class="col-lg-10">
											<select class="form-control" name="catagories[]" id="Body" required>
												<option value="" <?if(isset($no)){echo "disabled='disabled'";}?>>::선택::</option>
												<option value="b1" <?if(isset($no)){if($result['Body']!=1){echo "disabled='disabled'";}}?>>
												1</option>
												<option value="b2" <?if(isset($no)){if($result['Body']!=2){echo "disabled='disabled'";}}?>>
												2</option>
												<option value="b3" <?if(isset($no)){if($result['Body']!=3){echo "disabled='disabled'";}}?>>
												3</option>
												<option value="b4" <?if(isset($no)){if($result['Body']!=4){echo "disabled='disabled'";}}?>>
												4</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>

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