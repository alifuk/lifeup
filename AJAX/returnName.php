<?php



require_once 'connect.php';

$stmt = $conn->prepare('SELECT nick FROM users WHERE Id=? LIMIT 1 ');
$stmt->bind_param('s', $user);
$user = $_COOKIE["LifeUpCookie"];

$stmt->execute();

$stmt->bind_result($name);



while ($stmt->fetch()) {
    echo "$name";
    // printf("id: %s link: <a href='%s' target='_blank'>%s</a> %s %s  <br>", $district, $district2, $district2, $district3, $district4);
}
$stmt->close();



?>



