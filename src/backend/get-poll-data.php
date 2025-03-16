<?php
$postdata  = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/"><Header><KEY>DAISHIKYUDAISHUKILAP+NAISNOFEK</KEY></Header><Body><getAllReq xmlns="http://ws/"/></Body></Envelope>';

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: text/xml',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('http://soap-web/ws/Subscription?wsdl', false, $context);

echo $result;
?>