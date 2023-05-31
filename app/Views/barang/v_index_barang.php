<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b><?= $title; ?></b> | <a href="<?= base_url('Barang/TambahBarang'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a></h5>
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
            <th>Detail</th>
            <th>Nama Pemilik</th>
            <th>Tanggal Masuk</th>
            <th>Status</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($barang as $key => $value) { ?>
            <tr>
              <td><?= $no++; ?></td>
              <td class="text-center"><img src="<?= base_url('foto/FotoBarang/' . $value['foto1']); ?>" width="100px"></td>
              <td>
                <b><?= $value['nama_barang']; ?></b><br>
                <i class="fas fa-genderless"></i> <?= $value['nama_kategori']; ?><br>
                <i class="fas fa-dollar"></i> <?= $value['harga_barang']; ?>
              </td>
              <td><?= $value['nama_user']; ?></td>
              <td><?= $value['tanggal']; ?></td>
              <td><?= $value['status']; ?></td>
              <td><?= $value['deskripsi']; ?></td>
              <td class="text-center">
                <a href="<?= base_url('Barang/UbahBarang/' . $value['id_barang']); ?>" class="btn btn-warning btn-sm btn-flat"><i class="fa fa-edit"></i> Ubah</a>
                <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_barang'] ?>">
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
<?php foreach ($barang as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_barang'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <?php echo form_open_multipart(base_url('Barang/DeleteData/' . $value['id_barang'])) ?>
          <div class="form-group">
            <label>Yakin Mau Hapus? <?= $value['nama_user']; ?> (<?= $value['nama_barang']; ?>)</label>
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