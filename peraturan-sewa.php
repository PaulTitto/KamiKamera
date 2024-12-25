<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peraturan Penyewaan</title>
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f8f9fc;
        }
        .card {
            margin: auto;
            max-width: 800px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }
        .card-header {
            background-color: #4e73df;
            color: white;
            font-size: 1.25rem;
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }
        .card-body {
            padding: 20px;
        }
        .list-group-item {
            list-style: none;
            border: none;
            padding: 10px 0;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <i class="fas fa-book"></i> Peraturan Penyewaan
    </div>
    <div class="card-body">
        <?php
        $file_path = 'peraturan_peminjaman.txt';

        if (file_exists($file_path)) {
            // Membaca isi file
            $rules = file($file_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

            if (!empty($rules)) {
                echo '<ul class="list-group">';
                foreach ($rules as $index => $rule) {
                    echo '<li class="list-group-item"><strong>' . ($index + 1) . '.</strong> ' . htmlspecialchars($rule) . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p class="text-danger">File peraturan kosong.</p>';
            }
        } else {
            echo '<p class="text-danger">File peraturan tidak ditemukan.</p>';
        }
        ?>
    </div>
</div>

</body>
</html>
