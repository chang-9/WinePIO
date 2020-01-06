<?
header('Content-Type: text/html; charset=UTF-8');

const PASSWORD_COST = ['cost'=>12]; // cost 의 기본 값은 10

echo "{$_POST['id']}<br/>";

echo md5($_POST['pass1'])."<br/>";
echo password_hash($_POST['pass2'], PASSWORD_DEFAULT, PASSWORD_COST)."<br/>";

echo "{$_POST['name']}<br/>";
echo "{$_POST['email']}<br/>";
echo "{$_POST['phone']}<br/>";
echo "{$_POST['address']}<br/>";

echo "{$_POST['Cname']}<br/>";
echo "{$_POST['Cnum']}<br/>";
echo "{$_POST['Crepresent']}<br/>";
echo "{$_POST['Ctype']}<br/>";
echo "{$_POST['jumin']}<br/>";
echo "{$_POST['call']}<br/>";
echo "{$_POST['fax']}<br/>";

echo "{$_POST['Cpage']}<br/>";
echo "{$_POST['Cemail']}<br/>";
echo "{$_FILES['upfile']['name']}<br/>";
?>
<pre>
id
pass1
pass2
name
email
phone
address

Cname 회사이름
Cnum 사업자번호
Crepresent 대표자	
Ctype 업태 
jumin
call
fax

Cpage 대표 홈페이지
Cemail 대표 이메일
upfile 사진 업로드 
</pre>