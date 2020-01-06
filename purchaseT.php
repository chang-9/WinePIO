<?
//고객 폼
	include 'api/dbconn.php';

	$conn = new DBC; //PDO 객체 생성 (객체를 생성해야 DB클래스 기능(함수) 사용 가능합니다.)
	$conn->DBI(); //DB 접속

	$query = "SELECT * FROM pioUserT";

	$conn->DBQ($query);	
	$conn->DBE(); //쿼리 실행

?>
<!DOCTYPE html>
<html lang="kr">
<body>
<form>
<div>
고객 : 
	<select name="user">
	<?while($row = $conn->DBF()) {?>
		<option value="<?=$row['idx']?>"><?echo $row['name'].$row['idx']?></option>
	<?}?>
	</select>
</div>
<button>submit</button>
</form>
</body>
</html>
