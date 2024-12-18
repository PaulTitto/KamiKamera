<?php
global $conn;
header('Content-Type: application/json');
require_once 'db.php'; // Database connection

$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$category = isset($_GET['k']) ? $_GET['k'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = 12;
$offset = ($page - 1) * $limit;

// Base query
$query = "SELECT * FROM tb_barang";
$conditions = [];

// Category filter
if ($category !== 'all') {
    $conditions[] = "id_kategori = '$category'";
}

// Search filter
if (!empty($search)) {
    $conditions[] = "nama_barang LIKE '%$search%'";
}

// Combine conditions if any
if (count($conditions) > 0) {
    $query .= " WHERE " . implode(' AND ', $conditions);
}

// Add LIMIT for pagination
$query .= " LIMIT $limit OFFSET $offset";

// Execute the query
$result = $conn->query($query);
$data = $result->fetch_all(MYSQLI_ASSOC);

// Total records
$totalQuery = "SELECT COUNT(*) as total FROM tb_barang";
if (count($conditions) > 0) {
    $totalQuery .= " WHERE " . implode(' AND ', $conditions);
}
$totalResult = $conn->query($totalQuery);
$total = $totalResult->fetch_assoc()['total'];
$totalPages = ceil($total / $limit);

echo json_encode([
    "status" => "success",
    "data" => $data,
    "pagination" => [
        "current_page" => $page,
        "total_pages" => $totalPages
    ]
]);
$conn->close();
?>
