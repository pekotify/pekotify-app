async function poll(){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function (){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){
            console.log(xmlhttp.responseText);
            var xmlhttp2 = new XMLHttpRequest();
            xmlhttp2.onreadystatechange = function (){
                if (xmlhttp2.readyState == 4 && xmlhttp2.status == 200){
                    console.log(xmlhttp2.responseText);
                }
            }
            xmlhttp2.open('POST', './backend/update-subs-data.php', true)
            xmlhttp2.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xmlhttp2.send('xml='+xmlhttp.responseText);
        }
    }
    xmlhttp.open('POST', './backend/get-poll-data.php', true)
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}