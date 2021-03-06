<?
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: application/json');
/*
$ curl -i -X POST http://localhost:7070/events.json?accessKey=$ACCESS_KEY \
-H "Content-Type: application/json" \
-d '{
  "event" : "$set",
  "entityType" : "item",
  "entityId" : "i0",
  "properties" : {
    "categories" : ["c1", "c2"]
  }
  "eventTime" : "2014-11-02T09:39:45.618-08:00"
}'
넘겨야 하는 데이터 : 
받아야 하는 데이터 : 
*/
function setWine($url, $key, $fields)
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
				  'event' => '$set',
				  'entityType' => 'item',
				  'entityId' => 'i99',
				  'properties' => array('categories' => array('c1', 'c2')),
				  'eventTime' => $eventTime
			    );

$setDataJson = json_encode($setData);

$result = setWine('http://a95a2abe.ngrok.io/events.json', $accessKey, $setDataJson);

$resultJson = json_decode($result);

$eventId = $resultJson->eventId;
$message = $resultJson->message;

echo "eventId : ".$eventId."<br/>";
echo "message : ".$message;
?>