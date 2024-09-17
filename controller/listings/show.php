<?php

$config = require basePath('config/db.php');
$db = new Database($config);
$id = $_GET['id'] ?? "";
$prams = [
    'id' => $id,
];
$listings = $db->query('SELECT * FROM listings WHERE id = :id', $prams)->fetch();
loadview('listings/show', ['listings' => $listings]);
