<html>
    <body>
        <?php
        require_once 'connect.php';
        if (isset($_GET['link']) && isset($_GET['owner'])) {


            $stmt = $conn->prepare('INSERT INTO links (link, owner)
VALUES (?,?)');
            $stmt->bind_param('si', $link, $owner);

            $link = $_GET['link'];
            $owner = $_GET['owner'];
            $stmt->execute();

            $conn->close();
            echo "{ 'state':'Success'}";
        } else {
            echo "{ 'state':'Missing parametres'}";
        }
        ?>
    </body>
</html>

