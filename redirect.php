<?php
include "config.php";

$id = intval($_GET['id']);

$q = "SELECT url FROM links WHERE link_id = $id";
$r = mysqli_query($conn, $q);
$data = mysqli_fetch_assoc($r);

if (!$data) {
    die("Link tidak valid");
}

$ip = $_SERVER['REMOTE_ADDR'];
$agent = $_SERVER['HTTP_USER_AGENT'];

mysqli_query($conn, "
INSERT INTO clicks (link_id, ip_address, user_agent)
VALUES ($id, '$ip', '$agent')
");

header("Location: " . $data['url']);
exit;
