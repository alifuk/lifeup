<?php

require_once 'connect.php';



$stmt = $conn->prepare('SELECT Id, link, owner, addDate, header, type FROM links WHERE owner = ? AND deleted = false ORDER BY Id DESC');
$stmt->bind_param('s', $user);
$user = $_COOKIE["LifeUpCookie"];

$stmt->execute();

$stmt->bind_result($Idecko, $link, $owner, $addDate, $header, $type);

$objekt = fopen("components/objekt.php", "r") or die("Unable to open file!");
$objektText = fread($objekt, filesize("components/objekt.php"));
fclose($objekt);

while ($stmt->fetch()) {


    $obsahujeTagy = false;

    $tagHTML = "";

    $stmt2 = $conn2->prepare('SELECT name FROM linkscontags as lct
                                LEFT JOIN tags ON lct.tagId = tags.Id WHERE linkId = ?');
    $stmt2->bind_param('s', $Idecko);
    $stmt2->execute();
    $stmt2->bind_result($tagName);

    while ($stmt2->fetch()) {
        if (isset($_GET['filterTag']) && $_GET['filterTag'] != "" && $_GET['filterTag'] == $tagName) {
            $obsahujeTagy = true;
        }
        $tagHTML = $tagHTML . '<button type="button" class="btn btn-default btn-xs tag pull-right">' . $tagName . '</button>';
    }

    $stmt2->close();

    if (isset($_GET['filterTag']) && $_GET['filterTag'] != "") {
        if ($obsahujeTagy) {
            printf($objektText, $link, $link, $Idecko, $tagHTML);
        }
    } else {
        printf($objektText, $link, $link, $Idecko, $tagHTML);
    }
    
    // printf("id: %s link: <a href='%s' target='_blank'>%s</a> %s %s  <br>", $district, $district2, $district2, $district3, $district4);
}
$stmt->close();
?>