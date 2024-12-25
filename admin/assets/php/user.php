<?php
include 'db.php'; // Sesuaikan dengan file koneksi Anda

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $query = "SELECT * FROM tb_user";
        $result = $conn->query($query);
        $data = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
        }
        echo json_encode(["status" => "success", "data" => $data]);
        break;
        // $query = "SELECT id_user, nama_lengkap, jk, no_telp, alamat, email FROM tb_user";
        // $result = $conn->query($query);
        // $data = [];
        // if ($result->num_rows > 0) {
        //     while ($row = $result->fetch_assoc()) {
        //         $data[] = $row;
        //     }
        //     echo json_encode(["status" => "success", "data" => $data]);
        // } else {
        //     echo json_encode(["status" => "error", "message" => "No users found."]);
        // }
        // break;
    
        case 'POST':
            error_log('Memulai proses POST.');
            $data = json_decode(file_get_contents("php://input"), true);
        
            // Pastikan data tidak kosong
            if (!empty($data['nama_lengkap']) && !empty($data['jk']) &&
                !empty($data['no_telp']) && !empty($data['alamat']) && 
                !empty($data['email']) && !empty($data['password'])) {
        
                error_log('Semua input POST valid.');
                
                // Kodifikasi ID user
                $kodifikasi = "US" . date('d') . date('m') . date('y');
                $q1 = $conn->query("SELECT * FROM tb_user WHERE id_user LIKE '$kodifikasi%'");
        
                if (!$q1) {
                    echo json_encode(["status" => "error", "message" => "Gagal mengambil data ID: " . $conn->error]);
                    break;
                }
        
                $num1 = $q1->num_rows + 1;
        
                if ($num1 > 99) {
                    $id_user = $kodifikasi . $num1;
                } elseif ($num1 > 9 && $num1 < 100) {
                    $id_user = $kodifikasi . "0" . $num1;
                } else {
                    $id_user = $kodifikasi . "00" . $num1;
                }
        
                // Mengamankan input dengan real_escape_string
                $nama_lengkap = $conn->real_escape_string($data['nama_lengkap']);
                $jk = $conn->real_escape_string($data['jk']);
                $no_telp = $conn->real_escape_string($data['no_telp']);
                $alamat = $conn->real_escape_string($data['alamat']);
                $email = $conn->real_escape_string($data['email']);
                $password = $conn->real_escape_string($data['password']); 
        
                // Query untuk insert data
                $query = "INSERT INTO tb_user (id_user, nama_lengkap, jk, no_telp, alamat, email, password) 
                            VALUES ('$id_user', '$nama_lengkap', '$jk', '$no_telp', '$alamat', '$email', '$password')";
        
                if ($conn->query($query)) {
                    echo json_encode(["status" => "success", "message" => "Pengguna berhasil ditambahkan dengan ID: $id_user"]);
                } else {
                    echo json_encode(["status" => "error", "message" => "Gagal menambahkan pengguna: " . $conn->error]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Semua field harus diisi."]);
            }
            break;
        
        
    
    case 'PUT':
        // Ambil data dari body request
        $input = json_decode(file_get_contents('php://input'), true);
        
        // Validasi input
        if (!empty($input['id_user']) && !empty($input['nama_lengkap']) && !empty($input['jk']) &&
            !empty($input['no_telp']) && !empty($input['alamat']) && !empty($input['email'])) {
                
            $id_user = $conn->real_escape_string($input['id_user']);
            $nama_lengkap = $conn->real_escape_string($input['nama_lengkap']);
            $jk = $conn->real_escape_string($input['jk']);
            $no_telp = $conn->real_escape_string($input['no_telp']);
            $alamat = $conn->real_escape_string($input['alamat']);
            $email = $conn->real_escape_string($input['email']);
    
            // Query untuk update data pengguna
            $query = "UPDATE `tb_user` SET 
                        `nama_lengkap`='$nama_lengkap', 
                        `jk`='$jk', 
                        `no_telp`='$no_telp', 
                        `alamat`='$alamat', 
                        `email`='$email' 
                        WHERE `tb_user`.`id_user`='$id_user'";
            
            if ($conn->query($query)) {
                echo json_encode(["status" => "success", "message" => "Pengguna berhasil diperbarui."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal memperbarui pengguna: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Semua field harus diisi."]);
        }
        break;
    
    case 'DELETE':
        // Ambil data dari body request
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (!empty($input['id_user'])) {
            $id_user = $conn->real_escape_string($input['id_user']);
            // Query untuk menghapus pengguna
            $query = "DELETE FROM tb_user WHERE id_user='$id_user'";
            if ($conn->query($query)) {
                echo json_encode(["status" => "success", "message" => "Pengguna berhasil dihapus."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menghapus pengguna: " . $conn->error]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID pengguna diperlukan."]);
        }
        break;
}
?>
