
function deleteItem(deleteId) {


    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("POST", "./AJAX/delete.php", true);
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            //alert(xmlhttp.responseText);
            
            //$("#debug").html(xmlhttp.responseText);
            location.reload();
            //window.location.replace("main.php");

        }
    }

    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("link=" + deleteId + "&owner=" + getCookie('LifeUpCookie'));




}