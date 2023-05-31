<div class="col-md-3">

  <!-- Profile Image -->
  <div class="card card-dark card-outline">
    <div class="card-body box-profile">
      <?php echo form_open_multipart('user/UpdateData/' . $user['id_user']) ?>
      <div class="font-weight-bold">
        <label class="btn btn-primary btn-xs">
          <i class="fa fa-rotate"></i> Ganti Foto<input id="preview_gambar" type="file" style="display: none;" name="foto">
        </label>
      </div>
      <div class=" text-center">
        <?php if ($user['foto_user'] == '') { ?>
          <img id="gambar_load" class="profile-user-img img-fluid img-circle" src="<?= base_url('foto/blank.png'); ?>" alt="User profile picture">
        <?php } ?>
        <?php if ($user['foto_user']) { ?>
          <img id="gambar_load" class="profile-user-img img-fluid img-circle" src="<?= base_url('foto/fotouser/' . $user['foto_user']); ?>" alt="User profile picture">
        <?php } ?>
      </div>
      <h3 class="profile-username text-center"><?= $user['nama_user']; ?></h3>
      <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
          <i class="fas fa-envelope"></i> <?= $user['email']; ?>
        </li>
        <li class="list-group-item">
          <i class="fa-brands fa-square-whatsapp"></i> <?= $user['no_hp']; ?>
        </li>
        <li class="list-group-item">
          <i class="fas fa-calendar"></i> <?= date('d M Y', strtotime($user['tanggal_lahir'])); ?>
        </li>
      </ul>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

</div>
<!-- /.col -->

<div class="col-md-9">
  <div class="card">
    <div class="card-header p-2 text-center">
      <b>Edit Profil</b>
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
          <label for="inputName" class="col-sm-2 col-form-label">Nama Lengkap</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $user['nama_user']; ?>" name="nama_user">
          </div>
        </div>
        <div class=" form-group row">
          <label class="col-sm-2 col-form-label">E-Mail</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" value="<?= $user['email']; ?>" name="email">
          </div>
        </div>
        <div class=" form-group row">
          <label class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $user['password']; ?>" name="password">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Tanggal Lahir</label>
          <div class="col-sm-10">
            <input type="date" class="form-control" value="<?= $user['tanggal_lahir']; ?>" name="tanggal_lahir"></input>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
          <div class="col-sm-10">
            <select class="form-control" name="jenis_kelamin">
              <option value="<?= $user['jenis_kelamin']; ?>"><?= $user['jenis_kelamin']; ?></option>
              <option value="Laki-laki">Laki-laki</option>
              <option value="Perempuan">Perempuan</option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">No hp</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $user['no_hp']; ?>" name="no_hp"></input>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label">Alamat</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" value="<?= $user['alamat']; ?>" name="alamat" placeholder="Alamat Lengkap"></input>
            <div class="text-danger" style="font-size: 14px;">
              Perhatian: <br>
              Alamat diatas digunakan sebagai alamat pengiriman barang, pastikan anda mengisi alamat dengan lengkap dan benar.
            </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-warning">Ubah</button>
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