<?
//상품 폼
	include 'layout/layout.php';
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	if(isset($_REQUEST['no']) && $_REQUEST['no'] != null) {
		$no = $_REQUEST['no'];
		
		$query = "SELECT * FROM wine_product WHERE idx = $no";

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
	  <form action="./api/basicReg/productI.php" method="post" name="product_form"><!--여기 링크 설정-->
		<input class="form-control" name="type" type="hidden" value="product">
        <?if(isset($no)){?>
	    <input class=" form-control" name="no" type="hidden" value="<?echo $result['idx']?>">
		<?}?>
        <h3><i class="fa fa-angle-right"></i><?if(isset($no)){echo '와인 상세보기';}else{echo '와인 등록';}?></h3>	 		

		<div class="row mt">	 
          <div class="col-lg-12" style="">
			<h4><i class="fa fa-angle-right"></i>기본 정보</h4>
            <div class="form-panel">
			  <div class="cmxform form-horizontal style-form">
				
				<div class="form-group ">
                    <label for="name" class="control-label col-lg-2"><font color="red">상품명</font></label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="name" name="name" minlength="2" type="text" required 
					  value="<?if(isset($no)){echo $result['product_name'];}?>">
                    </div>
				</div>

				<div class="form-group ">
                    <label for="opt1" class="control-label col-lg-2">Dry</label>
                    <div class="col-lg-10">

					  <select class="form-control" name="email2" id="email2" required>
						  <option value="">::선택::</option>
						  <option value="naver.com"
						  >D1</option>
						  <option value="gmail.com"
						  >D2</option>
						  <option value="hanmail.net"
						  >D3</option>
						  <option value="hotmail.com"
						  >D4</option>
						  <option value="yahoo.co.kr"
						  >D5</option>
					  </select>
					  
                      <input class=" form-control" id="opt1" name="opt1" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt1'];}?>>
                    </div>
				</div>
				
				<div class="form-group ">
                    <label for="opt2" class="control-label col-lg-2">Tannin</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt2" name="opt2" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt2'];}?>>
                    </div>
				</div>
				
				<div class="form-group ">
                    <label for="opt3" class="control-label col-lg-2">Acidity</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt3" name="opt3" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt3'];}?>>
                    </div>
				</div>
				
				<div class="form-group ">
                    <label for="opt4" class="control-label col-lg-2">Body</label>
                    <div class="col-lg-10">
                      <input class=" form-control" id="opt4" name="opt4" minlength="2" type="text"
					  <?if(isset($no)){echo 'value='.$result['opt4'];}?>>
                    </div>
				</div>
				
			  </div>
			</div>
		  </div>
          <!-- /col-lg-6 END -->
          
        </div>
        <!-- /row -->

		<div class="row mt" style="text-align:center">
          <div class="col-lg-12" style=""> 
		    <button class="btn btn-theme" type="submit">
			  <?if(isset($no)){echo '수정';}else{echo '등록';}?>
			</button>
		    <button class="btn btn-theme04" type="button" onclick="history.back(-1);">취소</button>
		  </div>
		</div>

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