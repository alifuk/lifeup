
<?php

require_once './connect.php';




$stmt = $conn->prepare('
        SELECT DISTINCT tags.name FROM links 
LEFT JOIN linkscontags as lct ON links.Id = lct.linkId
INNER JOIN tags ON lct.tagId = tags.Id 
WHERE links.deleted = false AND links.owner = ?');
$stmt->bind_param('s', $user);


if (isset($_GET['user']) && $_GET['user'] != "") {
    $user = $_GET['user'];
} else {
    $user = $_COOKIE["LifeUpCookie"];
}

$stmt->execute();

$stmt->bind_result($tags);

while ($stmt->fetch()) {

    echo '<a href="main.php?filterTag=' . $tags . '"  style="margin: 0 0 10px 0; display: block;"> <button type="button" class="btn btn-default btn-sm btn-block">' . $tags . '</button></a>';
}
$stmt->close();
?>







