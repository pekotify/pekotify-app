<?php
    function echo_song_premium($no = "0", $title = "title", $artist = "artist", $id = "0", $song_path = "") {
        $song_path = "http://localhost:3001/premium-songs/".$song_path;
        $html = <<<"EOT"
        <tr class="song song-premium">
            <td class="table-left">
                <p class="song-no">$no</p>
            </td>
            <td class="song-title-img">
                <div class="song-title-artist song-info">
                    <input type="hidden" value="$song_path" id="path-lagu"></input>
                    <p class="song-title">$title</p>
                    <p class="song-artist">$artist</p>
                </div>
            </td>
            <td class="table-right">
                <button class="song-play-btn" onclick="playSong('$song_path')">
                    <img class="song-play-btn-img" src="img/icon/play-button.png" alt="play button">
                    Play Song
                </button>
            </td>
        <tr>
        <script type="text/javascript" src="../js/play-premium-song.js"></script>
    EOT;
 
    echo $html;
 }

?>

