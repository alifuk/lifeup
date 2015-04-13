    <?php

    require_once '../connect.php';

    $stmt = $conn->prepare('SELECT email FROM users WHERE email = ?'); 
    $stmt->bind_param('s',$email);
    $email =  $_POST['email'];
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