<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php echo form_open_multipart('Barang/SimpanDataBarang') ?>
    <div class="card-body">
      <!-- notifikasi validasi data-->
      <?php
      $errors = session()->getFlashdata('errors');
      if (!empty($errors)) { ?>
        <div class="alert alert-danger" role="alert">
          <h4>Periksa entry form</h4>
          <ul>
            <?php
            foreach ($errors as $key => $error) { ?>
              <li><?= esc($error); ?></li>
            <?php } ?>
          </ul>
        </div>
      <?php } ?>
      <!-- notifikasi-->
      <div class="row">
        <div class="col-sm-3">
          <div class="row text-center">
            <div class="col-sm-12">
              <label>Foto Barang</label>
              <div class="form-group ">
                <img src="<?= base_url('foto/FotoBarang/product.png'); ?>" class="img-fluid img-circle" width="200px" height="200px" id="gambar_load">
              </div>
              <div class="col-sm-12">
                <div class="form-group ">
                  <input type="file" name="foto1" accept="image/*" id="preview_gambar">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-9">
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama User</label>
                <select name="id_user" class="form-control">
                  <option value="">--Pilih User--</option>
                  <?php foreach ($user as $key => $value) { ?>
                    <option value="<?= $value['id_user']; ?>" <?= old('id_user') == $value['id_user'] ? "selected" : ''; ?>><?= $value['nama_user']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="<?= old('nama_barang'); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Kategori</label>
                <select name="id_kategori" class="form-control">
                  <option value="">--Pilih Kategori--</option>
                  <?php foreach ($kategori as $key => $value) { ?>
                    <option value="<?= $value['id_kategori']; ?>" <?= old('id_kategori') == $value['id_kategori'] ? "selected" : ''; ?>><?= $value['nama_kategori']; ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Harga Barang</label>
                <input type="number" class="form-control" placeholder="Harga Barang" name="harga_barang" value="<?= old('harga_barang'); ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                  <option value="">--Pilh Status==</option>
                  <option value="belum terjual" <?= old('status') == "belum terjual" ? "selected" : ''; ?>>Belum Terjual</option>
                  <option value="terjual" <?= old('status') == "terjual" ? "selected" : ''; ?>>Terjual</option>
                  <option value="Terkunci" <?= old('status') == "terkunci" ? "selected" : ''; ?>>Terkunci</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" class="form-control" name="tanggal" value="<?= old('tanggal'); ?>">
              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="deskripsi" cols="20" rows="5" class="form-control"><?= old('deskripsi'); ?></textarea>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <a href="<?= base_url('Barang'); ?>" class="btn btn-warning"><i class="fas fa-share"></i> Kembali</a>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Tambah</button>
    </div>
    <?php echo form_close() ?>
  </div>
</div>
<!-- /.card -->