<?
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: application/json');
/*
$ curl -i -X POST http://localhost:7070/events.json?accessKey=$ACCESS_KEY \
-H "Content-Type: application/json" \
-d '{
  "event" : "buy",
  "entityType" : "user",
  "entityId" : "u0",
  "targetEntityType" : "item",
  "targetEntityId" : "i0",
  "eventTime" : "2014-11-10T13:00:00.123-08:00"
}'

*사용자의 데이터가 없는 경우 추천시 구매 이벤트 기반으로 점수를 먹여서 추천해줍니다.
넘겨야 하는 데이터 : 
받아야 하는 데이터 : 
*/
function setBuy($url, $key, $fields)
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

$eventTime = date("c");//들어가긴 하나 고민해 봐야할 문제

$accessKey = array('accessKey'=>'qUdgp9kyeG-uT2kl7BTl4H3iI68vWLQSkH3SAIti_6jPr_LyrJBGYoHeTLO0jAr2');

//'' 작은따옴표 사용해야 오류가 없음(규칙)
$setData = array(  
				  'event' => 'buy',
				  'entityType' => 'user',
				  'entityId' => 'u15',
				  'targetEntityType' => 'item',
				  'targetEntityId' => 'i99',
				  'eventTime' => $eventTime
			    );

$setDataJson = json_encode($setData);

$result = setBuy('http://a95a2abe.ngrok.io/events.json', $accessKey, $setDataJson);

$resultJson = json_decode($result);

$eventId = $resultJson->eventId;
$message = $resultJson->message;

echo "eventId : ".$eventId."<br/>";
echo "message : ".$message;
?>