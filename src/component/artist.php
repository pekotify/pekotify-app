<?php
        
    function echo_artist($name = "name", $status = null, $artist_id = null, $user_id = null) {
        $html = <<<"EOT"
        <div class="artist">
            <p class="artist-name">$name</p>
    EOT;
    if ($status == "PENDING") {
        $html .= <<<"EOT"
            <button class="pending-btn" onclick="" disabled>Request Pending</button>
        EOT;
    } else if ($status == "ACCEPTED") {
        $html .= <<<"EOT"
        <button class="artist-songs-btn" onClick="window.location = 'premium-artist-detail.php?artist_id=$artist_id&artist_name=$name';">View Songs</button>
    EOT;
    } else if ($status == "REJECTED") {
        $html .= <<<"EOT"
            <button class="rejected-btn" onclick="" disabled>Request Rejected</button>
        EOT;
    }
    else {
        $html .= <<<"EOT"
            <button class="subscribe-btn" onclick="((e) => subs($artist_id, $user_id))()">Subscribe</button>
        EOT;
    }
        $html .= "</div>";
    echo $html;
 }

?>