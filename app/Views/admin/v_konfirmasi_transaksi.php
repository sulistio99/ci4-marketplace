<div class="col-md-12">
  <div class="card">
    <div class="card-header">
      <h5 class="card-title"><b><?= $title; ?></b></h5>
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
      <table id="example2" class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID Pengajuan</th>
            <th>Tanggal</th>
            <th>Nama Barang</th>
            <th>Penjual</th>
            <th>Pembeli</th>
            <th>Harga Akhir</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php $no = 1;
          foreach ($konfirmtransaksi as $key => $value) { ?>
            <?php
            $db = \Config\Database::connect();
            // $nama_penjual = $db->table('tb_barang')
            //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
            //   ->where('tb_barang.id_user', $value['id_penjual'])
            //   ->get()->getRowArray();

            // $nama_pembeli = $db->table('tb_barang')
            //   ->join('tb_user', 'tb_user.id_user=tb_barang.id_user')
            //   ->where('tb_barang.id_user', $value['id_pembeli'])
            //   ->get()->getRowArray();

            $nama_penjual = $db->table('tb_user')
              ->where('id_user', $value['id_penjual'])
              ->get()->getRowArray();

            $nama_pembeli = $db->table('tb_user')
              ->where('id_user', $value['id_pembeli'])
              ->get()->getRowArray();

            $status = $db->table('tb_konfirm_transaksi')
              ->where('id_konfirm_transaksi', $value['id_konfirm_transaksi'])
              ->get()->getRowArray();
            ?>
            <tr>
              <td><?= $value['id_pengajuan']; ?></td>
              <td><?= $value['tanggal']; ?></td>
              <td><?= $value['nama_barang']; ?></td>
              <td><span class="text-primary"><?= $nama_penjual['nama_user']; ?></span></td>
              <td><span class="text-primary"><?= $nama_pembeli['nama_user']; ?></span></td>
              <td><?= number_to_currency($value['harga'], 'Rp.') ?></td>
              <td><span class="text-primary"><?= $status['status']; ?></span></td>
              <td class="text-center">
                <?php if ($status['status'] == 'Belum Dibayar') { ?>
                  <button type="button" class="btn btn-default btn-flat btn-sm" data-toggle="modal" data-target="#modal-acc<?= $value['id_konfirm_transaksi'] ?>">
                    ACC
                  </button>
                <?php } else { ?>
                  <button type="button" class="btn btn-default btn-flat btn-sm" data-toggle="modal" data-target="#modal-acc<?= $value['id_konfirm_transaksi'] ?>" disabled>
                    <i class="fas fa-check"></i> ACC
                  </button>
                <?php } ?>

              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- modal acc -->
<?php foreach ($konfirmtransaksi as $key => $value) { ?>
  <div class="modal fade" id="modal-acc<?= $value['id_konfirm_transaksi'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Transaksi</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open(base_url('Admin/AddKonfirmTransaksi/' . $value['id_konfirm_transaksi'])) ?>
          <div class="form-group">
            <input type="hidden" value="<?= $value['id_pengajuan']; ?>" name="id_pengajuan">
            <input type="hidden" value="<?= $value['harga']; ?>" name="harga_akhir">
            <input type="hidden" value="<?= $status['status']; ?>" name="status">
            <label>Konfirmasi Tranksai User. </label>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Ya</button>
        </div>
        <?php echo form_close() ?>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>