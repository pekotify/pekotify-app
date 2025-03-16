<?php session_start();?>
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
    <link rel="stylesheet" href="css/home.css"> 
    <link rel="stylesheet" href="css/song.css"> 
    <link rel="stylesheet" href="css/music-player.css"> 
</head>
<body>
    <div class="container">
        <?php 
            require_once "component/sidenav.php";
            echo_sidenav(); 
        ?>
        <div class="home">
            <h1>Your Premium Songs</h1>
                <table class="song-container" cellspacing="0" cellpadding="0">
                <tr>
                    <th class="song-no-header"> <p class="song-no"># </p></th>
                    <th class="song-title-header">TITLE</th>
                    <th class="song-play-button-header"></th>
                </tr>
                <tr style="height: 12px"></tr>
                <?php
                    require_once "component/song-premium.php";
                    $data = file_get_contents("http://host.docker.internal:3001/user-songs/".$_SESSION['user_id']);
                    $json = json_decode($data);
                    $i = 1;
                    if ($json != null) {
                        foreach ($json as $song){
                            echo_song_premium($i, $song->judul, $song->artistName, $song->song_id, $song->audio_path);
                            $i++;
                        }  
                    }
                    else {
                        echo "<tr><td colspan='3' style='text-align: center; color: white; font-size: 20px'>No songs available</td></tr>";
                    }
                ?>
                </table>
        </div>
       
    </div>
</body>
</html>