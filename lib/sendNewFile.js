

function addFile() {
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "./AJAX/linkParser.php", true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
            //location.reload();
            //window.location.replace("main.php");

        }
    }
    
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("link=" + document.getElementById("link").value + "&tags=" + document.getElementById("tags").value +
            "&owner=" + getCookie('LifeUpCookie'));



}