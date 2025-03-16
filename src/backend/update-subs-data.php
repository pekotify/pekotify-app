<?php
require_once "../config.php";
$xml = $_POST['xml'];

$xml=simplexml_load_string($xml);
$datas = [];
if ($xml === false) {
    print_r("Failed loading XML: ");
    foreach(libxml_get_errors() as $error) {
      print_r("<br>", $error->message);
    }
  } else {
    $data = $xml->xpath("//S:Body/*")[0];
    for ($i = 0; $i < count($data->children()->return); $i++) {
        $tmp = [];
        array_push($tmp,(string)$data->children()->return[$i]->item[0],(string)$data->children()->return[$i]->item[1],(string)$data->children()->return[$i]->item[2]);
        array_push($datas,$tmp);
      }
    print_r($datas);
  }

$stmt = $db->prepare("DELETE FROM subscription");
if ($stmt) {
    if ($stmt->execute()) {        
    } else {
        echo $db->error;  
    }
} else {
    echo $db->error;
}

for($i = 0;$i<count($datas);$i++){
    $stmt = $db->prepare(
        "INSERT INTO subscription(creator_id,subscriber_id,status) VALUES(?,?,?)"
    );
    if ($stmt) {
        $stmt->bind_param("iis", $datas[$i][0], $datas[$i][1], $datas[$i][2]);
        if ($stmt->execute()) {        
        } else {
            echo $db->error;  
        }
    } else {
        echo $db->error;
    }
}




// if (1) {
//     // $stmt->bind_param("iis", $artist_id, $user_id, $pending);
//     // if ($stmt->execute()) {
//     // } else {
//     //     echo $db->error;  
//     // }
// } else {
//     echo $db->error;
// }

header("location: ../premium-artists.php");
?>