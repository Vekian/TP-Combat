<?php
include('../config/db.php');
    if (isset($_POST['heal'])){
        $query = $db->prepare('UPDATE heroes SET health_point = 140 WHERE class_id=1');
        $query->execute();
        $query = $db->prepare('UPDATE heroes SET health_point = 100 WHERE class_id=2');
        $query->execute();
        $query = $db->prepare('UPDATE heroes SET health_point = 80 WHERE class_id=3');
        $query->execute();
        $query = $db->prepare('UPDATE heroes SET health_point = 100 WHERE class_id=4');
        $query->execute();
    }
header('Location:../index.php');