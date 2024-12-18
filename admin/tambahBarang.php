
<!-- Tambah Barang Modal -->
<div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="tambahBarangForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kategori</label>
                        <select class="form-control" name="id_kategori" id="kategori" required></select>
                    </div>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" name="nama_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Barang</label>
                        <input type="number" class="form-control" name="harga_barang" required>
                    </div>
                    <div class="form-group">
                        <label>Harga Sewa</label>
                        <input type="number" class="form-control" name="harga_sewa" required>
                    </div>
                    <div class="form-group">
                        <label>Qty</label>
                        <input type="number" class="form-control" name="qty" required>
                    </div>
                    <div class="form-group">
                        <label>Gambar Barang</label>
                        <input type="file" class="form-control" name="img" accept=".jpg, .jpeg, .png" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Tambah Barang</button>
                </div>
            </form>
        </div>
    </div>
</div>
