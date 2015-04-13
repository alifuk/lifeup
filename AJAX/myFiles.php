<?php

require_once 'connect.php';



$stmt = $conn->prepare('SELECT Id, link, owner, addDate, header, type FROM links WHERE owner = ?');
$stmt->bind_param('s', $user);
$user = $_COOKIE["LifeUpCookie"];

$stmt->execute();

$stmt->bind_result($Idecko, $link, $owner, $addDate, $header, $type);

$objekt = fopen("components/objekt.php", "r") or die("Unable to open file!");
$objektText = fread($objekt, filesize("components/objekt.php"));
fclose($objekt);

while ($stmt->fetch()) {
    printf($objektText, $link, $link);
    // printf("id: %s link: <a href='%s' target='_blank'>%s</a> %s %s  <br>", $district, $district2, $district2, $district3, $district4);
}
$stmt->close();
?>