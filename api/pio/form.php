<!DOCTYPE html>
<html>
<body>

<h2>The select Element</h2>
<p>The select element defines a drop-down list:</p>

<form action="arrayTransT.php" method="POST">
	<div>
	Dry : 
		<select name="catagories[]">
			<option value="d1">1</option>
			<option value="d2">2</option>
			<option value="d3">3</option>
			<option value="d4">4</option>
		</select>
	</div>
	<div>
	Tannin : 
		<select name="catagories[]">
			<option value="t1">1</option>
			<option value="t2">2</option>
			<option value="t3">3</option>
			<option value="t4">4</option>
		</select>
	</div>
	<div>
	Acidity : 
		<select name="catagories[]">
			<option value="a1">1</option>
			<option value="a2">2</option>
			<option value="a3">3</option>
			<option value="a4">4</option>
		</select>
	</div>
	<div>
	Body : 
		<select name="catagories[]">
			<option value="b1">1</option>
			<option value="b2">2</option>
			<option value="b3">3</option>
			<option value="b4">4</option>
		</select>
	</div>
	<br><br>
	<input type="submit">
</form>

</body>
</html>
