    <?php

    require_once '../connect.php';

    $stmt = $conn->prepare('SELECT nick FROM users WHERE nick = ?'); 
    $stmt->bind_param('s',$nick);
    $nick =  $_POST['nick'];
    $stmt->execute();

    $stmt->bind_result($district);
    while($stmt->fetch()){
        echo "1"; 
        $stmt->close();
        exit();
    }
    $stmt->close();
    echo "0";
?>