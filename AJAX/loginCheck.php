    <?php

    require_once '../connect.php';

    $stmt = $conn->prepare('SELECT Id FROM users WHERE email = ? OR nick = ? AND password = ?'); 
    $stmt->bind_param('sss',$nick,$nick,$password);
    $nick =  $_POST['nick'];
    
    $password = crypt($_POST['password'], '$2a$07$somesillystringforsalt');
    $stmt->execute();

    $stmt->bind_result($Idecko);
    while($stmt->fetch()){
        echo $Idecko;
        $stmt->close();
        exit();
    }
    $stmt->close();
    echo "W";
    ?>