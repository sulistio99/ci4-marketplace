<div class="col-md-12">
  <!-- general form elements -->
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title"><?= $title; ?></h3>
    </div>
    <!-- /.card-header -->
    <!-- form start -->
    <?php echo form_open_multipart('Admin/UbahDataUser/' . $user['id_user']) ?>
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
              <label>Foto Profil</label>
              <div class="form-group ">
                <img src="<?= base_url('foto/FotoUser/' . $user['foto_user']); ?>" class="img-fluid" width="200px" height="200px" id="gambar_load">
              </div>
              <div class="col-sm-12">
                <label>Ganti Foto</label>
                <div class="form-group ">
                  <input type="file" name="foto_user" accept="image/*" id="preview_gambar">
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
                <!-- value old untuk tidak input ulang lagi -->
                <input type="text" class="form-control" placeholder="Nama User" name="nama_user" value="<?= $user['nama_user']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>E-Mail</label>
                <input type="email" class="form-control" placeholder="E-Mail" name="email" value="<?= $user['email']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>No Handphone</label>
                <input type="number" class="form-control" placeholder="No Handphone" name="no_hp" value="<?= $user['no_hp']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" placeholder="Password" name="password" value="<?= $user['password']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" class="form-control" name="tanggal_lahir" value="<?= $user['tanggal_lahir']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Rekening</label>
                <input type="number" class="form-control" placeholder="Nomor Rekening" name="rekening" value="<?= $user['rekening']; ?>">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select class="form-control" name="jenis_kelamin">
                  <option value="<?= $user['jenis_kelamin']; ?>"><?= $user['jenis_kelamin']; ?></option>
                  <option value="Laki-laki" <?= old('jenis_kelamin') == "Perempuan" ? 'selected' : ""; ?>>Laki-laki</option>
                  <option value="Perempuan" <?= old('jenis_kelamin') == "Perempuan" ? 'selected' : ""; ?>>Perempuan</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" cols="20" rows="5" class="form-control"><?= $user['alamat']; ?></textarea>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
      <a href="<?= base_url('Admin/KelolaUser'); ?>" class="btn btn-warning"><i class="fas fa-share"></i> Kembali</a>
      <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Ubah</button>
    </div>
    <?php echo form_close() ?>
  </div>
</div>
<!-- /.card -->