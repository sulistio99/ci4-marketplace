<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b><?= $title; ?></b> | <a href="<?= base_url('Admin/TambahUser'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a></h5>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <!-- notifikasi-->
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h5><i class="icon fas fa-check"></i> ';
        echo session()->getFlashdata('pesan');
        echo '</h5> </div>';
      }
      ?>
      <table id="example1" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Profil</th>
            <th>E-Mail</th>
            <th>Password</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($user as $key => $value) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td class="text-center"><img src="<?= base_url('foto/FotoUser/' . $value['foto_user']); ?>" width="100px"></td>
              <td>
                <b><?= $value['nama_user']; ?></b><br>
                <i class="fa fa-calendar"></i> <?= $value['tanggal_lahir']; ?><br>
                <i class="fa fa-venus"></i> <?= $value['jenis_kelamin']; ?><br>
                <i class="fa fa-map-marker"></i> <?= $value['alamat']; ?>
              </td>
              <td><?= $value['email']; ?></td>
              <td><?= $value['password']; ?></td>
              <td class="text-center">
                <a href="<?= base_url('Admin/UbahUser/' . $value['id_user']); ?>" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i> Ubah</a>
                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_user'] ?>">
                  <i class="fas fa-trash"></i> Hapus
                </button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modal Hapus -->
<?php foreach ($user as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_user'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data User</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('Admin/DeleteData/' . $value['id_user'])) ?>
          <div class="form-group">
            <label>Yakin Mau Hapus? <b><?= $value['nama_user']; ?></b></label>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Hapus</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
<?php } ?>
<!-- /.modal -->