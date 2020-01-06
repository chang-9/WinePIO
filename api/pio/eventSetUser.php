<?
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: application/json');
/*
$ curl -i -X POST http://localhost:7070/events.json?accessKey=$ACCESS_KEY \
-H "Content-Type: application/json" \
-d '{
  "event" : "$set",
  "entityType" : "user",
  "entityId" : "u0",
  "eventTime" : "2014-11-02T09:39:45.618-08:00"
}'
넘겨야 하는 데이터 : entityId, eventTime
받아야 하는 데이터 : eventId
*/
function setUser($url, $key, $fields)
{
    $url = $url.'?'.http_build_query($key, '', '&');
 
	$ch = curl_init(); //핸들러 초기화
    curl_setopt($ch, CURLOPT_URL, $url); //URL 지정
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); //필수
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //결과값을 return하게 되어 변수에 저장 가능
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields); //POST로 보낼 데이터 지정하기
	curl_setopt($ch, CURLOPT_POST, true); //0이 default 값이며 POST 통신을 위해 1로 설정
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}

/*
ISO 8601에 따라 표현된 날짜와 시간으로 실제 모습은 다르나... 같은 형태
(2016-10-27T17:13:40+00:00 || 2016-10-27T17:13:40Z || 20161027T171340Z)
*/
$eventTime = date("c");

$accessKey = array('accessKey'=>'qUdgp9kyeG-uT2kl7BTl4H3iI68vWLQSkH3SAIti_6jPr_LyrJBGYoHeTLO0jAr2');

//'' 작은따옴표 사용해야 오류가 없음(규칙)
$setData = array(  
				  'event' => '$set',
				  'entityType' => 'user',
				  'entityId' => 'u15',
				  'eventTime' => $eventTime
			    );

$setDataJson = json_encode($setData);

$result = setUser('http://6078bb44.ngrok.io/events.json', $accessKey, $setDataJson);

$resultJson = json_decode($result);

$eventId = $resultJson->eventId;
$message = $resultJson->message;

echo "eventId : ".$eventId."<br/>";
echo "message : ".$message;
?>
