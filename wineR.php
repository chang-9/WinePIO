<?
//와인 추천
	include 'layout/layout.php';
	include 'api/dbconn.php';

	function predict($url, $fields)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_POST, true);
		$response = curl_exec($ch);
		curl_close ($ch);
		return $response;
	}

	$user = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$user->DBI(); //DB 접속		
	$query = "SELECT * FROM pioUserT WHERE flag=1 ORDER BY name ASC";
	$user->DBQ($query);	
	$user->DBE(); //쿼리 실행

	if(isset($_REQUEST['submit'])){

		if(isset($_REQUEST['user']) && isset($_REQUEST['num'])){
			$userIdx = $_REQUEST['user'];
			$num = (int)$_REQUEST['num'];
			$userCode = 'u'.$userIdx;

			$setData = array(
							  'accessKey'=>'ibWRlqjmIuu7pWykNQSQnXRtEtQI63OkvqE8gjoN09YR3ovXTh5xTnql-0qTzPrt', 
							  'user'=>$userCode, 
							  'num'=>$num
							);

			$setDataJson = json_encode($setData);

			$result = predict('http://745e8a4d.ngrok.io/queries.json', $setDataJson);

			$resultJson = json_decode($result);
			
			$wineCode = array();

			for($i=0;$i<count($resultJson->itemScores);$i++){
				//echo "item : ".$resultJson->itemScores[$i]->item." score : ".$resultJson->itemScores[$i]->score."<br/>";
				$wineCode[$i] = mb_substr($resultJson->itemScores[$i]->item,1);
			}
			
			$inString = implode (",", $wineCode);
			//echo $inString;

			$wine = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
			$wine->DBI(); //DB 접속		
			$query = "SELECT * 
			          FROM pioWineT 
					  WHERE Idx IN ($inString)
					  ORDER BY FIELD(Idx, $inString)";
			$wine->DBQ($query);	
			$wine->DBE(); //쿼리 실행
			
		}else{
			echo '<script>alert("데이터를 선택 해주세요");</script>';
		}
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
		<section id="main-content" style="min-height:800px;">
			<section class="wrapper">

				<div class="row">
					<div class="col-lg-6">
						<h3><i class="fa fa-angle-right"></i><a href="<?=$_SERVER['PHP_SELF']?>">와인 추천</a></h3>
					</div>
				</div>

				<form id="keywordForm" method="get" action="">
					<div class="row">
						<div class="col-lg-12" style="">

							<div class="form-panel">
								<div class="cmxform form-horizontal style-form">
									<div class="row">

										<div class="col-lg-6" style="">
											<div class="form-group ">
												<label for="user" class="control-label col-lg-2">고객명</label>
												<div class="col-lg-10">
													<select class="form-control" name="user" id="user" required>
														<option value="">::선택::</option>
														<?while($row = $user->DBF()) {?>
														<option value="<?=$row['idx']?>" 
														<?if(isset($userIdx) && $userIdx == $row['idx']){?>selected="selected"<?}?>>
														<?echo $row['name']?></option>
														<?}?>
														<option value="100"
														<?if(isset($userIdx) && $userIdx == 100){?>selected="selected"<?}?>>::인기상품::</option>
													</select>
												</div>
											</div>
										</div>

										<div class="col-lg-6" style="">
											<div class="form-group ">
												<label for="num" class="control-label col-lg-2">추천개수</label>
												<div class="col-lg-10">
													<select class="form-control" name="num" id="num" required>
														<option value="">::선택::</option>
														<option value="1" <?if(isset($num) && $num == 1){?>selected="selected"<?}?>>1</option>
														<option value="2" <?if(isset($num) && $num == 2){?>selected="selected"<?}?>>2</option>
														<option value="3" <?if(isset($num) && $num == 3){?>selected="selected"<?}?>>3</option>
														<option value="4" <?if(isset($num) && $num == 4){?>selected="selected"<?}?>>4</option>
														<option value="5" <?if(isset($num) && $num == 5){?>selected="selected"<?}?>>5</option>
													</select>
												</div>
											</div>
										</div>			

										<div class="col-lg-12" style="text-align:center"> 
											<button class="btn btn-theme" type="submit" name="submit" value="Search">검색</button>
										</div>

									</div>
								</div>
							</div>

						</div>
					</div>	  
				<form>

				<div class="row mt">
					<div class="col-lg-12" style="" id="print"> 
						<section id="no-more-tables">
							<table class="table table-bordered table-hover table-striped">
								<thead class="cf" style='background-color: #BDBDBD'>
									<tr>
										<th>순위</th>
										<th>와인코드</th>
										<th>와인명</th>
									</tr>
								</thead>
								<tbody>
									<?if(isset($wine)){$cnt = 1; while($row = $wine->DBF()){?>
									<tr>
										<td data-title="순위">
											<?echo $cnt; $cnt=$cnt+1;?>
										</td>
										<td data-title="상품코드">
											<a href="product_form.php?no=<?=$row['idx']?>"><?echo "i".$row['idx']?></a>
										</td>
										<td data-title="와인명">
											<a href="product_form.php?no=<?=$row['idx']?>"><?=$row['name']?></a>
										</td>
									</tr>
									<?}}?>
								</tbody>
							</table>

						</section>
					</div>
					<!-- /col-lg-12 END -->
				</div>
				<!-- /row -->
<!--
				<div class="row" style="text-align:center">
					<div class="col-lg-12" style=""> 
						<ul class="pagination">
							<?//echo $paging;//하단 페이징 화면 출력?> 
						</ul>
					</div>
				</div>
-->
				<!-- /row -->
			</section>
		</section>
		<!--main content end-->
		<?$layout->footer($footer);?>
	</section>
<?$layout->JsFile("");?>
<?$layout->js($js);?>
</body>

</html>