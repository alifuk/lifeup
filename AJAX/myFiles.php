<?php

require_once 'connect.php';



$stmt = $conn->prepare('SELECT links.Id, link, owner, addDate, header, type, nick, links.name, image FROM links INNER JOIN users ON users.Id = links.owner WHERE (owner = ? OR 1=?) AND deleted = false ORDER BY Id DESC');
$stmt->bind_param('si', $user, $anyUser);
$anyUser = 0;
if (isset($_GET['user']) && $_GET['user'] != "") {
    if ($_GET['user'] == "all") {
        $anyUser = 1;
    }
    $user = $_GET['user'];
} else {
    $user = $_COOKIE["LifeUpCookie"];
}

$stmt->execute();

$stmt->bind_result($Idecko, $link, $owner, $addDate, $header, $type, $nick, $name, $image);

$view = "Line";
if (isset($_COOKIE['view']) && $_COOKIE['view'] != "") {
    $view = $_COOKIE['view'];
}

while ($stmt->fetch()) {
    if ($name == null || $name == "") {
        $name = $link;
    }

    $obsahujeTagy = false; //jestli to obsahuje tag, který je požadován
    $maTag = false; //jestli to má libovolný tag


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

    if (isset($_GET['filterTag']) && $_GET['filterTag'] != "") {
        if ($_GET['filterTag'] == "tagless" && !$maTag) {

            include './components/objekt' . $view . '.php';
        } else if ($obsahujeTagy) {
            include './components/objekt' . $view . '.php';
            //printf($objektText, $link, $link, $Idecko, $tagHTML);
        }
    } else {
        include './components/objekt' . $view . '.php';
        //printf($objektText, $link, $link, $Idecko, $tagHTML);
    }

    // printf("id: %s link: <a href='%s' target='_blank'>%s</a> %s %s  <br>", $district, $district2, $district2, $district3, $district4);
}

echo $stmt->error;
$stmt->close();
?>