<?
	require_once '../dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)

	try{

		$conn->DBI(); //DB 접속

		$query ="UPDATE product_custom
				 SET opt1 = :o1, opt2 = :o2, opt3 = :o3, opt4 = :o4";

		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)

		$conn->result->bindParam(':o1', $o1); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o2', $o2); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o3', $o3); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':o4', $o4); //바인드 변수로 들어갈 변수 지정

		// UPDATE a row
		$o1 = $_POST['op1'];
		$o2 = $_POST['op2'];
		$o3 = $_POST['op3'];
		$o4 = $_POST['op4'];
		$conn->DBE();

		$complete = '<script>location.href="../../product.php";</script>';
	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)

	echo $complete;
?>