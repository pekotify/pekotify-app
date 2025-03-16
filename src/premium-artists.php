<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/pekotify.png">
    <title>Pekotify</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link rel="stylesheet" href="css/sidenav.css"> 
    <link rel="stylesheet" href="css/premium-artists.css"> 
    <link rel="stylesheet" href="css/artist.css">
</head>
<body onload="((e) => poll())()">
    <script src="js/polling.js"></script>
    <script>
        async function subs(artist_id, user_id){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function (){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
                    console.log(xmlhttp.responseText);
                    var xmlhttp2 = new XMLHttpRequest();
                    xmlhttp2.onreadystatechange = function (){
                        if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200){
                            console.log(xmlhttp2.responseText);
                            window.location.reload();
                        }
                    }
                    xmlhttp2.open('POST', './backend/add-pending.php', true)
                    xmlhttp2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                    xmlhttp2.send('artist_id='+artist_id+'&user_id='+user_id);
                }
            }
            xmlhttp.open('POST', './backend/subscribe-artist.php', true)
            xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp.send('artist_id='+artist_id+'&user_id='+user_id);
        }
        function test(){
            console.log()
        }
    </script>
    <div class="container">
        <?php 
            require_once "component/sidenav.php";
            echo_sidenav(); 
            ?>
        <div class="premium-artists">
            <h1>Premium Artists</h1>
            <div class="premium-artists-container">
                <?php
                // echo file_get_contents("http://host.docker.internal:4444/ws/Subscription?wsdl");
                $user_id = $_SESSION['user_id'];
                require_once "component/artist.php";
                $data = file_get_contents("http://host.docker.internal:3010/singers");
                $json = json_decode($data);
                
                require_once "config.php";
                $sql = "SELECT * FROM subscription WHERE subscriber_id = $user_id";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();  
                $data = $result->fetch_all(MYSQLI_ASSOC);
                
                foreach ($json as $artist) {
                    $artistInList = false;
                    foreach ($data as $sub) {
                        if ($artist->user_id == $sub['creator_id']) {
                            echo_artist($artist->name, $sub["status"], $artist->user_id, $user_id);
                            $artistInList = true;
                            continue;
                        }
                    }
                    if (!$artistInList) {
                        echo_artist($artist->name, false, $artist->user_id, $user_id);
                    }
                }
            ?>
            </div>
        </div>
    </div>
</body>
</html>