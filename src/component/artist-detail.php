<?php
    function echo_artist_detail($artist = "Artist 1") {
        $html = <<<"EOT"
        <div class="detail-header">
            <table>
            <tr>
                <th style="width:20%"></th>
                <th style="width:80%"></th>
            </tr>
            <tr>
                <td class="album-detail-title">
                    <h1 id="album-name">$artist</h1>
                </td>
            </tr>
            </table>
        </div>
        <br>
        <br>
        <script>
            var scroll = document.querySelector('#album-name').scrollWidth;
            var newFontSize = Math.round((40/scroll) * 1700)
            console.log(newFontSize + "px");
            if (document.querySelector('#album-name').scrollWidth > document.querySelector('.album-detail-title').offsetWidth) {
                document.getElementById('album-name').style.fontSize = newFontSize + "px";        
            }  
        </script> 
    EOT;
    echo $html;
    }
    
?>
