<?
	require_once '../dbconn.php';

	switch ($_POST['type']) {
		case "company":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];
				$query ="UPDATE wine_company
						 SET com_code = :code, com_name = :name, com_m = :m, com_call = :call, 
						     com_phone = :phone, bank_name = :bname, bank_num = :bnum, com_address = :addr, com_mail = :email, com_fax = :fax, memo = :memo 
						 WHERE idx = $no";

			}else{
				$query ="INSERT INTO wine_company(com_code, com_name, com_m, com_call, com_phone, bank_name
												,bank_num, com_address, com_mail, com_fax, memo)  
						 VALUES(:code, :name, :m, :call, :phone, :bname, :bnum, :addr, :email, :fax, :memo)";
			}
			$complete = '<script>location.href="../../company.php";</script>';//완료 후 이동페이지
			break;

		case "store":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];
				$query ="UPDATE wine_store
						 SET store_code = :code, store_name = :name, store_m = :m, store_call = :call, 
							 store_phone = :phone, bank_name = :bname, bank_num = :bnum, store_address = :addr, 
							 store_mail = :email, store_fax = :fax, memo = :memo
						 WHERE idx = $no";
			}else{
				$query ="INSERT INTO wine_store(store_code, store_name, store_m, store_call, store_phone,    
				                                bank_name, bank_num, store_address, store_mail, 
												store_fax, memo)  
						 VALUES(:code, :name, :m, :call, :phone, :bname, :bnum, :addr, :email, :fax, :memo)";
			}
			$complete = '<script>location.href="../../store.php";</script>';//완료 후 이동페이지
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
		$conn->result->bindParam(':call', $call); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':phone', $phone); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':bname', $bname); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':bnum', $bnum); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':addr', $addr); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':email', $email); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':fax', $fax); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정

		// UPDATE a row
		$phone .= $_POST['txtMobile1'].'-';
		$phone .= $_POST['txtMobile2'].'-';
		$phone .= $_POST['txtMobile3'];
		$name = $_POST['name'];
		$code = $_POST['num'];
		$m = $_POST['mname'];
		$email = $_POST['email'];
		$addr = $_POST['address'];
		$call = $_POST['call'];
		$fax = $_POST['fax'];
		$bname = $_POST['bankName'];
		$bnum = $_POST['bankNum'];
		$memo = $_POST['comment'];
		$conn->DBE();

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	echo $complete;
?>