<?
	require_once '../dbconn.php';

	switch ($_POST['type']) {
		case "manager":
			if(isset($_POST['no'])){
				$no = $_REQUEST['no'];
				
				$query ="UPDATE wine_employee
						 SET emp_id = :id, emp_pass = :pass, emp_name = :name, emp_mail = :mail,       
						     emp_phone = :phone, emp_job = :job, emp_dept = :dept, memo = :memo, 
							 emp_auth = :auth 
						 WHERE idx = $no";

			}else{
				$query ="INSERT INTO wine_employee(emp_id, emp_pass, emp_name, emp_mail, emp_phone, emp_job,										  emp_dept, memo, emp_auth)  
						 VALUES(:id, :pass, :name, :mail, :phone, :job, :dept, :memo, :auth)";
			}

			$complete = '<script>location.href="../../manager.php";</script>';//완료 후 이동페이지
			break;
        
		default:
			echo "<script>alert('잘못된 접근 입니다.');location.href='../../';</script>";
			break;
	}

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	try{
		$conn->DBQ($query); //쿼리 전달(매개변수로 쿼리 전달해야 됩니다.)
        //:id, :pass, :name, :mail, :phone, :job, :dept, :memo, :auth
		$conn->result->bindParam(':id', $id); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':pass', $pass); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':name', $name); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':mail', $mail); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':phone', $phone); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':job', $job); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':dept', $dept); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':memo', $memo); //바인드 변수로 들어갈 변수 지정
		$conn->result->bindParam(':auth', $auth); //바인드 변수로 들어갈 변수 지정

		// UPDATE a row
		$phone .= $_POST['txtMobile1'].'-';
		$phone .= $_POST['txtMobile2'].'-';
		$phone .= $_POST['txtMobile3'];

		$id = $_POST['id'];
		$pass = md5($_POST['pass']);
		$name = $_POST['name'];
		$mail = $_POST['email'];
		$job = $_POST['job'];
		$dept = $_POST['dept'];
		$memo = $_POST['comment'];

		$auth .=  $_POST['m1'];
		$auth .=  $_POST['m2'];
		$auth .=  $_POST['m3'];
		$auth .=  $_POST['m4'];
		$auth .=  $_POST['m5'];
		$auth .=  $_POST['m6'];

		$conn->DBE();

	}catch(PDOException $e){
		echo "Error: " . $e->getMessage();
	}

	$conn->DBO(); // db객체 해제 (종료)
	//echo $complete;

/*
echo $_POST['name']."<br/>";
echo $_POST['dept']."<br/>";

$phone .= $_POST['txtMobile1'].'-';
$phone .= $_POST['txtMobile2'].'-';
$phone .= $_POST['txtMobile3'];
echo $phone."<br/>";

echo $_POST['email']."<br/>";
echo $_POST['id']."<br/>";
echo $_POST['pass']."<br/>";
$auth .=  $_POST['m1'];
$auth .=  $_POST['m2'];
$auth .=  $_POST['m3'];
$auth .=  $_POST['m4'];
$auth .=  $_POST['m5'];
$auth .=  $_POST['m6'];
echo $auth."<br/>";
echo $_POST['comment']."<br/>";
*/
?>