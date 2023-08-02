<?php
    include('../config/db.php');
    $id = json_decode(file_get_contents('php://input'), true);
    $stmt = $db->query('SELECT * FROM classes
                                JOIN heroes ON classes.id = heroes.class_id
                                WHERE heroes.id ="' . $id . '"');
    $hero = $stmt->fetch(PDO::FETCH_ASSOC);
    $ord = array_map('ucfirst', $hero);
    $jsonAnswer = json_encode($ord);
    echo $jsonAnswer;
?>