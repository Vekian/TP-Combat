<?php
include('../config/db.php');

if (isset($_GET['id'])){
$db->exec('DELETE FROM heroes WHERE id = ' . $_GET['id'] );
}
header('Location:../index.php');