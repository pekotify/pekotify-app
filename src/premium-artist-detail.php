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
    <link rel="stylesheet" href="css/album-detail.css"> 
    <link rel="stylesheet" href="css/music-player.css"> 
    <link rel="stylesheet" href="css/song.css">
</head>
<body>
    <div class="container">
        <div class="gradien-background-small"></div>
        <?php 
            require_once "component/sidenav.php";
            echo_sidenav(); 
        ?>
        
        <div class="album-detail">
            <?php
            require_once "component/artist-detail.php";
            $artist_name = $_GET['artist_name'];
            echo_artist_detail($artist_name);
            ?>
        <table class="song-container" cellspacing="0" cellpadding="0">
                <tr>
                    <th class="song-no-header"> <p class="song-no"># </p></th>
                    <th class="song-title-header">TITLE</th>
                    <th class="song-play-button-header"></th>
                </tr>
                <tr style="height: 12px"></tr>
                
                <?php
                require_once "component/song-premium.php";
                $user_id = $_SESSION['user_id'];
                $artist_id = $_GET['artist_id'];
                $data = file_get_contents("http://host.docker.internal:3010/user-songs/$user_id/$artist_id");
                $json = json_decode($data);
                if ($json != null) {
                    $i = 1;
                    foreach ($json as $song) {
                        echo_song_premium($i, $song->judul, $artist_name, $song->song_id, $song->audio_path);
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