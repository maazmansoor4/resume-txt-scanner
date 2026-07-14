<?php
include 'dbManager.php';

if(!isset($_GET['action']) || !isset($_GET['id']) || $_GET['action'] !== 'delete') {
    echo ("failed");

}

else {
    $id = intval($_GET['id']);
    deleteApplicant($id);
}

header("Location: index.php");
exit;
?>