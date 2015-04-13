<?php

require_once '../connect.php';
if (isset($_POST['nick']) && isset($_POST['email']) && isset($_POST['password'])) {


    $stmt = $conn->prepare('INSERT INTO users (nick, email, password)
VALUES (?,?,?)');
    $stmt->bind_param('sss', $nick, $email, $password);

    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $password = crypt($_POST['password'], '$2a$07$somesillystringforsalt');
    $stmt->execute();/*
    $stmt->bind_result($lastId,$lastId1);
    while ($stmt->fetch()) {
        echo $lastId;
    }
*/
    $stmt = $conn->prepare('SELECT Id FROM users where nick = ? AND email = ?');
    $stmt->bind_param('ss', $nick, $email);

    $nick = $_POST['nick'];
    $email = $_POST['email'];
    $stmt->execute();
    $stmt->bind_result($lastId);
    while ($stmt->fetch()) {
        echo $lastId;
         $conn->close();
         exit();
    }

    
    
    $conn->close();
    echo "NO";
} else {
    echo "ERROR";
}
?>