<?php
global $conn;
header('Content-Type: application/json'); // JSON Response Header
require_once 'db.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        // Fetch all records or a single record
        if (isset($_GET['id_barang'])) {
            $id = $conn->real_escape_string($_GET['id_barang']);
            $query = "SELECT * FROM tb_barang WHERE id_barang = '$id'";
        } else {
            $query = "SELECT * FROM tb_barang";
        }

        $result = $conn->query($query);
        if ($result) {
            $data = $result->fetch_all(MYSQLI_ASSOC);
            echo json_encode(["status" => "success", "data" => $data]);
        } else {
            echo json_encode(["status" => "error", "message" => "Failed to fetch data: " . $conn->error]);
        }
        break;

    case 'POST':
        // Add a new record
        $input = json_decode(file_get_contents("php://input"), true);
        $nama_barang = $input['nama_barang'];
        $harga_barang = $input['harga_barang'];
        $harga_sewa = $input['harga_sewa'];
        $qty = $input['qty'];
        $img = $input['img'];
        $id_kategori = $input['id_kategori'];

        $query = "INSERT INTO tb_barang (id_barang, nama_barang, harga_barang, harga_sewa, qty, img, id_kategori) 
                  VALUES (UUID(), '$nama_barang', '$harga_barang', '$harga_sewa', '$qty', '$img', '$id_kategori')";
        if ($conn->query($query)) {
            echo json_encode(["status" => "success", "message" => "Record added"]);
        } else {
            echo json_encode(["status" => "error", "message" => $conn->error]);
        }
        break;

    case 'PUT':
        // Parse JSON input
        parse_str(file_get_contents("php://input"), $input);

        // Check for required fields
        if (isset($input['id_barang'], $input['nama_barang'], $input['harga_barang'], $input['harga_sewa'], $input['qty'], $input['id_kategori'])) {
            $id_barang = $conn->real_escape_string($input['id_barang']);
            $nama_barang = $conn->real_escape_string(ucwords($input['nama_barang']));
            $harga_barang = $conn->real_escape_string($input['harga_barang']);
            $harga_sewa = $conn->real_escape_string($input['harga_sewa']);
            $qty = $conn->real_escape_string($input['qty']);
            $id_kategori = $conn->real_escape_string($input['id_kategori']);
            $gambar_name = null;

            // Handle file uploads if any
            if (!empty($_FILES['gambarBarang']['name'])) {
                $file_tmp = $_FILES['gambarBarang']['tmp_name'];
                $file_name = $_FILES['gambarBarang']['name'];
                $file_size = $_FILES['gambarBarang']['size'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $allowed_ext = array('jpg', 'jpeg', 'png');
                $max_size = 1044070; // 1MB

                // Check file extension and size
                if (in_array($file_ext, $allowed_ext) && $file_size <= $max_size) {
                    $gambar_name = $id_barang . '.' . $file_ext; // Rename file
                    $upload_path = __DIR__ . "/../img/barang/" . $gambar_name;

                    // Upload the new file
                    if (!move_uploaded_file($file_tmp, $upload_path)) {
                        echo json_encode(["status" => "error", "message" => "Failed to upload file."]);
                        exit;
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Invalid file type or size exceeds 1MB."]);
                    exit;
                }
            }

            // Fetch the old image if exists
            $old_img_query = "SELECT img FROM tb_barang WHERE id_barang = '$id_barang'";
            $old_img_result = $conn->query($old_img_query);
            $old_img_row = $old_img_result->fetch_assoc();
            $old_img = $old_img_row['img'];

            // Update query
            $img_field = $gambar_name ? ", img = '$gambar_name'" : ""; // Include image field only if a new one is uploaded
            $query = "UPDATE tb_barang SET 
                  nama_barang = '$nama_barang',
                  harga_barang = '$harga_barang',
                  harga_sewa = '$harga_sewa',
                  qty = '$qty',
                  id_kategori = '$id_kategori'
                  $img_field
                  WHERE id_barang = '$id_barang'";

            if ($conn->query($query)) {
                // Delete old image if a new one was uploaded
                if ($gambar_name && file_exists(__DIR__ . "/../img/barang/" . $old_img)) {
                    unlink(__DIR__ . "/../img/barang/" . $old_img);
                }
                echo json_encode(["status" => "success", "message" => "Record updated successfully."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to update record: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Missing required fields."]);
        }
        break;


    case 'DELETE':
        // Delete a record
        $input = json_decode(file_get_contents("php://input"), true);
        if (isset($input['id_barang'])) {
            $id_barang = $conn->real_escape_string($input['id_barang']);
            $query = "DELETE FROM tb_barang WHERE id_barang = '$id_barang'";
            if ($conn->query($query)) {
                echo json_encode(["status" => "success", "message" => "Record deleted"]);
            } else {
                echo json_encode(["status" => "error", "message" => "Failed to delete record: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID barang is required."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
        break;
}

$conn->close();
?>
