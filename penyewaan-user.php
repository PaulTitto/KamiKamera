<?php
include 'assets/php/db.php'; // Koneksi ke database

// Ambil data barang untuk dropdown
$query_barang = "SELECT id_barang, nama_barang, harga_sewa FROM tb_barang";
$result_barang = $conn->query($query_barang);

if (!$result_barang) {
    die("Query barang gagal: " . $conn->error);
}

// Debug data barang
$data_barang = [];
while ($row = $result_barang->fetch_assoc()) {
    $data_barang[] = $row;
}
if (empty($data_barang)) {
    die("Tidak ada data barang ditemukan di database.");
}

// Fungsi untuk menghasilkan ID Transaksi
function generateIdTransaksi($conn) {
    $tanggal = date("dmy");
    $prefix = "TR" . $tanggal . "02";

    $query = "SELECT MAX(id_transaksi) AS max_id FROM tb_transaksi WHERE id_transaksi LIKE '$prefix%'";
    $result = $conn->query($query);
    if (!$result) {
        die("Query ID Transaksi gagal: " . $conn->error);
    }
    $row = $result->fetch_assoc();

    $last_id = $row['max_id'] ?? $prefix . "00";
    $last_number = (int) substr($last_id, -2);

    return $prefix . str_pad($last_number + 1, 2, "0", STR_PAD_LEFT);
}

$id_transaksi = generateIdTransaksi($conn);

// Simpan data jika form dikirim
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_pemesan = $_POST['nama_pemesan'];
    $id_barang = $_POST['id_barang'];
    $tgl_pesan = $_POST['tgl_pesan'];
    $tgl_kembali = $_POST['tgl_kembali'];
    $kartu_jaminan = $_POST['kartu_jaminan'];

    // Hitung lama sewa
    $lama_sewa = (strtotime($tgl_kembali) - strtotime($tgl_pesan)) / (60 * 60 * 24);

    // Ambil nama barang dan harga sewa dari database
    $query_barang = "SELECT nama_barang, harga_sewa FROM tb_barang WHERE id_barang = '$id_barang'";
    $result_barang = $conn->query($query_barang);
    if (!$result_barang) {
        die("Query barang gagal: " . $conn->error);
    }
    $barang = $result_barang->fetch_assoc();

    if (!$barang) {
        echo "<script>alert('Barang tidak ditemukan');</script>";
        exit;
    }

    $nama_barang = $barang['nama_barang'];
    $harga_sewa = $barang['harga_sewa'];

    // Hitung total bayar
    $total_bayar = $lama_sewa * $harga_sewa;

    // Status otomatis "dipinjam"
    $status = "dipinjam";

    // Simpan ke database
    $query_insert = "INSERT INTO tb_transaksi (id_transaksi, nama_pemesan, id_barang, nama_barang, tgl_pesan, tgl_kembali, lama_sewa, harga_sewa, total_bayar, kartu_jaminan, status)
                      VALUES ('$id_transaksi', '$nama_pemesan', '$id_barang', '$nama_barang', '$tgl_pesan', '$tgl_kembali', '$lama_sewa', '$harga_sewa', '$total_bayar', '$kartu_jaminan', '$status')";

    if ($conn->query($query_insert)) {
        echo "<script>alert('Pemesanan berhasil diproses!');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . $conn->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e90ff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-wrap: wrap;
            width: 90%;
            max-width: 900px;
        }

        h1 {
            width: 100%;
            text-align: center;
            color: #333333;
            margin-bottom: 20px;
        }

        label {
            width: 25%;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="date"], select {
            width: 70%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #cccccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .result {
            width: 70%;
            padding: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
    <script>
        function hitungOtomatis() {
            const tglPesan = new Date(document.querySelector('[name="tgl_pesan"]').value);
            const tglKembali = new Date(document.querySelector('[name="tgl_kembali"]').value);
            const hargaSewa = parseFloat(document.querySelector('[name="id_barang"] option:checked').dataset.harga);

            if (!isNaN(tglPesan) && !isNaN(tglKembali) && tglKembali > tglPesan && !isNaN(hargaSewa)) {
                const lamaSewa = (tglKembali - tglPesan) / (1000 * 60 * 60 * 24);
                document.querySelector('#lamaSewa').textContent = lamaSewa + " hari";

                const totalBayar = lamaSewa * hargaSewa;
                document.querySelector('#totalBayar').textContent = "Rp " + totalBayar.toLocaleString();
            } else {
                document.querySelector('#lamaSewa').textContent = "-";
                document.querySelector('#totalBayar').textContent = "-";
            }
        }

        function tampilkanHargaSewa() {
            const hargaSewa = parseFloat(document.querySelector('[name="id_barang"] option:checked').dataset.harga);
            if (!isNaN(hargaSewa)) {
                document.querySelector('#hargaSewa').textContent = "Rp " + hargaSewa.toLocaleString();
            } else {
                document.querySelector('#hargaSewa').textContent = "-";
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dropdownBarang = document.querySelector('[name="id_barang"]');
            dropdownBarang.addEventListener('change', function() {
                tampilkanHargaSewa();
                hitungOtomatis();
            });
        });
    </script>
</head>
<body>
    <form method="POST">
        <h1>Form Peminjaman</h1>
        <label>ID Transaksi:</label>
        <input type="text" name="id_transaksi" value="<?php echo $id_transaksi; ?>" readonly>

        <label>Nama Pemesan:</label>
        <input type="text" name="nama_pemesan" required>

        <label>Nama Barang:</label>
        <select name="id_barang" required>
            <option value="">Pilih Barang</option>
            <?php foreach ($data_barang as $row): ?>
                <option value="<?php echo $row['id_barang']; ?>" data-harga="<?php echo $row['harga_sewa']; ?>">
                    <?php echo htmlspecialchars($row['nama_barang']); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Harga Sewa:</label>
        <div class="result" id="hargaSewa">-</div>

        <label>Tanggal Pesan:</label>
        <input type="date" name="tgl_pesan" required onchange="hitungOtomatis()">

        <label>Tanggal Kembali:</label>
        <input type="date" name="tgl_kembali" required onchange="hitungOtomatis()">

        <label>Lama Sewa:</label>
        <div class="result" id="lamaSewa">-</div>

        <label>Kartu Jaminan:</label>
        <select name="kartu_jaminan" required>
            <option value="">Pilih Kartu Jaminan</option>
            <option value="KTP">KTP</option>
            <option value="SIM">SIM</option>
            <option value="KTM">KTM</option>
            <option value="KTA">KTA</option>
        </select>

        <label>Total Bayar:</label>
        <div class="result" id="totalBayar">-</div>

        <button type="submit">Rent</button>
    </form>
</body>
</html>
