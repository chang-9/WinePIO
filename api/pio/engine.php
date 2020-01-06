<?
header('Content-Type: text/html; charset=UTF-8');
//header('Content-Type: application/json');
/*
$ curl -H "Content-Type: application/json" \
-d '{ "user": "u1", "num": 4 }' \
http://localhost:8000/queries.json

넘겨야 하는 데이터 : user, num 
받아야 하는 데이터 : item, score
예측이 힘들거나 데이터가 없는 경우 인기 상품 제공
*/
function predict($url, $fields)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_POST, true);
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}

$setData = array(
			      'accessKey'=>'qUdgp9kyeG-uT2kl7BTl4H3iI68vWLQSkH3SAIti_6jPr_LyrJBGYoHeTLO0jAr2', 
			      'user'=>'u1', 
			      'num'=>4
			    );

$setDataJson = json_encode($setData);
print_r($setDataJson);
$result = predict('http://96d48532.ngrok.io/queries.json', $setDataJson);

echo "user : ".$setData['user']."<br/>";
$resultJson = json_decode($result);

//new stdClass이므로 ->식으로 접근하게 됩니다.
for($i=0;$i<count($resultJson->itemScores);$i++){
	echo "item : ".$resultJson->itemScores[$i]->item." score : ".$resultJson->itemScores[$i]->score."<br/>";
}
?>