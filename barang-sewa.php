<?php
global $conn;
include 'assets/php/db.php';


$halaman = 12; // items per page
$page = isset($_GET['p']) ? (int)$_GET["p"] : 1;
$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;

$category = isset($_GET['k']) ? htmlspecialchars($_GET['k']) : 'all';
$search = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';
$path = 'admin/assets/img/barang/';

// Get categories
$qKategori = $conn->query("SELECT * FROM tb_kategori");

// Fetch total rows for pagination
if ($category === 'all') {
    $sqlTotal = "SELECT * FROM tb_barang";
} else {
    $sqlTotal = "SELECT * FROM tb_barang WHERE id_kategori=?";
}

$stmtTotal = $conn->prepare($sqlTotal);
if ($category !== 'all') {
    $stmtTotal->bind_param("s", $category);
}
$stmtTotal->execute();
$totalResult = $stmtTotal->get_result();
$total = $totalResult->num_rows;
$pages = ceil($total / $halaman);

// Fetch products based on category and search
if (!empty($search)) {
    if ($category === 'all') {
        $query = "SELECT * FROM tb_barang WHERE nama_barang LIKE ? LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bind_param("sii", $searchTerm, $mulai, $halaman);
    } else {
        $query = "SELECT * FROM tb_barang WHERE id_kategori = ? AND nama_barang LIKE ? LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bind_param("ssii", $category, $searchTerm, $mulai, $halaman);
    }
} else {
    if ($category === 'all') {
        $query = "SELECT * FROM tb_barang LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $mulai, $halaman);
    } else {
        $query = "SELECT * FROM tb_barang WHERE id_kategori = ? LIMIT ?, ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $category, $mulai, $halaman);
    }
}
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>KamiKamera RENCAMS | Online</title>

    <!-- Styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href="assets/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">
    <link href="assets/css/creative.css" rel="stylesheet">
    <style>
        .float {
            position: fixed;
            width: 60px;
            height: 60px;
            bottom: 40px;
            right: 20px;
            color: #FFF;
            border-radius: 50px;
            text-align: center;
            z-index: 99;
        }
        .my-float {
            margin-top: 1px;
        }
        .form-inline {
            display: flex;
            align-items: center; /* Vertikal rata tengah */
            gap: 8px; /* Jarak antar elemen */
        }

        .form-inline .form-control {
            flex: 1; /* Input field mengambil sisa ruang */
        }
        .pagination .page-link {
            color: #2ebdff; /* Biru */
            border: 1px solid#2ebdff;
            margin: 0 2px;
        }

        .pagination .page-link:hover {
            background-color:#2ebdff;
            color: white;
        }

        .pagination .active .page-link {
            background-color:#2ebdff;
            color: white;
            border-color:#2ebdff;
        }
        .pagination-container{
            margin-top: 40px;
        }
        /* Tambahkan margin antara daftar barang dan pagination */
        .row + .row {
            margin-top: 20px;
        
        }
        /* Gaya untuk kategori dropdown */
        form select.form-control:focus {
            border-color: #2ebdff;
            box-shadow: 0 0 0 0.2rem rgba(46, 189, 255, 0.5);
        }
        /* Gaya untuk input search saat fokus */
        form input.form-control:focus {
            border-color: #2ebdff;
            box-shadow: 0 0 0 0.2rem rgba(46, 189, 255, 0.5);
        }
        /* Gaya untuk tombol pencarian */
        form button.btn-primary {
            border-color: #2ebdff; /* Default border color */
        }

        form button.btn-primary:focus,
        form button.btn-primary:active {
            background-color: #2ebdff !important;
            border-color: #2ebdff !important;
            box-shadow: 0 0 0 0.2rem rgba(46, 189, 255, 0.5);
        }
    </style>
</head>

<body id="page-top">
<?php include 'assets/menu/navbar.php'; ?>

<!-- Services Section -->
<section class="page-section" id="services">
    <div class="container">
        <button class="btn btn-primary float" onclick="window.location.assign('home#online')">
            <span class="fas fa-2x fa-shopping-basket my-float"></span>
        </button>

        <h2 class="text-center">Barang Sewa</h2>
        <hr class="divider-primary my-4">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <form method="GET">
                <label>Kategori:</label>
                <select name="k" class="form-control" onchange="this.form.submit()">
                    <option value="all" <?= $category === 'all' ? 'selected' : '' ?>>Semua</option>
                    <?php while ($tmp = $qKategori->fetch_assoc()) { ?>
                        <option value="<?= htmlspecialchars($tmp['id_kategori']); ?>" <?= $tmp['id_kategori'] === $category ? 'selected' : '' ?>>
                            <?= htmlspecialchars($tmp['nama_kategori']); ?>
                        </option>
                    <?php } ?>
                </select>
            </form>
            <form method="GET" class="form-inline">
                <input type="hidden" name="k" value="<?= htmlspecialchars($category); ?>">
                <input type="text" name="search" placeholder="Cari Barang..." class="form-control mr-2" value="<?= htmlspecialchars($search); ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div>

        <div class="row">
            <?php while ($hasil = $result->fetch_assoc()) {
                $namaBarang = (strlen($hasil['nama_barang']) > 16) ? substr($hasil['nama_barang'], 0, 16) . "..." : $hasil['nama_barang'];
                $status = $hasil['qty'] >= 2 ? '<span class="badge badge-success">Tersedia</span>' :
                    ($hasil['qty'] > 0 ? '<span class="badge badge-warning">Hampir Habis</span>' :
                        '<span class="badge badge-secondary">Tidak Tersedia</span>');
                ?>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="mt-4">
                        <div class="card" style="width:270px">
                            <img class="card-img-top" src="<?= $path . htmlspecialchars($hasil['img']); ?>" alt="Barang Image">
                            <div class="card-body">
                                <h5 class="card-title" data-toggle="tooltip" title="<?= htmlspecialchars($hasil['nama_barang']); ?>">
                                    <?= htmlspecialchars($namaBarang); ?>
                                </h5>
                                <p class="card-text"><?= rupiah($hasil['harga_sewa']); ?> / Hari</p>
                                <?= $status; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="row pagination-container">
        <div class="col-md-12 text-center">
            <nav>
                <ul class="pagination justify-content-center">
                    <?php if ($page > 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?k=<?= htmlspecialchars($category); ?>&search=<?= htmlspecialchars($search); ?>&p=<?= $page - 1; ?>">
                                Previous
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php for ($i = 1; $i <= $pages; $i++) : ?>
                        <li class="page-item <?= $i === $page ? 'active' : ''; ?>">
                            <a class="page-link" href="?k=<?= htmlspecialchars($category); ?>&search=<?= htmlspecialchars($search); ?>&p=<?= $i; ?>">
                                <?= $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                    <?php if ($page < $pages) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?k=<?= htmlspecialchars($category); ?>&search=<?= htmlspecialchars($search); ?>&p=<?= $page + 1; ?>">
                                Next
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</section>

<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">Copyright &copy; 2019 - KAMIKAMERA RENCAMS</div>
    </div>
</footer>
</body>
</html>
<?php
$stmt->close();
$conn->close();
?>
