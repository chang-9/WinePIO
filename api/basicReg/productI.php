<?
    include 'photoF.php';

	require_once '../dbconn.php';

	switch ($_POST['type']) {
		case "product":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];
				
				if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] !=null){
					$query ="UPDATE wine_product
						     SET product_code = :code, product_name = :name, manufacturer = :menu, amount = :amt, opt1 = :o1, opt2 = :o2, 
							     opt3 = :o3, opt4 = :o4, product_photo = :photo, memo = :memo
						     WHERE idx = $no";
				}else{
					$query ="UPDATE wine_product
						     SET product_code = :code, product_name = :name, manufacturer = :menu, amount = :amt, opt1 = :o1, opt2 = :o2, 
							     opt3 = :o3, opt4 = :o4, memo = :memo
						     WHERE idx = $no";
				}

			}else{
				$query ="INSERT INTO wine_product(product_code, product_name, manufacturer, amount, opt1, opt2, opt3, opt4, product_photo, memo)  
						 VALUES(:code, :name, :menu, :amt, :o1, :o2, :o3, :o4, :photo, :memo)";
			}

			$complete = '<script>location.href="../../product.php";</script>';//완료 후 이동페이지
			break;
        
		default:
			echo "<script>alert('잘못된 접근 입니다.');location.href='../../';</script>";
			break;
	}

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	try{
		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)

		$conn->result->bindParam(':code', $code); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':name', $name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':menu', $menu); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':amt', $amt); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o1', $opt1); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o2', $opt2); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o3', $opt3); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o4', $opt4); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정

		if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] != null){
			$conn->result->bindParam(':photo', $photo); //바인드 변수로 들어갈 변수 지정 (수정인데 사진이 필요 없는 경우)
			$photo = photo('./prodPhoto/','prodPhoto');
        }

		// UPDATE a row
		$code = $_POST['num'];
		$name = $_POST['name'];
		$menu = $_POST['menu'];
		$amt = $_POST['amount'];
		$opt1 = $_POST['opt1'];
		$opt2 = $_POST['opt2'];
		$opt3 = $_POST['opt3'];
		$opt4 = $_POST['opt4'];
		$memo = $_POST['comment'];

		$conn->DBE();

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo $complete;

	//$fileP = photo('./warePhoto/','warePhoto');
	//echo $fileP; //사진경로
?>