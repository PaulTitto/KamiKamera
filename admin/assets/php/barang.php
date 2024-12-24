<?php
include 'db.php'; // Sesuaikan dengan file koneksi Anda

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $query = "SELECT * FROM tb_barang";
        $result = $conn->query($query);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        echo json_encode(["status" => "success", "data" => $data]);
        break;

    case 'POST':
        error_log('Memulai proses POST.');
        
        if (!empty($_POST['nama_barang']) && !empty($_POST['harga_barang']) &&
            !empty($_POST['harga_sewa']) && !empty($_POST['qty']) &&
            isset($_FILES['img']) && !empty($_POST['id_kategori'])) {
        
            error_log('Semua input POST valid.');
                
            $nama_barang = $conn->real_escape_string($_POST['nama_barang']);
            $harga_barang = $conn->real_escape_string($_POST['harga_barang']);
            $harga_sewa = $conn->real_escape_string($_POST['harga_sewa']);
            $qty = $conn->real_escape_string($_POST['qty']);
            $id_kategori = $conn->real_escape_string($_POST['id_kategori']);
            $img = $_FILES['img'];
        
            error_log('Nama Barang: ' . $nama_barang . ', Harga Barang: ' . $harga_barang);
        
            $ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));
            $allowed_ext = ['jpg', 'jpeg', 'png'];
        
            if (in_array($ext, $allowed_ext) && $img['size'] <= 1048576) {
                $img_name = uniqid() . '.' . $ext;
                $upload_path = __DIR__ . '/../img/barang/' . $img_name;
        
                if (move_uploaded_file($img['tmp_name'], $upload_path)) {
                    error_log('Gambar berhasil diunggah: ' . $upload_path);
        
                    // Generate ID Barang
                    $tanggal = date('d');
                    $bulan = date('m');
                    $result = $conn->query("SELECT COUNT(*) AS total FROM tb_barang WHERE id_kategori = '$id_kategori'");
                    $urutan = str_pad($result->fetch_assoc()['total'] + 1, 3, '0', STR_PAD_LEFT);
                    $id_barang = $id_kategori . $tanggal . $bulan . $urutan;
        
                    error_log('ID Barang: ' . $id_barang);
        
                    // Insert Query
                    $query = "INSERT INTO tb_barang (id_barang, nama_barang, harga_barang, harga_sewa, qty, img, id_kategori) 
                                VALUES ('$id_barang', '$nama_barang', '$harga_barang', '$harga_sewa', '$qty', '$img_name', '$id_kategori')";
                        
                    if ($conn->query($query)) {
                        error_log('Data berhasil ditambahkan.');
                        echo json_encode(["status" => "success", "message" => "Barang berhasil ditambahkan."]);
                    } else {
                        error_log('Query gagal: ' . $conn->error);
                        echo json_encode(["status" => "error", "message" => "Query gagal dijalankan."]);
                    }
                } else {
                    error_log('Gagal mengunggah gambar.');
                    echo json_encode(["status" => "error", "message" => "Gagal mengunggah gambar."]);
                }
            } else {
                error_log('Format gambar salah atau ukuran melebihi 1MB.');
                echo json_encode(["status" => "error", "message" => "Format gambar tidak valid atau ukuran terlalu besar."]);
            }
        } else {
            error_log('Field kosong atau tidak valid.');
            echo json_encode(["status" => "error", "message" => "Semua field harus diisi."]);
        }
        break;       

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!empty($input['id_barang']) && !empty($input['nama_barang']) &&
            !empty($input['harga_barang']) && !empty($input['harga_sewa']) &&
            !empty($input['qty']) && !empty($input['img']) && !empty($input['id_kategori'])) {

            $id_barang = $conn->real_escape_string($input['id_barang']);
            $nama_barang = $conn->real_escape_string($input['nama_barang']);
            $harga_barang = $conn->real_escape_string($input['harga_barang']);
            $harga_sewa = $conn->real_escape_string($input['harga_sewa']);
            $qty = $conn->real_escape_string($input['qty']);
            $img = $conn->real_escape_string($input['img']);
            $id_kategori = $conn->real_escape_string($input['id_kategori']);

            $query = "UPDATE tb_barang SET 
                        nama_barang='$nama_barang', 
                        harga_barang='$harga_barang', 
                        harga_sewa='$harga_sewa', 
                        qty='$qty', 
                        img='$img', 
                        id_kategori='$id_kategori' 
                      WHERE id_barang='$id_barang'";
            if ($conn->query($query)) {
                echo json_encode(["status" => "success", "message" => "Barang berhasil diperbarui."]);
            } else {
                echo json_encode(["status" => "error", "message" => $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Semua field harus diisi."]);
        }
        break;

    case 'DELETE':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!empty($input['id_barang'])) {
            $id_barang = $conn->real_escape_string($input['id_barang']);
            $query = "DELETE FROM tb_barang WHERE id_barang='$id_barang'";
            if ($conn->query($query)) {
                echo json_encode(["status" => "success", "message" => "Barang berhasil dihapus."]);
            } else {
                echo json_encode(["status" => "error", "message" => $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID barang diperlukan."]);
        }
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Method tidak valid."]);
        break;
}
?>
