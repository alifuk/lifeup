<?php

require_once '../connect.php';
if (isset($_POST['link']) && isset($_POST['owner'])) {

    
    $stmt = $conn->prepare('UPDATE links SET deleted = true WHERE Id = ? AND owner = ?');
    $stmt->bind_param('ii', $link, $owner);

    $link = $_POST['link'];
    $owner = $_POST['owner'];
    $stmt->execute();
    
    echo $conn->error;
    $conn->close();
    echo "{ 'state':'Success'}";
} else {
    echo "{ 'state':'Missing parametres'}";
}
?>