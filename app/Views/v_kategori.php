<div class="col-md-12">
  <div class="card card-outline card-primary">
    <div class="card-header">
      <h3 class="card-title">Data <?= $title; ?></h3>
      <div class="card-tools">
        <button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#modal-sm">
          <i class="fas fa-plus"></i> Add
        </button>
      </div>
      <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <?php
      if (session()->getFlashdata('pesan')) {
        echo '<div class="alert alert-success alert-dismissible">';
        echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
        echo '<h5><i class="icon fas fa-check"></i> ';
        echo session()->getFlashdata('pesan');
        echo '</h5> </div>';
      }
      ?>
      <table class="table table-bordered">
        <thead>
          <tr class="text-center">
            <th width="50px">No.</th>
            <th>Nama Kategori</th>
            <th width="200px">Aksi</th>
          </tr>
        <tbody>
          <?php
          $no = 1;
          foreach ($kategori as $key => $value) { ?>
            <tr>
              <td><?= $no++; ?>.</td>
              <td><?= $value['nama_kategori']; ?></td>
              <td class="text-center">
                <button type="button" class="btn btn-warning btn-flat btn-sm" data-toggle="modal" data-target="#modal-edit<?= $value['id_kategori'] ?>">
                  <i class="fas fa-edit"></i> Ubah
                </button>
                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_kategori'] ?>">
                  <i class="fas fa-trash"></i> Hapus
                </button>
              </td>
            </tr>
          <?php } ?>
        </tbody>
        </thead>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- modal Add-->
<div class="modal fade" id="modal-sm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data <?= $title; ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php echo form_open(base_url('kategori/add')) ?>
        <div class="form-group">
          <label>Nama Kategori</label>
          <input type="text" class="form-control" placeholder="Nama Kategori" name="nama_kategori" required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-flat">Tambah</button>
      </div>
      <?php echo form_close() ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal Edit -->
<?php foreach ($kategori as $key => $value) { ?>
  <div class="modal fade" id="modal-edit<?= $value['id_kategori'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data <?= $title; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('kategori/EditData/' . $value['id_kategori'])) ?>
          <div class="form-group">
            <label>Nama Kategori</label>
            <input type="text" class="form-control" value="<?= $value['nama_kategori'] ?>" name="nama_kategori">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-flat">Ubah</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>

<!-- modal Hapus -->
<?php foreach ($kategori as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_kategori'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Data <?= $title; ?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open(base_url('kategori/DeleteData/' . $value['id_kategori'])) ?>
          <div class="form-group">
            <label>Yakin Mau Hapus? <b><?= $value['nama_kategori']; ?></b></label>
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
  <!-- /.modal -->
<?php } ?>