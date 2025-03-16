<?php
$postdata  = '<Envelope xmlns="http://schemas.xmlsoap.org/soap/envelope/"><Header><KEY>DAISHIKYUDAISHUKILAP+NAISNOFEK</KEY></Header><Body><request xmlns="http://ws/"><creator_id xmlns="">' . $_POST['artist_id'] . '</creator_id><user_id xmlns="">' . $_POST['user_id'] . '</user_id></request></Body></Envelope>';

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-Type: text/xml',
        'content' => $postdata
    )
);

$context  = stream_context_create($opts);

$result = file_get_contents('http://host.docker.internal:4444/ws/Subscription?wsdl', false, $context);

echo $result;
?>