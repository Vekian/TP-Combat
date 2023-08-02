<?php
include('../config/db.php');
    if (isset($_POST['heal'])){
        $query = $db->prepare('UPDATE heroes SET health_point = 100');
        $query->execute();
    }
header('Location:../index.php');