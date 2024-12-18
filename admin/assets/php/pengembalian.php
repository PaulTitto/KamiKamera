<?php
global $conn;
header('Content-Type: application/json');
require_once 'db.php';

$request_method = $_SERVER['REQUEST_METHOD'];

if ($request_method === 'GET') {
    $query = "SELECT * FROM tb_transaksi";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $data = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $row['status'] = rand(0, 1) ? 'Aman' : 'Rusak'; // Random status
            $data[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "data" => $data
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Failed to fetch data: " . mysqli_error($conn)
        ]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method"]);
}

$conn->close();
?>
