<?php
global $conn;
header('Content-Type: application/json');
require_once 'db.php';

$query = "SELECT id_kategori, nama_kategori FROM tb_kategori";
$result = $conn->query($query);

if ($result) {
    $data = $result->fetch_all(MYSQLI_ASSOC);
    echo json_encode(["status" => "success", "data" => $data]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to fetch categories."]);
}
$conn->close();
?>
