<?
    include 'photoF.php';

	require_once '../dbconn.php';

	switch ($_POST['type']) {
		case "ware":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];
				
				if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] !=null){
					$query ="UPDATE wine_warehouse
							 SET ware_code = :code, ware_name = :name, ware_m = :m, ware_photo = :photo, memo = :memo 
							 WHERE idx = $no";
				}else{
					$query ="UPDATE wine_warehouse
							 SET ware_code = :code, ware_name = :name, ware_m = :m, memo = :memo 
							 WHERE idx = $no";
				}

			}else{
				$query ="INSERT INTO wine_warehouse(ware_code, ware_name, ware_m, ware_photo, memo)  
						 VALUES(:code, :name, :m, :photo, :memo)";
			}

			$complete = '<script>location.href="../../warehouse.php";</script>';//완료 후 이동페이지
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
		$conn->result->bindParam(':m', $m); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정

		if(isset($_FILES["upfile"]["name"]) && $_FILES["upfile"]["name"] != null){
			$conn->result->bindParam(':photo', $photo); //바인드 변수로 들어갈 변수 지정 (수정인데 사진이 필요 없는 경우)
			$photo = photo('./warePhoto/','warePhoto');
        }

		// UPDATE a row
		$code = $_POST['num'];
		$name = $_POST['name'];
		$m = $_POST['mname'];
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