

<?php

require_once '../connect.php';

//echo $_POST['link'] . $_POST['owner'] . $_POST['tags'];

if (isset($_POST['link']) && isset($_POST['owner']) && $_POST['link'] != "" && $_POST['owner'] != "" ) {


    $stmt = $conn->prepare('INSERT INTO links (link, owner)
VALUES (?,?)');
    $stmt->bind_param('si', $link, $owner);

    $link = $_POST['link'];
    $owner = $_POST['owner'];
    $stmt->execute();
    $linkId = $stmt->insert_id;


    $tagy = explode(",", $_POST['tags']);

    foreach ($tagy as $tag) {

        $stmt = $conn->prepare('SELECT Id FROM tags WHERE name = ? LIMIT 1');
        $stmt->bind_param('s', $tag);

        $stmt->execute();
        $tagId = 0;
        $stmt->bind_result($tagId);

        $existuje = false;

        while ($stmt->fetch()) {
            $existuje = true;
        }


        if (!$existuje) {

            $stmt = $conn->prepare('INSERT INTO tags (name) VALUES (?)');
            $stmt->bind_param('s', $tag);

            $stmt->execute();
            $tagId = $stmt->insert_id;
        }

        $stmt = $conn->prepare('INSERT INTO linkscontags (linkId, tagId) VALUES (?,?)');
        $stmt->bind_param('ii', $linkId, $tagId);

        $stmt->execute();
    }









    $conn->close();
} else {
    echo "{ 'state':'Missing parametres'}";
}
?>

