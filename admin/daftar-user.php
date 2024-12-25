<?php include 'assets/php/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Penyewaan</title>

    <!-- Custom fonts & styles -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Alertify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/themes/default.min.css" />
</head>

<body id="page-top">
<div id="wrapper">
    <?php include 'assets/layout/sidebar.php'; ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <?php include 'assets/layout/topbar.php'; ?>
            <div class="container-fluid">
                <h1 class="h3 mb-4 text-gray-800">Daftar User</h1>
                <!-- Button to Open the Modal -->
                <button class="btn btn-warning btn-sm mb-3" data-toggle="modal" data-target="#tambahModal">
                    <i class="fas fa-plus"></i> Tambah User
                </button>


                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Id User</th>
                                    <th>Nama Lengkap</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No. HP</th>
                                    <th>Alamat</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody id="table-content">
                                <!-- Data populated dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'assets/layout/footer.php'; ?>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form id="edit-form">
                <div class="modal-body">
                    <input type="hidden" id="edit-id_user">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" id="edit-nama_lengkap" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select id="edit-jk" class="form-control" required>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" id="edit-no_telp" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea id="edit-alamat" class="form-control" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="edit-email" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Tambah User Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahUserForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_lengkap" required>
                    </div>
                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select class="form-control" name="jk" required>
                            <option value="1">Laki-laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" class="form-control" name="no_telp" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah User</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Scripts -->
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/alertify.js/1.13.1/alertify.min.js"></script>

<script>
    $(document).ready(function () {
    function loadTable() {
        $.ajax({
            url: 'http://localhost/rentalcam/admin/assets/php/user.php', // Ganti ke endpoint user
            method: 'GET',
            dataType: 'json',
            success: function (response) {
                let rows = '';
                if (response.status === 'success') {
                    response.data.forEach((user, index) => {
                        let jk = (user.jk == 1) ? "Laki-laki" : "Perempuan"; 

                        rows += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${user.id_user}</td>
                            <td>${user.nama_lengkap}</td>
                            <td>${jk}</td>
                            <td>${user.no_telp}</td>
                            <td>${user.alamat}</td>
                            <td>${user.email}</td>
                            <td>
                                <button class="btn btn-danger btn-sm" onclick="hapusUser('${user.id_user}')">Hapus</button>
                                <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal" onclick="openEditModal('${user.id_user}', '${user.nama_lengkap}', '${user.jk}', '${user.no_telp}', '${user.alamat}', '${user.email}')">Edit</button>
                            </td>
                        </tr>`;
                    });
                }
                $('#table-content').html(rows);
                $('#datatable').DataTable();
            }
        });
    }

    window.hapusUser = function (id) {
        if (confirm(`Yakin ingin menghapus user ID ${id}?`)) {
            $.ajax({
                url: 'http://localhost/rentalcam/admin/assets/php/user.php',
                method: 'DELETE',
                contentType: 'application/json',
                data: JSON.stringify({ id_user: id }),
                success: function () {
                    alert('User berhasil dihapus!');
                    loadTable();
                }
            });
        }
    };

    window.openEditModal = function (id, nama, jenis_kelamin, no_hp, alamat, email) {
        $('#edit-id_user').val(id);
        $('#edit-nama_lengkap').val(nama);
        $('#edit-jk').val(jenis_kelamin);
        $('#edit-no_telp').val(no_hp);
        $('#edit-alamat').val(alamat);
        $('#edit-email').val(email);
    };


    $('#edit-form').submit(function (e) {
        e.preventDefault();
        const data = {
            id_user: $('#edit-id_user').val(),
            nama_lengkap: $('#edit-nama_lengkap').val(),
            // jk: $('#edit-jk').val() === 'Laki-laki' ? '1' : '0',
            jk: $('#edit-jk').val(),
            no_telp: $('#edit-no_telp').val(),
            alamat: $('#edit-alamat').val(),
            email: $('#edit-email').val(),
        };
        $.ajax({
            url: 'http://localhost/rentalcam/admin/assets/php/user.php',
            method: 'PUT',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function () {
                alert('Data user berhasil diperbarui!');
                $('#editModal').modal('hide');
                loadTable();
            }
        });
    });

    $('#tambahUserForm').submit(function (e) {
        e.preventDefault();
        const data = {
            nama_lengkap: $('input[name="nama_lengkap"]').val(),
            jk: $('select[name="jk"]').val(),
            no_telp: $('input[name="no_telp"]').val(),
            alamat: $('textarea[name="alamat"]').val(),
            email: $('input[name="email"]').val(),
            password: $('input[name="password"]').val()
        };

        // const data = {
        //     nama_lengkap: $('#tambah-nama_lengkap').val(),
        //     jk: $('#tambah-jk').val(), // Sesuaikan dengan nama field 'jk' di backend
        //     no_telp: $('#tambah-no_telp').val(),
        //     alamat: $('#tambah-alamat').val(),
        //     email: $('#tambah-email').val(),
        //     password: $('#tambah-password').val() // Tambahkan field password
        // };

        $.ajax({
            url: 'http://localhost/rentalcam/admin/assets/php/user.php',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(data),
            success: function (response) {
                if (response.status === 'success') {
                    $('#tambahModal').modal('hide');
                    alert('User berhasil ditambahkan.');
                    loadTable();
                } else {
                    alert('Gagal menambahkan user: ' + response.message);
                }
            },
            error: function () {
                alert('Terjadi kesalahan saat menghubungi server.');
            }
        });
    });


    loadTable();
});

</script>

</body>
</html>
