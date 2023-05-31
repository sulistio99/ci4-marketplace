<div class="col-md-3">

  <!-- Profile Image -->
  <div class="card card-dark card-outline">
    <div class="card-body box-profile">
      <?php echo form_open_multipart('user/SimpanTambahBarang/' . session('id_user')) ?>
      <div class="font-weight-bold">
        <label class="btn btn-primary btn-xs">
          <i class="fa fa-plus"></i> File Gambar<input id="preview_gambar" type="file" style="display: none;" name="foto1">
        </label>
      </div>
      <div class=" text-center">
        <img id="gambar_load" class="profile-user-img img-fluid" style="border: none;" src="<?= base_url('foto/fotobarang/product2.jpg'); ?>" alt="User profile picture">
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</div>
<!-- /.col -->
<!-- /.col -->
<div class="col-md-9">
  <div class="card">
    <div class="card-header p-2 text-center">
      <b>Tambah Barang</b>
    </div><!-- /.card-header -->
    <div class="card-body">
      <div class="tab-content">
        <?php
        $errors = session()->getFlashdata('errors');
        if (!empty($errors)) {
        ?>
          <div class="alert alert-danger" role="alert">
            <ul>
              <?php foreach ($errors as $key => $error) : ?>
                <li><?= esc($error); ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php } ?>

        <?php
        if (!empty(session()->getFlashdata('pesan'))) { ?>
          <div class="alert alert-success">
            <?= session()->getFlashdata('pesan'); ?>
          </div>
        <?php } ?>

        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Nama Barang</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="nama_barang" placeholder="Nama barang" value="<?= old('nama_barang'); ?>" required>
          </div>
        </div>
        <div class=" form-group row">
          <label class="col-sm-2 col-form-label">Harga</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="harga_barang" placeholder="Harga barang" value="<?= old('harga_barang'); ?>" required>
          </div>
        </div>
        <div class=" form-group row">
          <label class="col-sm-2 col-form-label">Kategori</label>
          <div class="col-sm-10">
            <select class="form-control" name="id_kategori">
              <option>-Pilih Kategori-</option>
              <?php
              foreach ($kategori as $key => $value) { ?>
                <option value="<?= $value['id_kategori']; ?>" <?= old('id_kategori') == $value['id_kategori'] ? 'selected' : '' ?>><?= $value['nama_kategori']; ?></option>
              <?php } ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Status</label>
          <div class="col-sm-10">
            <select class="form-control" name="status">
              <option>-Pilih Status-</option>
              <option value="belum terjual" <?= old('status') == 'belum terjual' ? '' : ''; ?>>Belum Terjual</option>
              <option value="terjual" <?= old('status') == 'terjual' ? 'selected' : ''; ?>>Terjual</option>
              <option value="terkunci" <?= old('status') == 'terkunci' ? 'selected' : ''; ?>>Terkunci</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Deskripsi</label>
          <div class="col-sm-10">
            <textarea class="form-control" name="deskripsi" id="" cols="85" rows="5"><?= old('deskripsi'); ?></textarea>
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary">Tambah</button>
          </div>
        </div>
        <?php echo form_close() ?>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </div>
  <!-- /.nav-tabs-custom -->
</div>
<!-- /.col -->