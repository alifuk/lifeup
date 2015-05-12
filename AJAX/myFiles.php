<?php

function refValues($arr) {
    if (strnatcmp(phpversion(), '5.3') >= 0) { //Reference is required for PHP 5.3+
        $refs = array();
        foreach ($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }
    return $arr;
}

require_once 'connect.php';

$anyUser = 0;
$user = "";
if (isset($_GET['user']) && $_GET['user'] != "") {
    if ($_GET['user'] == "all") {
        $anyUser = 1;
    }
    $user = $_GET['user'];
} else {
    $user = $_COOKIE["LifeUpCookie"];
}



$array_of_params[0] = "si";
$array_of_params[1] = $user;
$array_of_params[2] = $anyUser;
$strQ = "";
if (isset($_GET["filterTag"]) && $_GET["filterTag"] != "") {
    $tagy = explode(",", $_GET["filterTag"]);
    
    if (count($tagy) > 0) {
        $strQ = " AND ";
    }

    for ($i = 0; $i < count($tagy); $i++) {
        $array_of_params[0] = $array_of_params[0] . "s";
        $array_of_params[$i + 3] = $tagy[$i];
        if ($i == count($tagy) - 1) {
            $strQ = $strQ . " tags.name =? ";
        } else {
            $strQ = $strQ . " tags.name =? OR ";
        }
    }
}


$array_of_params[0] = $array_of_params[0] . "ii";

$array_of_params[count($array_of_params)] = 0;
$array_of_params[count($array_of_params)] = 1;
if (isset($_GET["filterTag"]) && $_GET["filterTag"] != "") {
    $array_of_params[count($array_of_params)-2] = count($tagy);
    $array_of_params[count($array_of_params)-1] = 0;
}

$stmt = $conn->prepare('SELECT links.Id, link, owner, links.addDate, header, type, nick, links.name, image, COUNT(links.Id) as pocetTagu
FROM links 
LEFT JOIN linkscontags as con on con.linkId = links.Id
INNER JOIN tags on con.tagId = tags.Id
INNER JOIN users ON users.Id = links.owner 
WHERE (owner = ? OR 1=?) ' . $strQ . '   AND deleted = false 
GROUP BY links.Id, link, owner, links.addDate, header, type, nick, links.name, image
HAVING (pocetTagu = ? OR 1 =?)
ORDER BY links.Id DESC');
//AND tags.name =? OR tags.name = ? HAVING pocetTagu =0
//$stmt->bind_param('si', $user, $anyUser);


call_user_func_array(array($stmt, "bind_param"), refValues($array_of_params));

$stmt->execute();

$stmt->bind_result($Idecko, $link, $owner, $addDate, $header, $type, $nick, $name, $image, $count);

$view = "Line";
if (isset($_COOKIE['view']) && $_COOKIE['view'] != "") {
    $view = $_COOKIE['view'];
}

while ($stmt->fetch()) {
    if ($name == null || $name == "") {
        $name = $link;
    }

    $query_arr = $_GET;
    $query_arr["user"] = $owner;
    $query = http_build_query($query_arr);

    $tagHTML = '<a href="main.php?' . $query . '" ><button type="button" class="tag label pull-right label-success">' . $nick . '</button></a>';

    $stmt2 = $conn2->prepare('SELECT name FROM linkscontags as lct
                                LEFT JOIN tags ON lct.tagId = tags.Id WHERE linkId = ?');
    $stmt2->bind_param('s', $Idecko);
    $stmt2->execute();
    $stmt2->bind_result($tagName);

    while ($stmt2->fetch()) {
        $maTag = true;
        if (isset($_GET['filterTag']) && $_GET['filterTag'] != "" && $_GET['filterTag'] == $tagName) {
            $obsahujeTagy = true;
        }

        $query_arr = $_GET;
        $query_arr["filterTag"] = $tagName;
        $query = http_build_query($query_arr);

        $tagHTML = $tagHTML . '<a href="main.php?' . $query . '" ><button type="button" class="tag label pull-right label-info">' . $tagName . '</button></a>';
    }

    $stmt2->close();
    

    include './components/objekt' . $view . '.php';
}

echo $stmt->error;
$stmt->close();
?>