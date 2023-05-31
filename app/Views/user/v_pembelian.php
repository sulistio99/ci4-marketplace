<div class="col-md-12">
  <div class="card">
    <div class="card-header p-2 text-center">
      <h1><i class="fas fa-handshake"></i> <?= $title; ?>.</h1>
    </div><!-- /.card-header -->
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

      <div class="row">
        <div class="col-12 table-responsive">
          <table id="example2" class="table table-bordered table-sm">
            <thead class="table-dark">
              <tr class="text-center">
                <th>Tanggal</th>
                <th>Barang</th>
                <th>Penjual</th>
                <th>Total</th>
                <th>Harga Tawaran Penjual</th>
                <th>Status</th>
                <th width="180px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($pembelian as $key => $value) { ?>
                <?php
                $db = \Config\Database::connect();
                $nama_penjual = $db->table('tb_pengajuan')
                  ->join('tb_user', 'tb_user.id_user=tb_pengajuan.id_penjual')
                  ->where('id_user', $value['id_penjual'])
                  ->get()->getRowArray();

                $status = $db->table('tb_pengajuan')
                  ->where('id_pengajuan', $value['id_pengajuan'])
                  ->get()->getRowArray();
                ?>
                <tr>
                  <td><?= date('d M Y', strtotime($value['tanggal'])); ?></td>
                  <td><?= $value['nama_barang']; ?></td>
                  <td><span class="text-primary"><?= $nama_penjual['nama_user']; ?><span></td>
                  <td><?= number_to_currency($value['harga_barang'], 'Rp.') ?></td>
                  <td><?= number_to_currency($value['harga_tawar_penjual'], 'Rp.') ?></td>
                  <td><span class="text-primary"><?= $status['status']; ?></span></td>
                  <td width="180px">
                    <div class="btn-group">
                      <a href="<?= base_url('User/NegoPembeli/' . $value['id_pengajuan']); ?>" class="btn btn-warning btn-sm"><i class="fas fa-bars"></i> Rincian</a>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-delete<?= $value['id_pengajuan'] ?>" <?php if ($status['status'] == 'Barang Diterima') { ?> disabled <?php } ?>>
                        <i class="fas fa-trash"></i> Batalkan
                      </button>
                    </div>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>

<!-- modal Hapus -->
<?php foreach ($pembelian as $key => $value) { ?>
  <div class="modal fade" id="modal-delete<?= $value['id_pengajuan'] ?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Konfirmasi Pembatalan Penawaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <?php echo form_open_multipart(base_url('User/DeletePengajuanPembelian/' . $value['id_pengajuan'])) ?>
          <input type="hidden" name="id_barang" value="<?= $value['id_barang']; ?>">
          <input type="hidden" name="id_cart" value="<?= $value['id_cart']; ?>">
          <div class="form-group">
            Yakin Mau Batalkan Penawaran <b><?= $value['nama_barang']; ?> ?</b>
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