<?
	require_once '../dbconn.php';

	if(isset($_POST['chk_info']) && $_POST['chk_info'] != null){
		$multiDelete = $_POST['chk_info'];
	}else{
		echo "<script>alert('선택한 항목이 없습니다.');history.back();</script>";
		exit;
	}

	switch ($_POST['type']) {
		case "company":
			$query = "DELETE FROM wine_company WHERE idx = ";
			$complete = '<script>alert("삭제 되었습니다!");location.href="../../company.php";</script>';
			break;
		case "store":
			$query = "DELETE FROM wine_store WHERE idx = ";
			$complete = '<script>alert("삭제 되었습니다!");location.href="../../store.php";</script>';
			break;
		case "ware":
			$query = "DELETE FROM wine_warehouse WHERE idx = ";
			$complete = '<script>alert("삭제 되었습니다!");location.href="../../warehouse.php";</script>';
			break;
		case "product":
			$query = "DELETE FROM wine_product WHERE idx = ";
			$complete = '<script>alert("삭제 되었습니다!");location.href="../../product.php";</script>';
			break;
		case "manager":
			$query = "DELETE FROM wine_employee WHERE idx = ";
			$complete = '<script>alert("삭제 되었습니다!");location.href="../../manager.php";</script>';
			break;
		default:
			echo "<script>alert('잘못된 접근 입니다.');location.href='../../';</script>";
			break;
	}	

	//SQL 생성기
	function delSQL($multiDelete, $query){
		$SQL = $query.$multiDelete;
		return $SQL;
	} 

	$conn = new DBC();

	try{
		$conn->DBI();

		for($i=0; $i<count($multiDelete); $i++){
			$SQL = delSQL($multiDelete[$i],$query);
			//echo $SQL."<br/>";
			$conn->DBQ($SQL);
			$conn->DBE(); 
		}

	}catch(PDOException $e) {
		echo "Error: " . $e->getMessage();
	}
    echo $complete;
?>